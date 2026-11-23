<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('foto_sekolah')->nullable()->after('profil_sekolah');
            $table->text('sejarah_sekolah')->nullable()->after('foto_sekolah');
            $table->text('visi_misi')->nullable()->after('sejarah_sekolah');
            $table->string('npsn')->nullable()->after('visi_misi');
            $table->string('akreditasi')->nullable()->after('npsn');
            $table->text('motivasi_kepala_sekolah')->nullable()->after('foto_kepala_sekolah');
            $table->string('email')->nullable()->after('kontak');
            $table->string('fax')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'foto_sekolah',
                'sejarah_sekolah',
                'visi_misi',
                'npsn',
                'akreditasi',
                'motivasi_kepala_sekolah',
                'email',
                'fax',
            ]);
        });
    }
};
