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
        Schema::create('sekolah_asal', function (Blueprint $table) {
            $table->id();
            $table->string('npsn')->unique()->comment('Nomor Pokok Sekolah Nasional');
            $table->string('id_sekolah')->unique()->comment('UUID Sekolah');
            $table->string('nm_sekolah')->comment('Nama Sekolah');
            $table->string('bntk_sekolah')->comment('Bentuk Sekolah SMA, SMK dll');
            $table->string('almt_sekolah')->comment('Alamat Sekolah');
            $table->string('kode_prop')->comment('Kode Propinsi Sekolah');
            $table->string('prop_sekolah')->comment('Propinsi Sekolah');
            $table->string('kode_kab_kota')->comment('Kode Kabupaten Kota Sekolah');
            $table->string('kab_kota_sekolah')->comment('Kabupaten Kota Sekolah');
            $table->string('kode_kec')->comment('Kode Kecamatan Sekolah');
            $table->string('kec_sekolah')->comment('Kecamatan Sekolah');
            $table->string('ltg_sekolah')->comment('Lokasi Lintang Sekolah')->nullable();
            $table->string('bjr_sekolah')->comment('Lokasi Bujur Sekolah')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_asal');
    }
};
