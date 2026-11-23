<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Information;
use App\Models\PpdbInfo;
use App\Models\SchoolProfile;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smangat.sch.id'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('password'),
            ]
        );

        $profile = SchoolProfile::current();
        $profile->update([
            'foto_sekolah' => $profile->foto_sekolah ?: 'sekolah/gedung-utama.jpg',
            'sejarah_sekolah' => $profile->sejarah_sekolah ?: "Didirikan pada tahun 1995, sekolah ini bermula dari semangat masyarakat dan pemerintah daerah untuk menghadirkan pendidikan berkualitas. Seiring waktu, berbagai fasilitas modern seperti laboratorium sains, perpustakaan digital, dan ruang multimedia terus dikembangkan demi menunjang prestasi siswa di tingkat regional maupun nasional.",
            'visi_misi' => $profile->visi_misi ?: "Visi:\nMenjadi sekolah unggul yang berkarakter, berprestasi, dan berwawasan lingkungan.\n\nMisi:\n1. Menyelenggarakan pembelajaran aktif, kreatif, dan berbasis teknologi.\n2. Membentuk peserta didik yang berakhlak mulia, disiplin, dan peduli sesama.\n3. Mengembangkan bakat dan minat siswa di bidang akademik maupun non-akademik.",
            'npsn' => $profile->npsn ?: '20109999',
            'akreditasi' => $profile->akreditasi ?: 'A (Unggul)',
            'foto_kepala_sekolah' => $profile->foto_kepala_sekolah ?: 'kepala-sekolah/kepala-sekolah-dummy.jpg',
            'motivasi_kepala_sekolah' => $profile->motivasi_kepala_sekolah ?: "\"Pendidikan bukan sekadar mengisi wadah, melainkan menyalakan api semangat belajar sepanjang hayat. Mari bersama melangkah menuju masa depan gemilang.\"",
            'email' => $profile->email ?: 'info@smangat.sch.id',
            'fax' => $profile->fax ?: '(021) 1234-5679',
        ]);

        if (PpdbInfo::count() === 0) {
            PpdbInfo::create([
                'judul' => 'Penerimaan Peserta Didik Baru (PPDB) Gelombang 1',
                'tahun_ajaran' => '2026/2027',
                'tanggal_mulai' => now()->toDateString(),
                'tanggal_selesai' => now()->addMonth()->toDateString(),
                'deskripsi' => 'Pendaftaran peserta didik baru telah dibuka. Silakan siapkan berkas persyaratan dan ikuti jadwal yang ditentukan.',
                'persyaratan' => "1. Fotokopi Ijazah / SKL yang dilegalisir\n2. Fotokopi Kartu Keluarga (KK) & Akta Kelahiran\n3. Pas foto berwarna ukuran 3x4 (3 lembar)\n4. Rapor semester 1 s.d. 5",
                'link_pendaftaran' => 'https://ppdb.smangat.sch.id',
                'is_active' => true,
            ]);
        }

        if (Gallery::count() === 0) {
            Gallery::create([
                'judul' => 'Gedung Utama & Halaman Depan Sekolah',
                'deskripsi' => 'Suasana asri gedung utama tiga lantai dengan taman hijau dan halaman upacara yang tertata rapi.',
                'foto' => 'galeri/gedung-sekolah.jpg',
            ]);

            Gallery::create([
                'judul' => 'Praktikum Siswa di Laboratorium Sains',
                'deskripsi' => 'Kegiatan praktikum IPA terpadu bersama guru pembimbing menggunakan fasilitas laboratorium modern.',
                'foto' => 'galeri/laboratorium-sains.jpg',
            ]);

            Gallery::create([
                'judul' => 'Diskusi Kelompok di Taman Belajar Sekolah',
                'deskripsi' => 'Para siswa berkolaborasi mengerjakan proyek kreatif berbasis literasi digital di ruang terbuka hijau.',
                'foto' => 'galeri/diskusi-taman.jpg',
            ]);
        }

        if (Information::count() === 0) {
            Information::create([
                'judul' => 'Jadwal Asesmen Sumatif Akhir Semester Genap',
                'slug' => 'jadwal-asesmen-sumatif-akhir-semester-genap',
                'kategori' => 'Pengumuman',
                'ringkasan' => 'Diberitahukan kepada seluruh siswa dan wali murid mengenai pelaksanaan Asesmen Akhir Semester yang akan dimulai pekan depan.',
                'konten' => "Yth. Bapak/Ibu Wali Murid dan Seluruh Siswa/i,\n\nDengan ini kami menginformasikan bahwa Asesmen Sumatif Akhir Semester Genap akan dilaksanakan mulai tanggal 1 hingga 10 Juni 2026.\n\nBeberapa hal yang perlu diperhatikan:\n1. Siswa wajib hadir 15 menit sebelum ujian dimulai dengan mengenakan seragam lengkap.\n2. Kartu peserta ujian wajib dibawa setiap hari pelaksanaan ujian.\n3. Dilarang membawa alat komunikasi genggam (handphone) ke dalam ruang ujian.\n\nDemikian informasi ini disampaikan. Mohon dukungan bimbingan belajar siswa di rumah.",
                'gambar' => 'informasi/dummy-1.jpg',
                'is_published' => true,
                'tanggal_publikasi' => now()->subDays(2)->toDateString(),
            ]);

            Information::create([
                'judul' => 'Prestasi Gemilang: Tim Olimpiade Sains Meraih Medali Emas',
                'slug' => 'prestasi-gemilang-tim-olimpiade-sains-meraih-medali-emas',
                'kategori' => 'Prestasi',
                'ringkasan' => 'Siswa sekolah kita kembali menorehkan prestasi membanggakan pada ajang Olimpiade Sains tingkat provinsi.',
                'konten' => "Selamat dan apresiasi setinggi-tingginya kepada Tim Sains Sekolah yang berhasil meraih Juara 1 dan Medali Emas dalam kompetisi sains tingkat provinsi.\n\nPrestasi ini merupakan buah dari kerja keras, dedikasi siswa, serta bimbingan intensif para guru pembina. Semoga pencapaian ini dapat menginspirasi seluruh siswa/i untuk terus berprestasi.",
                'gambar' => 'informasi/dummy-2.jpg',
                'is_published' => true,
                'tanggal_publikasi' => now()->subDays(5)->toDateString(),
            ]);

            Information::create([
                'judul' => 'Peringatan Hari Guru Nasional dan Gebyar Seni Siswa',
                'slug' => 'peringatan-hari-guru-nasional-dan-gebyar-seni-siswa',
                'kategori' => 'Kegiatan',
                'ringkasan' => 'Kemeriahan peringatan hari guru dan pentas seni yang menampilkan beragam kreativitas dan karya siswa.',
                'konten' => "Sekolah menyelenggarakan rangkaian acara peringatan Hari Guru Nasional yang dirangkaikan dengan pameran karya siswa dan pentas seni budaya.\n\nAcara dimulai dengan upacara khidmat di lapangan utama, dilanjutkan dengan persembahan puisi, tari tradisional, serta pertunjukan musik akustik dari perwakilan tiap angkatan.",
                'gambar' => 'informasi/dummy-3.jpg',
                'is_published' => true,
                'tanggal_publikasi' => now()->subDays(8)->toDateString(),
            ]);
        }

        if (Teacher::count() === 0) {
            Teacher::create([
                'nama' => 'Dra. Siti Aminah, M.Pd.',
                'nip' => '197804122005012004',
                'kategori' => 'Guru',
                'jabatan' => 'Waka Kurikulum',
                'mata_pelajaran' => 'Matematika',
                'bio' => 'Berpengalaman 18 tahun membimbing siswa dalam olimpiade matematika tingkat kota dan provinsi.',
            ]);

            Teacher::create([
                'nama' => 'Rizky Pratama, S.Kom., M.T.',
                'nip' => '198907152015031002',
                'kategori' => 'Guru',
                'jabatan' => 'Pembina Ekskul Robotik',
                'mata_pelajaran' => 'Informatika & TIK',
                'bio' => 'Aktif mengembangkan pembelajaran berbasis pemrograman, IoT, dan literasi digital sekolah.',
            ]);

            Teacher::create([
                'nama' => 'Nadia Kusuma, S.Pd.',
                'nip' => '199211032019032007',
                'kategori' => 'Guru',
                'jabatan' => 'Wali Kelas XII',
                'mata_pelajaran' => 'Bahasa Inggris',
                'bio' => 'Pembimbing English Club dan lomba debat bahasa Inggris antar pelajar.',
            ]);

            Teacher::create([
                'nama' => 'Hendra Wijaya, S.E.',
                'nip' => '198305202010011009',
                'kategori' => 'Tenaga Kependidikan',
                'jabatan' => 'Kepala Tata Usaha (TU)',
                'mata_pelajaran' => null,
                'bio' => 'Mengelola layanan administrasi sekolah, kearsipan, serta pelayanan surat-menyurat siswa.',
            ]);
        }

        if (Extracurricular::count() === 0) {
            Extracurricular::create([
                'nama' => 'Pramuka Penegak',
                'pembina' => 'Budi Santoso, S.Pd.',
                'jadwal' => 'Setiap Jumat, 15.00 - 17.00 WIB',
                'deskripsi' => 'Membentuk karakter kepemimpinan, kemandirian, kedisiplinan, dan kepedulian sosial melalui kegiatan kepanduan.',
                'foto' => 'galeri/diskusi-taman.jpg',
            ]);

            Extracurricular::create([
                'nama' => 'KIR & Robotik Sains',
                'pembina' => 'Rizky Pratama, S.Kom., M.T.',
                'jadwal' => 'Setiap Rabu, 15.30 - 17.00 WIB',
                'deskripsi' => 'Wadah riset ilmiah remaja, perakitan robotik, serta persiapan kompetisi OSN dan karya tulis ilmiah.',
                'foto' => 'galeri/laboratorium-sains.jpg',
            ]);

            Extracurricular::create([
                'nama' => 'Paskibra Sekolah',
                'pembina' => 'Andi Kurniawan, S.Or.',
                'jadwal' => 'Setiap Selasa & Kamis, 15.30 - 17.30 WIB',
                'deskripsi' => 'Melatih ketangkasan baris-berbaris, kedisiplinan tinggi, serta bertugas pada upacara resmi sekolah dan daerah.',
                'foto' => 'galeri/gedung-sekolah.jpg',
            ]);
        }

        if (Achievement::count() === 0) {
            Achievement::create([
                'judul' => 'Medali Emas Olimpiade Sains Nasional (OSN) Bidang Kimia',
                'peraih' => 'Aulia Rahman & Tim Sains',
                'tingkat' => 'Nasional',
                'tahun' => '2026',
                'deskripsi' => 'Berhasil meraih peringkat pertama dan medali emas menyisihkan peserta dari berbagai provinsi.',
                'foto' => 'galeri/laboratorium-sains.jpg',
            ]);

            Achievement::create([
                'judul' => 'Juara 1 Lomba Karya Tulis Ilmiah Remaja',
                'peraih' => 'Tim KIR SMANGAT',
                'tingkat' => 'Provinsi',
                'tahun' => '2026',
                'deskripsi' => 'Inovasi alat pemantau kualitas udara sekolah berbasis sensor cerdas.',
                'foto' => 'galeri/diskusi-taman.jpg',
            ]);

            Achievement::create([
                'judul' => 'Juara Umum Lomba Paskibra Antar Pelajar',
                'peraih' => 'Pasukan Inti Paskibra',
                'tingkat' => 'Kota/Kabupaten',
                'tahun' => '2025',
                'deskripsi' => 'Memenangkan kategori formasi terbaik, komandan terbaik, dan variasi PBB.',
                'foto' => 'galeri/gedung-sekolah.jpg',
            ]);
        }

        if (HeroSlide::count() === 0) {
            HeroSlide::create([
                'judul' => 'Gedung Utama Kampus Sekolah',
                'gambar' => 'hero-slides/slide-1.jpg',
                'urutan' => 1,
                'is_active' => true,
            ]);

            HeroSlide::create([
                'judul' => 'Kegiatan Belajar di Laboratorium Sains',
                'gambar' => 'hero-slides/slide-2.jpg',
                'urutan' => 2,
                'is_active' => true,
            ]);

            HeroSlide::create([
                'judul' => 'Diskusi Siswa di Taman Sekolah',
                'gambar' => 'hero-slides/slide-3.jpg',
                'urutan' => 3,
                'is_active' => true,
            ]);
        }
    }
}
