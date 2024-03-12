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
        Schema::create('rektor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_user')->unique()->comment('ID User Relasi Dengan Tabel Rektor');
            $table->date('rkt_awl_jbt')->comment('Tanggal Awal Rektor Menjabat');
            $table->date('rkt_akh_jbt')->comment('Tanggal Akhir Rektor Menjabat');
            $table->enum('is_rektor_aktif',['Y','N'])->comment('Apakah Rektor Aktif Menjabat?')->default('N');
            $table->enum('is_rektor_plt',['Y','N'])->comment('Apakah Rektor PLT?')->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rektor');
    }
};
