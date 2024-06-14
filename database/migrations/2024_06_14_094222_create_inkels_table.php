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
        Schema::create('inkel', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama')->comment('nama Jenis Kategori Prestasi');
            $table->integer('nilai')->comment('Nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inkel');
    }
};
