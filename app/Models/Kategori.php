<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $timestamps = false;

    public function tindakan()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori');
    }
}
