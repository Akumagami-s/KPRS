<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FasilitasRumah extends Model
{
    protected $table = 'fasilitas_rumah';

    protected $guarded = [];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }
    
    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }
}
