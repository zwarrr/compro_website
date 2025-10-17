<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sosial_media', function (Blueprint $table) {
            $table->id('id_sosial');
            $table->string('kode_sosial')->unique();
            $table->string('nama_sosmed', 100);
            $table->string('username', 150)->nullable();
            $table->string('url', 255);
            $table->string('icon', 100)->nullable();
            $table->string('warna', 20)->nullable();
            $table->enum('status', ['publik', 'draft'])->default('publik');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sosial_media');
    }
};
