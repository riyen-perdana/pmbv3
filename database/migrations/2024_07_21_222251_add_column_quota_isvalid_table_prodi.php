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
        Schema::table('prodi', function (Blueprint $table) {
            $table->integer('quota')->comment('Jumlah Kuota Prodi')->nullable()->after('is_pil_34');
            $table->enum('is_valid',['Y','N'])->comment('Status Validasi')->nullable()->after('quota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->dropColumn('quota');
            $table->dropColumn('is_valid');
        });
    }
};
