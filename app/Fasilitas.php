<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $guarded  = [];

    public function rumah()
    {
        return $this->hasMany(Rumah::class, 'fasilitas_rumah');
    }
}
