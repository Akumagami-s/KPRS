<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detailkpr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Transaksi;

class KprController extends Controller
{




    public function pinjaman(Request $request)
    {

        // dd($request);
        $kpr = Detailkpr::where('nrp',Auth::user()->nrp)->first();



        if (is_null($kpr)) {
            $data = app('App\Http\Controllers\AnuitasController')->TabelAngsuran(Carbon::now()->toDateString('Y-m-d'),$request->harga,$request->jk_waktu);
            // dd(strlen(Auth::user()->norek));
            if (strlen(Auth::user()->norek) == 15 || strlen(Auth::user()->norek) == 10) {

            Detailkpr::create([
                'nama'=>Auth::user()->nama,
                'pangkat'=>Auth::user()->pangkat,
                'corps'=>Auth::user()->corps,
                'nrp'=>Auth::user()->nrp,
                'kesatuan'=>Auth::user()->kesatuan,
                'kotama'=>Auth::user()->kotama,
                'alamat'=>Auth::user()->alamat,
                'tahap'=>0,
                'pinjaman'=>$request->harga,
                'jk_waktu'=>$request->jk_waktu,
                'rekening'=>Auth::user()->norek,
                'nama_bank'=>'BRI',


                'jml_angs'=>$data[1],
                'bunga'=>array_sum($data[0]['bunga']),
                'pokok'=>array_sum($data[0]['pokok']),

                'rumah_id'=>$request->rumah_id,
                'status'=>2


            ]);
            }else if (strlen(Auth::user()->norek) == 16){

            Detailkpr::create([
                'nama'=>Auth::user()->nama,
                'pangkat'=>Auth::user()->pangkat,
                'corps'=>Auth::user()->corps,
                'nrp'=>Auth::user()->nrp,
                'kesatuan'=>Auth::user()->kesatuan,
                'kotama'=>Auth::user()->kotama,
                'alamat'=>Auth::user()->alamat,
                'tahap'=>0,
                'pinjaman'=>$request->harga,
                'jk_waktu'=>$request->jk_waktu,
                'rekening'=>Auth::user()->norek,
                'nama_bank'=>'BTN',
                'rumah_id'=>$request->rumah_id,

                'jml_angs'=>$data[1],
                'bunga'=>array_sum($data[0]['bunga']),
                'pokok'=>array_sum($data[0]['pokok']),
                'status'=>2
            ]);

            }else {
                return redirect()->route('index')->with(['message'=>"No Rekening anda tidak valid harap perbaiki"]);
            }
            return redirect()->route('index')->with(['message'=>"Permintaan telah diajukan harap tunggu pengajuan ini di approve"]);







        } else {
            return redirect()->route('index');
        }


    }



    public function selengkapnya(Request $request)
    {
        return view('usres.selengkapnya');
    }


 public function detailRumah(Request $request,$id)
    {
        $rumah = DB::table('rumah')->where('id',$id)->first();

        return view('usres.detailRumah',['rumah'=>$rumah]);
    }


    public function getData()
    {
        $res = Http::withHeaders([
            'app_key' => 'QZyBJ5INdztZBKeZdjzX',
            'secret_key' => 'glwMotVkxX8Qy6qckHuak0JqA7nTVLIi'
        ])->get('http://172.16.3.67/btn-open-api/api/v1/manstok/getAllProper');


        dd($res->json());
    }

    public function seePinjaman()
    {
        $kpr = Detailkpr::where('nrp',Auth::user()->nrp)->first();
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


        $transaksi = Transaksi::where('nrp', Auth::user()->nrp)
        ->where('status', '0001')
        ->get();


        // dd($transaksi);
        $tahun_awal = date('Y', strtotime($kpr->tmt_angsuran));
        $years = [];
        for ($i = $tahun_awal; $i <= $tahun_selesai[0]; $i++) {
            $years[] = $i;
        }

        $trx = [];
        foreach ($transaksi as $key => $value) {
            $trx[] = date("Y-m", strtotime($value->tanggal));
        }

        $akhir = date('Y-m', strtotime("+".$kpr->jk_waktu." months", strtotime($kpr->tmt_angsuran)));
        $years = array_values(array_reverse(array_map('strval', $years), true));

        return view('usres.dataPinjaman', compact('trx', 'kpr', 'years','besar_angsuran','akhir'));
    }




}
