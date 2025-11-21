<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    public $timestamps = false;

    public function jenis()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan');
    }
}
