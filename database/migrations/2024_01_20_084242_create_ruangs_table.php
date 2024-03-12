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
        Schema::create('ruang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nm_ruang')->comment('Nama Ruang Ujian');
            $table->date('tgl_ujian')->comment('Tanggal Ujian');
            $table->integer('sesi_ruang')->comment('Sesi Ruang Ujian');
            $table->string('waktu_ujian')->comment('Waktu Ujian');
            $table->string('waktu_simulasi')->comment('Waktu Sumulasi Ujian');
            $table->integer('nomor_ruang')->comment('Nomor Ruangan Ujian');
            $table->integer('jlh_kursi')->comment('Jumlah Kursi Ruang');
            $table->integer('no_awal')->comment('Nomor Awal Peserta Ujian');
            $table->integer('no_akhir')->comment('Nomor Akhir Peserta Ujian');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang');
    }
};
