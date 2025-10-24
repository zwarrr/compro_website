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
        Schema::create('pengetahuans', function (Blueprint $table) {
            $table->bigIncrements('id_pengetahuan');
            $table->string('kode_pengetahuan', 50)->unique();
            $table->string('kategori_pertanyaan', 100);
            $table->string('sub_kategori', 100)->nullable();
            $table->text('jawaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengetahuans');
    }
};
