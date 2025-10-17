<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id('id_kontak');
            $table->string('kode_kontak')->unique();
            $table->string('nama');
            $table->string('email');
            $table->string('subjek')->nullable();
            $table->text('pesan');
            $table->enum('status_baca', ['belum', 'sudah'])->default('belum');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kontak');
    }
};
