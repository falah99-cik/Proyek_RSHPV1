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
    return $this->hasOne(\App\Models\Dokter::class, 'id_user', 'iduser');
}
public function perawat()
{
    return $this->hasOne(Perawat::class, 'id_user', 'iduser');
}

public function hasRole($roleName)
{
    return $this->roleAktif()->first()?->nama_role === $roleName;
}

public function isAdmin()
{
    return $this->hasRole('Administrator');
}

public function isDokter()
{
    return $this->hasRole('Dokter');
}

public function isPerawat()
{
    return $this->hasRole('Perawat');
}

public function isResepsionis()
{
    return $this->hasRole('Resepsionis');
}

public function isPemilik()
{
    return $this->hasRole('Pemilik');
}

public function routeProfil()
{
    $role = $this->roleAktif()->first()?->nama_role;

    return match($role) {
        'Administrator' => route('admin.profil.index'),
        'Dokter'        => route('dokter.profil.index'),
        'Perawat'       => route('perawat.profil.index'),
        'Resepsionis'   => route('resepsionis.profil.index'),
        'Pemilik'       => route('pemilik.profil.index'),
        default         => '#',
    };
}

}
