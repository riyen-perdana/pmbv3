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
        Schema::create('kabkot', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('prov_id')->comment('ID Provinsi Pada Tabel Provinsi');
            $table->string('nm_kabkot')->comment('Nama kabupaten Kota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabkot');
    }
};
