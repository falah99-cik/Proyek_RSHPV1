<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idreservasi_dokter',
        'dokter_pemeriksa',
        'idpet'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

public function dokter()
    {
    return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    public function detail()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    public function tindakan()
    {
    return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis');
    }
}
