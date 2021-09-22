<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksiSandbox extends Model
{
    protected $table = 'TrxBri_sandbox';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded  = [];

    public function riwayat()
    {
        return $this->belongsTo(Riwayat::class,'nrp','nrp');
    }
}
