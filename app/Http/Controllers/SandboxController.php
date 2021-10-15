<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\sandboxAcc;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Transaksi;
use App\transaksiSandbox;
class SandboxController extends Controller
{


        public function index()
        {
            // Sandbox dimulai dengan parameternya NRP user asli
            $sand = sandboxAcc::where('ref',Auth::user()->nrp)->first();
            if(is_null($sand)){
                return view('sandbox.index');
            }
            else {

                $bln = $sand->tmt_angsuran;
                $bln = explode(' ',$bln);
                $bln = explode('-',$bln[0]);
                $bln = intval($bln[1]);

                $data = app('App\Http\Controllers\AnuitasController')->TabelAngsuran($bln,$sand->pinjaman,$sand->jk_waktu);
                return view('sandbox.index',['acc'=>$sand,'all' => $data[0],'besar_angsuran' => $data[1],'no' => intval($sand->jk_waktu)]);
            }
        }

        public function createKpr(Request $request)
        {
            $time = Carbon::now();
            $thisTime = Carbon::create($time->year, $time->month, $time->day, 1, 0, 0);

            // Membuat akun sandbox KPR
            $acc = sandboxAcc::where('ref',Auth::user()->nrp)->first();
            if(is_null($acc)){
                $acc = sandboxAcc::firstOrCreate([
                    'ref'=>Auth::user()->nrp,
                    'nama'=>'sandbox-'.Auth::user()->name,
                    'pinjaman'=>$request->pinjaman,
                    'rekening'=>Carbon::now()->timestamp.'T',
                    'jk_waktu'=>$request->jangka,
                    'tmt_angsuran'=> $thisTime
                ]);
            }



                $bln = explode('-',Carbon::now()->toDateString('Y-m-d'));
                $bln = intval($bln[1]);
                $data = app('App\Http\Controllers\AnuitasController')->TabelAngsuran($bln,$request->pinjaman,$request->jangka);


                // return view('sandbox.index',['acc'=>$acc,'all' => $data[0],
                // 'besar_angsuran' => $data[1],
                // 'no' => intval($request->jk_waktu)]);
                Alert::success(
                    'Account telah terbuat',
                    'Sandbox tidak memerlukan approve dari admin'
                );

                return redirect()->back();

        }


        public function lihatDataBayar(Request $request)
        {

            $kpr = sandboxAcc::where('ref',Auth::user()->nrp)->first();
            $waktu_selesai = date('Y-m-d', strtotime("+".$kpr->jk_waktu." months", strtotime($kpr->tmt_angsuran)));
            $tahun_selesai = explode('-',$waktu_selesai);

            $besar_pinjaman = $kpr->pinjaman;
            $bunga = 6/100;
            $jangka = $kpr->jk_waktu;
            $tahun = $kpr->jk_waktu/12;

            $c = pow((1 + $bunga), $tahun);
            $d = $c - 1;
            $fax = ($bunga * $c) / $d;

            //tergantung mau dibuletinnya gimana
            $anunitas = round($fax, 6);
            $besar_angsur = ($besar_pinjaman * $anunitas) / 12;
            $besar_angsuran = round($besar_angsur, -3) + 1000;


            $transaksi = transaksiSandbox::where('ref', Auth::user()->nrp)
            ->where('status', '0001')
            ->get();

            // dd($transaksi);
            $tahun_awal = date('Y', strtotime($kpr->tmt_angsuran));
            $years = [];
            for ($i = $tahun_awal; $i <= $tahun_selesai[0]; $i++) {
                $years[] = $i;
            }

            $years = array_values(array_reverse(array_map('strval', $years), true));

            return view('sandbox.datapinjaman', compact('transaksi', 'kpr', 'years','besar_angsuran'));
        }






