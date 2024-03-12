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
        Schema::create('dekan', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('id_dekan')->unique()->comment('UUID Dekan pada Tabel User');
            //$table->string('id_user')->constrained()->unique()->comment('ID User Relasi Dengan Tabel ');
            $table->string('id_prodi')->comment('ID Program Studi Dekan');
            $table->enum('is_dekan_aktif',['Y','N'])->comment('Apakah Dekan Aktif Menjabat?')->default('N');
            $table->enum('is_dekan_plt',['Y','N'])->comment('Apakah Dekan PLT?')->default('N');
            $table->softDeletes();
            $table->timestamps();
            // $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            // $table->foreignUuid('id_prodi')->references('id')->on('prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dekan');
    }
};
