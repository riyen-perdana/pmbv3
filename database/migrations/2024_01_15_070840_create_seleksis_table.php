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
        Schema::create('seleksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nm_seleksi')->comment('Nama Jenis Seleksi Masuk');
            $table->char('pref_seleksi',1)->comment('Prefiks Jenis Seleksi Untuk Penomoran Peserta');
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Seleksi Penerimaan Aktif?')->default('N');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seleksi');
    }
};
