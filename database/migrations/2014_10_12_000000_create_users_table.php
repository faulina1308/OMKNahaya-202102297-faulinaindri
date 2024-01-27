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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('partisipasi')->default(0);
            $table->string('nama');
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->foreignId('stasi_id');
            $table->enum('peran', ['KetuaOMK','KetuaStasi','Anggota'])->default('Anggota');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('keanggotaan',['Aktif','Tidak Aktif', 'Alumni'])->default('Aktif');
            $table->date('tanggal_bergabung')->nullable();
            $table->string('password');
            
            $table->boolean('akun_aktif')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
