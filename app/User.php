<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    use Notifiable;


    protected $connection = 'login';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'nrp', 'password', 'role', 'avatar', 'pangkat', 'status_verif', 'darkmode','last_session'
    ];

    public function bunga()
    {
        return $this->hasOne(Bunga::class);
    }

    public function pinjaman()
    {
        return $this->hasOne(Pinjaman::class);
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }
    public function detailkpr()
    {
        return $this->hasOne(Detailkpr::class,'nrp');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImgProfileAttribute()
    {
        return "/storage/" . $this->avatar;
    }
    
    public function getRoleSectionAttribute()
    {
        if ($this->role == '0') {
            return '<span class="badge badge-success">ADMIN</span>';
        } else if ($this->role == '1') {
            return '<span class="badge badge-warning">PENGELOLA</span>';
        } else if ($this->role == '2') {
            return 'USER';
        } else if ($this->role == '3') {
            return 'ENDUSER';
        } else {
            return 'Not Have Role';
        }
    }
    
    public function getRoleSectionForNavAttribute()
    {
        if ($this->role == '0') {
            return 'ADMIN';
        } else if ($this->role == '1') {
            return 'PENGELOLA';
        } else if ($this->role == '2') {
            return 'USER';
        } else if ($this->role == '3') {
            return 'ENDUSER';
        } else {
            return 'Not Have Role';
        }
    }

    public function scopeSearch($query, $term, $email = false)
    {
        if ($email) {
            return $query->where('name', 'like', "%$term%")
                ->orWhere('email', 'like', "%$term%")
                ->orWhere('nrp', 'like', "%$term%");
        } else {
            return $query->where('name', 'like', "%$term%")
                ->orWhere('nrp', 'like', "%$term%");
        }
    }
}
