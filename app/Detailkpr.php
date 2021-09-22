<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailkpr extends Model
{
    protected $table = 'kpr';
    // protected $fillable = ['nama','pangkat','nrp','kesatuan','tahap','pinjaman','jk_waktu','jml_angsuran','jml_angs','angs_ke','angsuran_masuk','tunggakan','jml_tunggakan','keterangan','bunga','pokok','piutang_pokok', 'piutang_bunga','status'];
    protected $guarded  = [];
    public function users()
    {
        return $this->belongsTo(User::class,'nrp');
    }

    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }
    
    public function getStatusPinjamAttribute(){
        return $this->status == null || $this->status == 0  || $this->status == 2 ? '<span class="badge badge-danger">BELUM APPROVAL</span>' : '<span class="badge badge-success">SUDAH APPROVAL</span>';
    }
}
