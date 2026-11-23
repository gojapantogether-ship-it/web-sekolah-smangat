<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Pengumuman'); // Pengumuman, Berita, Prestasi, dsb.
            $table->text('ringkasan')->nullable();
            $table->longText('konten'); // Tempat menaruh tulisan informasi
            $table->string('gambar')->nullable(); // Template tempat menaruh gambar
            $table->boolean('is_published')->default(true);
            $table->date('tanggal_publikasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