    public function bayarPost(Request $request)
    {

        $kpr = sandboxAcc::where('ref',Auth::user()->nrp)->first();
        $input = $request->all();
        $input['data'] = $request->data;


        if ($input['data'] == null) {
            Alert::warning(
                'Tidak ada bulan yang dipilih',
                'Jika ingin Membayar maka pilihlah'
            );
            return back();
        }

        try {

                if ($kpr->rek_bri) {
                    $rekening = $kpr->rek_bri;
                } else if($kpr->rek_bri == null && $kpr->rek_btn) {
                    $rekening = $kpr->rek_btn;
                } else if($kpr->rek_bri == null && $kpr->rek_btn == null && $kpr->rekening) {
                    $rekening = $kpr->rekening;
                } else {
                    $rekening = "0000000000000";
                }

            // Api BTN Logic Start

                foreach ($input['data'] as $tahun => $bulan) {
                    foreach ($bulan as $bln) {
                        $month = $bln < 10 ? "0{$bln}" : $bln;
                        $tanggal = "{$tahun}-{$month}-01";

                    transaksiSandbox::create([
                            'ref' => $kpr->ref,
                            'kodecabang' => '0018',
                            'tanggal' => $tanggal,
                            'rekeningdebet' => $rekening,
                            'matauang' => 'IDR',
                            'tanggalproses' => $tanggal . " " . "01:00:00",
                            'amountdebet' => $kpr->jml_angs,
                            'status' => '0001',
                            'deskripsi' => 'Transaction Successful',
                            'nama' => $kpr->nama,
                        ]);
                    }

                    foreach ($bulan as $bln) {
                        // isinya array
                        $refresh_saldo = $this->refresh_saldo($kpr->id);
                        $refresh_piutang = $this->refresh_piutang($kpr->id);

                        $month = $bln < 10 ? "0{$bln}" : $bln;
                        $tanggal = "{$tahun}-{$month}-01";


                        if ($kpr->tunggakan > 0) {
                            $angsuran_masuk = $kpr->angsuran_masuk + 1;
                            $tunggakan = $kpr->tunggakan - 1;
                            $jml_tunggakan = $kpr->jml_tunggakan - $kpr->jml_angs;

                            $kpr->update([
                                'angsuran_masuk' => $angsuran_masuk,
                                'tunggakan' => $tunggakan,
                                'jml_tunggakan' => $jml_tunggakan,
                            ]);
                        } else {
                            $angs_ke = $kpr->angs_ke + 1;
                            $angsuran_masuk = $kpr->angsuran_masuk + 1;

                            $kpr->update([
                                'angs_ke' => $angs_ke,
                                'angsuran_masuk' => $angsuran_masuk,
                            ]);
                        }



                        $kpr->update([
                            'bunga' => $refresh_saldo['saldo_bunga'],
                            'pokok' => $refresh_saldo['saldo_pokok'],
                            'piutang_bunga' => $refresh_piutang['utang_bunga'],
                            'piutang_pokok' => $refresh_piutang['utang_pokok'],
                        ]);
                    }
                }
            // });


            // End logic API



            Alert::success('Informasi Pesan', 'Berhasil Terbayar');
            return back();
        } catch (\Exception $e) {
            Alert::error('Informasi Pesan', "Gagal diupdate");
            return back()->with('error_update', $e->getMessage());
        }





    return response()->json(['message'=>'success'], 200);
    }



    private function refresh_saldo($id)
    {
        $kpr = sandboxAcc::find($id);

        $bulan = (int)date('m', strtotime($kpr->tmt_angsuran));

        $data = app('App\Http\Controllers\AnuitasController')->TabelAngsuran($bulan,$kpr->pinjaman,$kpr->jk_waktu);

        $saldo_bunga_total = array_sum(array_slice($data[0]['bunga'], 0, $kpr->angsuran_masuk+1));
        $saldo_pokok_total = array_sum(array_slice($data[0]['pokok'], 0, $kpr->angsuran_masuk+1));

        $utang_bunga_total = array_sum(array_slice($data[0]['bunga'], $kpr->angsuran_masuk + 1, $kpr->jk_waktu));
        $utang_pokok_total = array_sum(array_slice($data[0]['pokok'], $kpr->angsuran_masuk + 1, $kpr->jk_waktu));
        // dd(array_slice($data[0]['bunga'], $kpr->angsuran_masuk + 1, $kpr->jk_waktu));

        // dump(array_sum(array_slice($data[0]['pokok'], 1 ,3)));
        // dd($data[0]['pokok']);

        return [
            "saldo_pokok" => $saldo_pokok_total,
            "saldo_bunga" => $saldo_bunga_total,
        ];
    }

    private function refresh_piutang($id)
    {

        $kpr = sandboxAcc::find($id);


        $bulan = (int)date('m', strtotime($kpr->tmt_angsuran));

        $data = app('App\Http\Controllers\AnuitasController')->TabelAngsuran($bulan,$kpr->pinjaman,$kpr->jk_waktu);

        $utang_bunga_total = array_sum(array_slice($data[0]['bunga'], $kpr->angsuran_masuk + 1, $kpr->jk_waktu));
        $utang_pokok_total = array_sum(array_slice($data[0]['pokok'], $kpr->angsuran_masuk + 1, $kpr->jk_waktu));

        return [
            "utang_pokok" => $utang_bunga_total,
            "utang_bunga" => $utang_pokok_total,
        ];
    }

    public function sandbox_data(Request $request)
    {
        return response()->json(['kpr'=>sandboxAcc::all()], 200);;
    }

    public function trx_btn(Request $request)
    {
        return response()->json(['trx_btn'=>transaksiSandbox::all()], 200);
    }

}
