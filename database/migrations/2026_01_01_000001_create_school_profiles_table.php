<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah')->default('SMA Negeri Contoh');
            $table->string('sambutan_judul')->default('Selamat Datang di Website Resmi Sekolah');
            $table->text('sambutan_isi')->nullable();
            $table->text('profil_sekolah')->nullable();
            $table->string('nama_kepala_sekolah')->nullable();
            $table->text('profil_kepala_sekolah')->nullable();
            $table->string('foto_kepala_sekolah')->nullable();
            $table->unsignedInteger('jumlah_guru')->default(0);
            $table->unsignedInteger('jumlah_siswa')->default(0);
            $table->string('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
