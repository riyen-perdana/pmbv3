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
        Schema::create('instansi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('abbr_instansi')->comment('Kode Singkatan Instansi');
            $table->string('nm_instansi')->comment('Nama Instansi');
            $table->string('almt_instansi')->comment('Alamat Instansi');
            $table->string('no_telp_instansi')->comment('Nomor Telepon Instansi');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansi');
    }
};
