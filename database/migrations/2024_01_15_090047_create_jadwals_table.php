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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('id_seleksi')->comment('ID Tabel Seleksi Relasi Tabel Jadwal');
            $table->bigInteger('nominal')->comment('Besaran Nilai Nominal Pendaftaran');
            $table->char('tahun',4)->comment('Tahun Jadwal Seleksi');
            $table->dateTime('pr_daftar_awal', $precision = 0)->comment('Jadwal Pradaftar Awal');
            $table->dateTime('pr_daftar_akhir', $precision = 0)->comment('Jadwal Akhir Pradaftar');
            $table->dateTime('byr_awal', $precision = 0)->comment('Jadwal Pembayaran Awal');
            $table->dateTime('byr_akhir', $precision = 0)->comment('Jadwal Pembayaran Akhir');
            $table->dateTime('dft_awal', $precision = 0)->comment('Jadwal Pendaftaran Awal');
            $table->dateTime('dft_akhir', $precision = 0)->comment('Jadwal Pendaftaran Akhir');
            $table->dateTime('pengumuman_kelulusan', $precision = 0)->comment('Jadwal Pengumuman Kelulusan Jalur Pendaftaran')->nullable();
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Jadwal Aktif?')->default('N');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
