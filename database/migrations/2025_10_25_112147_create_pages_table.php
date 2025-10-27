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
        Schema::create('pages', function (Blueprint $table) {
            $table->id('id_page');
            $table->unsignedBigInteger('ilustrasi_id')->nullable();
            $table->string('kode_page')->unique();
            $table->string('judul');
            $table->string('sub_judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('button_primary_text')->nullable();
            $table->string('button_primary_link')->nullable();
            $table->string('button_secondary_text')->nullable();
            $table->string('button_secondary_link')->nullable();
            $table->enum('status', ['public', 'draft'])->default('draft');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('ilustrasi_id')->references('id_ilustrasi')->on('ilustrasis')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
