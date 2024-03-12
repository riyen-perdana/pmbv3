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
        Schema::create('jenjang', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('kd_jenjang',3)->comment('Kode Jenjang Pendidikan')->unique();
            $table->string('nm_jenjang')->comment('Nama Jenjang Pendidikan');
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Akreditasi Aktif?')->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenjang');
    }
};
