<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik');
    }

public function rasHewan()
{
    return $this->belongsTo(\App\Models\RasHewan::class, 'idras_hewan', 'idras_hewan');
}

// Jenis hewan lewat ras_hewan
public function jenisHewan()
{
    return $this->hasOneThrough(
        \App\Models\JenisHewan::class,
        \App\Models\RasHewan::class,
        'idras_hewan',
        'idjenis_hewan',
        'idras_hewan',
        'idjenis_hewan'
    );
}

}
