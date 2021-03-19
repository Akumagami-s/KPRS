<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = 'pangkat';
    protected $fillable =['pangkat','corps','kesatuan','Tahap'];
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
