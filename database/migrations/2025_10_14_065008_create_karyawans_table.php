<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->string('kode_karyawan')->unique();
            $table->foreignId('kategori_id')->constrained('kategori', 'id_kategori')->onDelete('cascade');
            $table->string('nik')->default('-');
            $table->string('nama');
            $table->string('staff');
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif');
            $table->integer('posisi')->nullable(); // Tambah kolom posisi, bisa diupdate nanti
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('karyawan');
    }
};
