<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    public $timestamps = false;
    protected $fillable = ['ruangan_id', 'nama_alat', 'jumlah', 'kondisi'];

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
