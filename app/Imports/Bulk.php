<?php

namespace App\Imports;

use App\Testbulk;
use App\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;


class Bulk implements ToModel , WithHeadingRow,SkipsOnFailure
{
    use Importable,SkipsFailures;
    public function model(array $row)
    {
        dump($row);
        // Redis::set('bun','bi');
        // $u=Redis::get('bun');
        // dd($u);
    //     Redis::throttle('store_bulk')->allow(1)->every(10)->then(function (){
    //     Testbulk::insert([
    //     'nama' => $row['nama'],
    //     'pangkat' => $row['pangkat'],
    //     'nrp' => $row['nrp'],
    //     'kesatuan' => $row['kesatuan'],
    //     'kotama' => $row['kotama'],
    //     'tahap' => $row['tahap'],
    //     'pinjaman' => $row['pinjaman'],
    //     'jk_waktu' => $row['jk_waktu'],
    //     'tmt_angsuran' => $row['tmt_angsuran'],
    //     'jml_angs' => $row['jml_angs'],
    //     'angs_ke' => $row['angs_ke'],
    //     'angsuran_masuk' => $row['angsuran_masuk'],
    //     'tunggakan' => $row['tunggakan'],
    //     'jml_tunggakan' => $row['jml_tunggakan'],
    //     'tunggakan_pokok' => $row['tunggakan_pokok'],
    //     'tunggakan_bunga' => $row['tunggakan_bunga'],
    //     'keterangan' => $row['keterangan'],
    //     'rekening' => $row['rekening'],
    //     'rek_bri' => $row['rek_bri'],
    //     'rek_btn' => $row['rek_btn'],
    //     'bunga' => $row['bunga'],
    //     'pokok' => $row['pokok'],
    //     'sisa_pinjaman_pokok' => $row['sisa_pinjaman_pokok'],
    //     'inisial_bunga' => $row['inisial_bunga'],
    //     'inisial_pokok' => $row['inisial_pokok'],
    //     'piutang_bunga' => $row['piutang_bunga'],
    //     'piutang_pokok' => $row['piutang_pokok']

    //     ]);
    //     }, function (){
    //         return $this->release(10);
    //     });
    // dd($row);
     }



    // public function rules(): array
    // {
    //     return [
    //         'nrp' => [
    //             'required',

    //         ],
    //         'tunggakan' => [
    //             'required',
    //             'string',
    //         ],
    //         'email' => [
    //             'email',
    //             'string',
    //         ],
    //     ];
    // }
}
