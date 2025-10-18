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
        Schema::table('karyawan', function (Blueprint $table) {
            // Hapus constraint unique dari nik dan ubah jadi nullable dengan default "-"
            $table->string('nik')->default('-')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            // Kembalikan ke kondisi awal: unique tanpa default
            $table->string('nik')->unique()->change();
        });
    }
};
