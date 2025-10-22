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
        Schema::create('lokers', function (Blueprint $table) {
            $table->id('id_loker');
            $table->string('kode_loker', 20)->unique();
            $table->string('posisi', 100);
            $table->string('perusahaan', 100);
            $table->string('lokasi', 100);
            $table->text('deskripsi')->nullable();
            $table->integer('gaji_awal')->nullable();
            $table->integer('gaji_akhir')->nullable();
            $table->string('pengalaman', 50)->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokers');
    }
};
