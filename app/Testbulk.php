<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testbulk extends Model
{
    public $timestamps = false;
    protected $table = 'test_bulk';
    protected $fillable = ['nama','pangkat','nrp','kesatuan','kotama','tahap','pinjaman','jk_waktu','tmt_angsuran','jml_angs','angs_ke','angsuran_masuk','tunggakan','jml_tunggakan','keterangan','rekening','rek_bri','rek_btn','bunga','pokok','sisa_pinjaman_pokok','inisial_pokok','inisial_bunga','piutang_pokok', 'piutang_bunga'];
}
