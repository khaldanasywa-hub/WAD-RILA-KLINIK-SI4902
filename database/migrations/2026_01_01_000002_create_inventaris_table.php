<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruangan_id')->constrained('ruangan')->cascadeOnDelete(); // hapus ruangan -> alat ikut terhapus
            $table->string('nama_alat', 100);
            $table->integer('jumlah')->default(0);
            $table->string('kondisi', 30)->default('Baik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
