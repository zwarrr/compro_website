<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->id('id_faq');
            $table->string('kode_faq')->unique();
            $table->string('pertanyaan', 255);
            $table->text('jawaban')->nullable();
            $table->enum('status', ['publik', 'draft'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq');
    }
};
