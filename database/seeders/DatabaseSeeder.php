
<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data poli dari Moza
        foreach ([1 => 'Poli Umum', 2 => 'Poli Gigi', 3 => 'Poli Anak', 4 => 'Poli Penyakit Dalam'] as $id => $nama) {
            Poli::updateOrCreate(['id_poli' => $id], ['nama_poli' => $nama]);
        }

        // Menjalankan DokterSeeder dari Moza
        $this->call(DokterSeeder::class);

        // Akun contoh dari main
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Akun contoh dari Moza
        User::forceCreate([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::forceCreate([
            'name' => 'User Biasa',
            'email' => 'user@klinik.test',
            'password' => 'password',
            'role' => 'user',
        ]);
    }
}
