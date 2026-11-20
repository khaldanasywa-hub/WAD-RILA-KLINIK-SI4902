<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    protected $table = 'ruangan';   
    public $timestamps = false;     
    protected $fillable = ['nama_ruangan', 'jenis_poli', 'lokasi_gedung', 'lantai', 'status'];

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'ruangan_id');
    }
}
