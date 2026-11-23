<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'sambutan_judul',
        'sambutan_isi',
        'profil_sekolah',
        'foto_sekolah',
        'sejarah_sekolah',
        'visi_misi',
        'npsn',
        'akreditasi',
        'nama_kepala_sekolah',
        'profil_kepala_sekolah',
        'foto_kepala_sekolah',
        'motivasi_kepala_sekolah',
        'jumlah_guru',
        'jumlah_siswa',
        'alamat',
        'kontak',
        'email',
        'fax',
    ];

    public static function current(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'SMA NEGERI 1 BENDUNGAN',
                'sambutan_judul' => 'Selamat Datang di Website Resmi Sekolah',
                'sambutan_isi' => 'Assalamu\'alaikum Wr. Wb. Selamat datang di portal informasi resmi sekolah kami. Silakan jelajahi profil sekolah, informasi PPDB, dan galeri kegiatan sekolah.',
                'profil_sekolah' => 'SMA NEGERI 1 BENDUNGAN adalah lembaga pendidikan menengah atas yang berfokus pada pengembangan potensi akademik, karakter mulia, dan kecakapan abad ke-21.',
                'sejarah_sekolah' => "Didirikan pada tahun 1995, sekolah ini bermula dari semangat masyarakat dan pemerintah daerah untuk menghadirkan pendidikan berkualitas. Seiring waktu, berbagai fasilitas modern seperti laboratorium sains, perpustakaan digital, dan ruang multimedia terus dikembangkan demi menunjang prestasi siswa di tingkat regional maupun nasional.",
                'visi_misi' => "Visi:\nMenjadi sekolah unggul yang berkarakter, berprestasi, dan berwawasan lingkungan.\n\nMisi:\n1. Menyelenggarakan pembelajaran aktif, kreatif, dan berbasis teknologi.\n2. Membentuk peserta didik yang berakhlak mulia, disiplin, dan peduli sesama.\n3. Mengembangkan bakat dan minat siswa di bidang akademik maupun non-akademik.",
                'npsn' => '20109999',
                'akreditasi' => 'A (Unggul)',
                'nama_kepala_sekolah' => 'Drs. H. Ahmad Fauzan, M.Pd.',
                'profil_kepala_sekolah' => "Lulusan Magister Pendidikan dengan pengalaman lebih dari 20 tahun di dunia pendidikan menengah. Aktif mendorong inovasi kurikulum merdeka, literasi digital, serta pembinaan karakter peserta didik.",
                'motivasi_kepala_sekolah' => "\"Pendidikan bukan sekadar mengisi wadah, melainkan menyalakan api semangat belajar sepanjang hayat. Mari bersama melangkah menuju masa depan gemilang.\"",
                'jumlah_guru' => 45,
                'jumlah_siswa' => 720,
                'alamat' => 'Jl. Pendidikan No. 1, Kec. Harapan, Kota Nusantara',
                'kontak' => '(021) 1234-5678',
                'email' => 'info@smangat.sch.id',
                'fax' => '(021) 1234-5679',
            ]
        );
    }
}
