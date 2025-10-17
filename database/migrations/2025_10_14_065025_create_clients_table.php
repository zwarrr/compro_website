<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('client', function (Blueprint $table) {
            $table->id('id_client');
            $table->string('kode_client')->unique();
            $table->foreignId('kategori_id')->constrained('kategori', 'id_kategori')->onDelete('cascade');
            $table->string('nama_client');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['publik', 'draft'])->default('publik');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('client');
    }
};
