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
            $table->uuid('id');
            $table->string('kd_prodi')->unique()->comment('Kode Nomor Program Studi Sesuai PDDIKTI');
            $table->string('id_fakultas')->comment('UUID Fakultas Tabel Fakultas');
            $table->string('id_jenjang')->comment('UUID Jenjang Pendidikan Tabel Jenjang');
            $table->string('id_akr_prodi')->comment('UUID Akreditasi Program Studi');
            $table->string('nm_prodi')->comment('Nama Program Studi');
            $table->integer('qt_prodi')->comment('Quota Program Studi');
            $table->string('url_prodi')->comment('Alamat URL Website Program Studi')->nullable();
            $table->string('url_akr_prodi')->comment('Alamat URL Website Akreditasi Program Studi')->nullable();
            $table->enum('is_open',['Y','N'])->comment('Apakah Program Studi Dibuka Untuk Pilihan 1 dan 2')->default('Y');
            $table->enum('is_open_pil3',['Y','N'])->comment('Apakah Program Studi Dibuka Untuk Pilihan 3')->default('N');
            $table->softDeletes();
            $table->timestamps();
            // $table->foreignUuid('id_fakultas')->references('id')->on('fakultas')->constrained()->onDelete('cascade');
            // $table->foreignUuid('id_jenjang')->references('id')->on('jenjang')->constrained()->onDelete('cascade');
            // $table->foreignUuid('id_akr_prodi')->references('id')->on('akreditasi')->constrained()->onDelete('cascade');
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
