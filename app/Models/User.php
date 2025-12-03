<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }
    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser');
    }

    public function roleAktif()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
            ->wherePivot('status', 1);
    }

    public function dokter()
{
    return $this->hasOne(Dokter::class, 'id_user', 'iduser');
}

public function perawat()
{
    return $this->hasOne(Perawat::class, 'id_user', 'iduser');
}
}
