<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nama_obat',
        'kategori',
        'sediaan',
        'stok',
        'harga',
        'pabrikan'
    ];
}
