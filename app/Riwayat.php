<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'riwayat';
    protected $guarded  = [];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class,'nrp','nrp');
    }
}
