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
        Schema::create('fakultas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_akr_fakultas')->comment('UUID Akreditasi Fakultas');
            $table->string('id_user')->comment('UUID User')->nullable();
            $table->string('nm_fakultas')->comment('Nama Fakultas');
            $table->string('url_fakultas')->comment('Alamat URL Website Fakultas')->nullable();
            $table->string('url_akr_fakultas')->comment('Alamat URL Akreditasi Fakultas')->nullable();
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Fakultas Aktif?')->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas');
    }
};
