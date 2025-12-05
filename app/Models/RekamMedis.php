<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idreservasi_dokter',
        'dokter_pemeriksa',
        'idpet',
        'created_at'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet');
    }

    public function dokterPemeriksa()
{
    return $this->belongsTo(Dokter::class, 'dokter_pemeriksa', 'id_dokter');
}

public function detail()
{
    return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis');
}
}
