<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $table = 'gambar';
    protected $guarded  = [];

    public function rumah()
    {
        return $this->hasOne(Rumah::class, 'gambar_id');
    }
}
