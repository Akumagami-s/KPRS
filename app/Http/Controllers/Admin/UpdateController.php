<?php

namespace App\Http\Controllers\Admin;

use App\Detailkpr;
use App\Transaksi;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    private $transaksi;

    public function __construct()
    {
        $this->transaksi = new Transaksi;
    }

    private function refresh_saldo($id)
    {
        $kpr = Detailkpr::find($id);

        $besar_pinjaman = $kpr->pinjaman;
        $bunga = 6;
        $jangka = $kpr->jk_waktu;

        $bungapersen = $bunga / 100;
        $tahun = $jangka / 12;

        $c = pow((1 + $bungapersen), $tahun);
        $d = $c - 1;
        $fax = ($bungapersen * $c) / $d;
        $anuitas = round($fax, 6);

        $besar_angsur = ($besar_pinjaman * $anuitas) / 12;

        $besar_angsuran = round($besar_angsur, -3);
        if ($besar_angsuran != $kpr->jml_angs) {
            $besar_angsuran = round($besar_angsur, -3) + 1000;
        }

        $array1 = [0 => null];
        $array2 = [0 => null];
        $array3 = [0 => intval($besar_pinjaman)];
        $array4 = [0 => 0];

        $array_utang1 = [0 => null];
        $array_utang2 = [0 => null];
        $array_utang3 = [0 => intval($besar_pinjaman)];
        $array_utang4 = [0 => 0];

        $no = 1;
        $b = 1;
        $angsuran_bunga = $besar_pinjaman * $bungapersen / 12;
        $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

        $angsuran_bunga_utang = $besar_pinjaman * $bungapersen / 12;
        $angsuran_pokok_utang = $besar_angsuran - $angsuran_bunga;

        $bulan = (int)date('m', strtotime($kpr->tmt_angsuran));

        $sisa_angsuran = $kpr->jk_waktu - $kpr->angsuran_masuk - $kpr->tunggakan;

        for ($i = $bulan; $i < $kpr->angsuran_masuk + $bulan; $i++) {

            if ($i == 13 || $no == 13) {
                $ang_bunga = $besar_pinjaman * $bungapersen / 12;
                $angsuran_bunga = round($ang_bunga);
                $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                $angsuran_pokok = round($angsuran_pokoks);
                $no = 1;
            }

            $no++;
            array_push($array1, $angsuran_bunga);
            array_push($array2, $angsuran_pokok);
            array_push($array4, $besar_angsuran);

            $besar_pinjaman -= $array2[$b];
            $b++;
            array_push($array3, $besar_pinjaman);
        }

        $saldo_bunga_total = array_sum(array_slice($array1, 0, $kpr->angsuran_masuk+1));
        $saldo_pokok_total = array_sum(array_slice($array2, 0, $kpr->angsuran_masuk+1));

        $utang_bunga_total = array_sum(array_slice($array1, $kpr->angsuran_masuk + 1, $jangka));
        $utang_pokok_total = array_sum(array_slice($array2, $kpr->angsuran_masuk + 1, $jangka));

        return [
            "saldo_pokok" => $saldo_pokok_total,
            "saldo_bunga" => $saldo_bunga_total,
        ];
    }

    private function refresh_piutang($id)
    {
        $kpr = Detailkpr::where('id', $id)->get();
        // variable yang dibutuhkan
        $besar_pinjaman = [0 => 'besar pinjaman'];
        $jangka = [0 => 'jangka'];
        $angsuran_masuk = [0 => 'angsuran masuk'];
        $sisa_angsuran = [0 => 'sisa angsuran'];
        $tunggakan = [0 => 'tunggakan'];
        $id = [];
        $bulan = [0 => 'tmt_angsuran'];

        $bunga = 6;
        $array_orang_pokok = [];
        $array_orang_bunga = [];

        foreach ($kpr as $key) {
            array_push($tunggakan, $key->tunggakan);
            array_push($id, $key->id);
            array_push($besar_pinjaman, $key->pinjaman);
            array_push($jangka, $key->jk_waktu);
            array_push($angsuran_masuk, $key->angsuran_masuk);
            array_push($sisa_angsuran, ($key->jk_waktu - $key->angsuran_masuk) + $key->tunggakan);
        }

        for ($index = 1; $index <= count($id); $index++) {

            //tentuin bunga ke persen 6 ke 6%
            $bungapersen = $bunga / 100;

            // tentuin tahun dari jangka
            $tahun = $jangka[$index] / 12;

            // ===>mencari anuitas<===
            $c = pow((1 + $bungapersen), $tahun);
            $d = $c - 1;
            $fax = ($bungapersen * $c) / $d;
            $anuitas = round($fax, 6);
            // ===>mencari anuitas<===

            $besar_angsur = ($besar_pinjaman[$index] * $anuitas) / 12;
            $besar_angsuran = round($besar_angsur, -3) + 1000;

            $array_bunga = [0 => 'bunga'];
            $array_pokok = [0 => 'pokok'];
            $array_pinjaman = [0 => 'pinjaman'];

            $no = 1;
            $angsuran_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

            $bulan = (int)date('m', strtotime($kpr[$index - 1]->tmt_angsuran));
            $b = 1;

            for ($i = $bulan; $i < $jangka[$index] + $bulan; $i++) {

                if ($i == 13 || $no == 13) {
                    $ang_bunga = $besar_pinjaman[$index] * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }

                $no++;
                array_push($array_bunga, $angsuran_bunga);
                array_push($array_pokok, $angsuran_pokok);

                $besar_pinjaman[$index] -= $array_pokok[$b];
                $b++;
                array_push($array_pinjaman, $besar_pinjaman);
            }

            $utang_bunga_total = array_sum(array_slice($array_bunga, $angsuran_masuk[$index] + 1, $jangka[$index]));
            $utang_pokok_total = array_sum(array_slice($array_pokok, $angsuran_masuk[$index] + 1, $jangka[$index]));

            array_push($array_orang_pokok, $utang_pokok_total);
            array_push($array_orang_bunga, $utang_bunga_total);
        }

        return [
            "utang_pokok" => $array_orang_pokok[0],
            "utang_bunga" => $array_orang_bunga[0],
        ];
    }

    public function edit($id)
    {
        $currentYear = date('Y');
        $kpr = Detailkpr::find($id);
        $tahun_tmt_angsuran = date('Y', strtotime($kpr->tmt_angsuran));

        $transaksi = $this->transaksi->select('*')
            ->where('nrp', $kpr->nrp)
            // ->where(DB::raw('YEAR(tanggal)'), $currentYear)
            ->where('status', '0001')
            ->get();

        
        // $ambil_tahun = $this->transaksi->where('nrp', $kpr->nrp)->where('status', '0001')
        //     ->orderBy('tanggal', 'ASC')->select(DB::raw('YEAR(tanggal) as year'))->first();
        $ambil_tahun = date('Y', strtotime($kpr->tmt_angsuran));
            
        $years = [];
        
        for ($i = $ambil_tahun; $i <= $currentYear; $i++) {
            $years[] = $i;
        }
        
        $years = array_values(array_reverse(array_map('strval', $years), true));

        return view('admin.datapinjaman.edit', compact('transaksi', 'kpr', 'years'));
    }

    public function store(Request $request, $id)
    {
        // dd($request->data);
        $kpr = Detailkpr::find($id);
        $currentYear = date('Y');
        
        $input = $request->all();
        $input['data'] = $request->data;

        if ($input['data'] == null) {
            Alert::warning(
                'Tidak ada bulan yang dipilih',
                'Jika ingin mengupdate, maka Anda harus memilih bulan yang akan diupdate'
            );
            return back();
        }

        try {
            DB::transaction(function() use ($id, $input, $currentYear, $kpr) {        
                if ($kpr->rek_bri) {
                    $rekening = $kpr->rek_bri;
                } else if($kpr->rek_bri == null && $kpr->rek_btn) {
                    $rekening = $kpr->rek_btn;
                } else if($kpr->rek_bri == null && $kpr->rek_btn == null && $kpr->rekening) {
                    $rekening = $kpr->rekening;
                } else {
                    $rekening = "0000000000000";
                }


                foreach ($input['data'] as $tahun => $bulan) {
                    foreach ($bulan as $bln) {
                        $month = $bln < 10 ? "0{$bln}" : $bln;
                        $tanggal = "{$tahun}-{$month}-01";
                        
                        $this->transaksi->create([
                            'nrp' => $kpr->nrp,
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
                        $refresh_saldo = $this->refresh_saldo($id);
                        $refresh_piutang = $this->refresh_piutang($id);

                        $month = $bln < 10 ? "0{$bln}" : $bln;
                        $tanggal = "{$tahun}-{$month}-01";
                        
                        // $angs_ke = $kpr->angs_ke + 1;
                        // $angsuran_masuk = $kpr->angsuran_masuk + 1;
                        // $tunggakan = $kpr->tunggakan == 0 ? $kpr->tunggakan - 0 : $kpr->tunggakan - 1;
                        // $jml_tunggakan = $kpr->jml_angs * $tunggakan;
                        
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
                        
                        // $kpr->update([
                        //     'angs_ke' => $angs_ke,
                        //     'angsuran_masuk' => $angsuran_masuk,
                        //     'tunggakan' => $tunggakan,
                        //     'jml_tunggakan' => $jml_tunggakan,
                        // ]);
                        
                        $besar_pinjaman = $kpr->pinjaman;
                        $bunga = 6;
                        $jangka = $kpr->jk_waktu;
                
                        $bungapersen = $bunga / 100;
                        $tahun = $jangka / 12;
                
                        $c = pow((1 + $bungapersen), $tahun);
                        $d = $c - 1;
                        $fax = ($bungapersen * $c) / $d;
                        $anuitas = round($fax, 6);
                
                        $besar_angsur = ($besar_pinjaman * $anuitas) / 12;
                
                        $besar_angsuran = round($besar_angsur, -3);
                        if ($besar_angsuran != $kpr->jml_angs) {
                            $besar_angsuran = round($besar_angsur, -3) + 1000;
                        }
                
                        $array1 = [0 => null];
                        $array2 = [0 => null];
                        $array3 = [0 => intval($besar_pinjaman)];
                        $array4 = [0 => 0];
                
                        $array_utang1 = [0 => null];
                        $array_utang2 = [0 => null];
                        $array_utang3 = [0 => intval($besar_pinjaman)];
                        $array_utang4 = [0 => 0];
                
                        $no = 1;
                        $b = 1;
                        $angsuran_bunga = $besar_pinjaman * $bungapersen / 12;
                        $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
                
                        $angsuran_bunga_utang = $besar_pinjaman * $bungapersen / 12;
                        $angsuran_pokok_utang = $besar_angsuran - $angsuran_bunga;
                
                        $bulan = (int)date('m', strtotime($kpr->tmt_angsuran));
                
                        $sisa_angsuran = $kpr->jk_waktu - $kpr->angsuran_masuk - $kpr->tunggakan;
                
                        for ($i = $bulan; $i < $kpr->angsuran_masuk + $bulan; $i++) {
                
                            if ($i == 13 || $no == 13) {
                                $ang_bunga = $besar_pinjaman * $bungapersen / 12;
                                $angsuran_bunga = round($ang_bunga);
                                $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                                $angsuran_pokok = round($angsuran_pokoks);
                                $no = 1;
                            }
                
                            $no++;
                            array_push($array1, $angsuran_bunga);
                            array_push($array2, $angsuran_pokok);
                            array_push($array4, $besar_angsuran);
                
                            $besar_pinjaman -= $array2[$b];
                            $b++;
                            array_push($array3, $besar_pinjaman);
                        }
                
                        $saldo_bunga_total = array_sum(array_slice($array1, 0, $kpr->angsuran_masuk+1));
                        $saldo_pokok_total = array_sum(array_slice($array2, 0, $kpr->angsuran_masuk+1));
        
                        $kpr->update([
                            'bunga' => $saldo_bunga_total,
                            'pokok' => $saldo_pokok_total,
                            'piutang_bunga' => $refresh_piutang['utang_bunga'],
                            'piutang_pokok' => $refresh_piutang['utang_pokok'],
                        ]);
                    }
                }
            });

            Alert::success('Informasi Pesan', 'Berhasil diupdate');
            return back();
        } catch (\Exception $e) {
            Alert::error('Informasi Pesan', "Gagal diupdate");
            return back()->with('error_update', $e->getMessage());
        }
    }
    
    public function meninggal(Request $request, $id)
    {
         $kpr = Detailkpr::find($id);
         $kpr->update([
             'status'=> 5
             ]);
        Alert::success('Informasi Pesan', 'Berhasil diupdate');
            return back();
    }
    
    public function lunas(Request $request, $id)
    {
         $kpr = Detailkpr::find($id);
         $kpr->update([
             'status'=> 4
             ]);
        Alert::success('Informasi Pesan', 'Berhasil diupdate');
            return back();
    }
}
