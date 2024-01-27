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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('slug');
            $table->date('tanggal_kegiatan');
            $table->date('tanggal_selesai');
            $table->date('pendaftaran');
            $table->integer('partisipasi')->default(0);
            $table->integer('max_partisipasi');
            $table->decimal('anggaran', 10, 0);
            $table->enum('status',['Pendaftaran','Selesai','Sedang Berlangsung','Dibatalkan'])->default('Pendaftaran');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
