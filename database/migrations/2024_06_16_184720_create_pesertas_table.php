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
        Schema::create('peserta', function (Blueprint $table) {
            $table->string('id')->primary()->comment('UUID Peserta Pendaftaran');
            $table->integer('jalur')->comment('Jalur Masuk');
            $table->char('nik_siswa','16')->comment('NIK Siswa Yang Terdiri Dari 16 Digit Nomor Induk Kependudukan');
            $table->char('nisn_siswa','10')->comment('Nomor Induk Siswa Nasional')->nullable();
            $table->string('npsn')->comment('Nomor Pokok Sekolah Nasional')->nullable();
            $table->string('password')->comment('Password');
            $table->string('first_password')->comment('Kode Bayar Bank');
            $table->string('pin')->comment('Kode Bayar Bank');
            $table->string('nm_siswa')->comment('Nama Siswa');
            $table->string('tptlhr_siswa')->nullable()->comment('Tempat Lahir Siswa');
            $table->date('tgllhr_siswa')->nullable()->comment('Tanggal Lahir Siswa');
            $table->char('jklmn_siswa',1)->nullable()->comment('Jenis Kelamin Siswa');
            $table->text('foto_siswa')->nullable()->comment('Foto Siswa');
            $table->text('almt_siswa')->nullable()->comment('Alamat Lengkap Siswa');
            $table->unsignedInteger('agm_siswa')->nullable()->comment('Agama Siswa');
            $table->string('email_siswa')->comment('Email Siswa')->nullable();
            $table->string('notlpn_siswa')->nullable()->comment('Nomor Telepon Siswa');
            $table->string('pil1_siswa')->comment('Pilihan Program Studi Pertama Siswa')->nullable();
            $table->string('pil2_siswa')->comment('Pilihan Program Studi Kedua Siswa')->nullable();
            $table->string('pil3_siswa')->comment('Pilihan Program Studi Kedua Siswa')->nullable();
            $table->string('pil4_siswa')->comment('Pilihan Program Studi Kedua Siswa')->nullable();
            $table->unsignedBigInteger('jlmbayar_siswa')->comment('Jumlah Pembayaran Siswa');
            $table->char('is_bayar','1')->default('0')->comment('Status Pembayaran Siswa');
            $table->date('tglbayar_siswa')->nullable()->comment('Tanggal Bayar Siswa');
            $table->char('is_lulus')->nullable()->comment('Status Kelulusan Siswa');
            $table->char('prodills_siswa','4')->nullable()->comment('Program Studi Kelulusan Siswa');
            $table->enum('is_vrf_op',['Y','N'])->default('N')->comment('Status Verifikasi Nilai Oleh Operator');
            $table->text('dok_nilai_siswa')->nullable()->comment('Lokasi File Dokumen Nilai Siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
