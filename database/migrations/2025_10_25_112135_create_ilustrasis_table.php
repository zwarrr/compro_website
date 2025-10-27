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
        Schema::create('ilustrasis', function (Blueprint $table) {
            $table->id('id_ilustrasi');
            $table->string('kode_ilustrasi')->unique();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['public', 'draft'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ilustrasis');
    }
};
