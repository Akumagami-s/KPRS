<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'TrxBri';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded  = [];

    public function riwayat()
    {
        return $this->belongsTo(Riwayat::class,'nrp','nrp');
    }
}
