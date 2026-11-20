<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan', 100);
            $table->string('jenis_poli', 50);
            $table->string('lokasi_gedung', 100);
            $table->string('lantai', 50);
            $table->string('status', 20)->default('Aktif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
