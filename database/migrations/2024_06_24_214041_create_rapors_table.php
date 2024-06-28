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
        Schema::create('rapor', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('peserta_id')->comment('ID Peserta');
            $table->float('n_mtk')->comment('Nilai Matematika');
            $table->float('n_bing')->comment('Nilai Bahasa Inggris');
            $table->text('file')->comment('Hasil Scan Rapor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapor');
    }
};
