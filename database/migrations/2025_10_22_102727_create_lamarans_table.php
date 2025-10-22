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
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id('id_lamaran');
            // foreign key to lokers.id_loker
            $table->unsignedBigInteger('loker_id');
            $table->string('kode_lamaran', 50)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('email', 150);
            $table->string('resume')->nullable(); // path or filename
            $table->text('pesan')->nullable();
            $table->enum('status', ['Diajukan', 'Diterima', 'Ditolak', 'Dikirim'])->default('Diajukan');
            $table->text('catatan_hrd')->nullable();
            $table->dateTime('tanggal_interview')->nullable();
            $table->timestamps();

            $table->foreign('loker_id')->references('id_loker')->on('lokers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
