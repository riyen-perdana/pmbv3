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
        Schema::create('prodi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kd_prodi')->unique()->comment('Kode Nomor Program Studi Sesuai PDDIKTI');
            $table->string('id_fakultas')->comment('UUID Fakultas Tabel Fakultas');
            $table->string('id_jenjang')->comment('UUID Jenjang Pendidikan Tabel Jenjang');
            $table->string('id_akr_prodi')->comment('UUID Akreditasi Program Studi');
            $table->string('nm_prodi')->comment('Nama Program Studi');
            $table->string('url_prodi')->comment('Alamat URL Website Program Studi')->nullable();
            $table->string('url_akr_prodi')->comment('Alamat URL Website Akreditasi Program Studi')->nullable();
            $table->enum('is_aktif',['Y','N'])->comment('Status Aktif Program Studi')->default('Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
