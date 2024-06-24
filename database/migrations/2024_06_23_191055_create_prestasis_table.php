<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_peserta')->comment('ID Peserta');
            $table->string('nm_prestasi')->comment('Nama Prestasi');
            $table->string('id_bidang')->comment('ID Bidang Prestasi')->nullable();
            $table->string('id_tingkat')->comment('ID Tingkat Prestasi')->nullable();
            $table->string('id_jenis')->comment('ID Jenis Prestasi')->nullable();
            $table->text('file')->comment('File Bukti Presatasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
