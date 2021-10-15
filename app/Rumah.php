<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    protected $table = 'rumah';
    protected $guarded  = [];

    public function getStatusRumahAttribute()
    {
        return $this->status == 1 ? '<span class="badge badge-danger">TERISI</span>' : '<span class="badge badge-success">KOSONG</span>';
    }

    public function gambar()
    {
        return $this->belongsTo(Gambar::class, 'gambar_id');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_rumah');
    }

    public function detailkpr()
    {
        return $this->hasOne(Detailkpr::class);
    }
}
