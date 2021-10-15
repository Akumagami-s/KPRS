<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnuitasController extends Controller
{
    public function TabelAngsuran($bln,$pinjaman,$jk_waktu,$bunga=6)
    {
        $besar_pinjaman = $pinjaman;
        $bunga = $bunga/100;
        $jangka = $jk_waktu;

        $tahun = $jk_waktu/12;

        $c = pow((1 + $bunga), $tahun);
        $d = $c - 1;
        $fax = ($bunga * $c) / $d;

        //tergantung mau dibuletinnya gimana
        $anunitas = round($fax, 6);
        $besar_angsur = ($besar_pinjaman * $anunitas) / 12;
        $besar_angsuran = round($besar_angsur, -3) + 1000;
        // angsuran bunga
        $bunga_all = [0 => null];
        // angsuran pokok
        $pokok_all = [0 => null];
        // angsuran pinjaman
        $pinjaman_all = [0 => intval($besar_pinjaman)];

         $angsuran_bunga = $besar_pinjaman * $bunga / 12;
        $angsuran_pokok = $besar_angsuran - $angsuran_bunga;



        $ang = $bln;

        for ($i = 1; $i < $jangka + 1; $i++) {
            // if () {
            //     # code...
            // }
        
            if($bln == 13){
              $ang_bunga = $besar_pinjaman * $bunga / 12;
                $angsuran_bunga = round($ang_bunga, 2);
                $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
                $bln = 1;
            }

            $bunga_all[] = $angsuran_bunga;
            $pokok_all[] = $angsuran_pokok;
            $besar_pinjaman -= $pokok_all[$i];



            $pinjaman_all[] = $besar_pinjaman;
            $bln++;
        }

        $array_all = [
            'bunga' => $bunga_all,
            'pokok' => $pokok_all,
            'pinjaman' => $pinjaman_all,
        ];

        return [$array_all,$besar_angsuran];


    }

}
