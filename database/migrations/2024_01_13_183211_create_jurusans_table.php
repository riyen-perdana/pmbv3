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
        Schema::create('jurusan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kd_jurusan')->comment('Kode Jurusan Di Sekolah Menengah Umum/Kejuruan');
            $table->string('ket_jurusan')->comment('Keterangan Jurusan Di Sekolah Menengah Umum/Kejuruan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};
