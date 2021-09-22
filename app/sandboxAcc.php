<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sandboxAcc extends Model
{

    protected $table = "kpr_sandbox";
    protected $fillable = ['nama','ref','pangkat','rekening','nrp','kesatuan','tahap','pinjaman','jk_waktu','jml_angsuran','jml_angs','angs_ke','angsuran_masuk','tunggakan','jml_tunggakan','keterangan','bunga','pokok','piutang_pokok', 'piutang_bunga','status'];
}
