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
        Schema::create('akreditasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jns_akreditasi')->comment('Jenis Akreditasi');
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Akreditasi Aktif?')->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akreditasi');
    }
};
