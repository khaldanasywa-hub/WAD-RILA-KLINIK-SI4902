<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $gigi = Ruangan::create(['nama_ruangan' => 'Poli Gigi 1', 'jenis_poli' => 'Poli Gigi', 'lokasi_gedung' => 'Gedung A', 'lantai' => 'Lantai 1', 'status' => 'Aktif']);
        $gigi->inventaris()->createMany([
            ['nama_alat' => 'Dental Chair', 'jumlah' => 2, 'kondisi' => 'Baik'],
            ['nama_alat' => 'Scaler', 'jumlah' => 6, 'kondisi' => 'Baik'],
        ]);

        $umum = Ruangan::create(['nama_ruangan' => 'Poli Umum 1', 'jenis_poli' => 'Poli Umum', 'lokasi_gedung' => 'Gedung A', 'lantai' => 'Lantai 1', 'status' => 'Aktif']);
        $umum->inventaris()->createMany([
            ['nama_alat' => 'Tensimeter', 'jumlah' => 5, 'kondisi' => 'Baik'],
            ['nama_alat' => 'Stetoskop', 'jumlah' => 7, 'kondisi' => 'Baik'],
        ]);
    }
}
