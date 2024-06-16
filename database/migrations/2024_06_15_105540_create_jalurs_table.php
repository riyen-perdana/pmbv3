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
        Schema::create('jalur', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama')->comment('Nama Jalur Penerimaan');
            $table->integer('tahun')->comment('Tahun Penerimaan');
            $table->string('semester')->comment('Semester Penerimaan');
            $table->bigInteger('nominal')->comment('Besaran Nominal Penerimaan');
            $table->date('tgl_pr_buka')->comment('Tanggal Pradaftar Buka');
            $table->date('tgl_pr_tutup')->comment('Tanggal Pradaftar Tutup');
            $table->date('tgl_byr_buka')->comment('Tanggal Pembayaran Buka');
            $table->date('tgl_byr_tutup')->comment('Tanggal Pendaftaran Tutup');
            $table->date('tgl_dft_buka')->comment('Tanggal Pendaftaran Buka');
            $table->date('tgl_dft_tutup')->comment('Tanggal Pendaftaran Tutup');
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Jalur Aktif?')->default('N');
            $table->integer('prefiks')->comment('Prefiks Jalur');
            $table->text('pilihan')->comment('Pilihan Prodi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalur');
    }
};
