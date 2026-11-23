<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Information;
use App\Models\PpdbInfo;
use App\Models\SchoolProfile;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SchoolWebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_load_successfully(): void
    {
        $profile = SchoolProfile::current();

        $info = Information::create([
            'judul' => 'Pengumuman Libur Semester',
            'slug' => 'pengumuman-libur-semester',
            'kategori' => 'Pengumuman',
            'ringkasan' => 'Diberitahukan perihal libur semester genap.',
            'konten' => 'Berikut jadwal lengkap libur semester genap tahun 2026.',
            'is_published' => true,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee($profile->sambutan_judul)
            ->assertSee((string) $profile->jumlah_guru)
            ->assertSee((string) $profile->jumlah_siswa)
            ->assertSee('Pengumuman Libur Semester');

        $this->get('/profil')->assertOk()->assertSee($profile->nama_sekolah);
        $this->get('/guru')->assertOk()->assertSee('Direktori Guru');
        $this->get('/ekstrakurikuler')->assertOk()->assertSee('Ekstrakurikuler');
        $this->get('/prestasi')->assertOk()->assertSee('Pojok Prestasi');
        $this->get('/ppdb')->assertOk()->assertSee('Informasi PPDB');
        $this->get('/galeri')->assertOk()->assertSee('Galeri Foto Sekolah');
        $this->get('/informasi')->assertOk()->assertSee('Pengumuman Libur Semester');
        $this->get('/informasi/' . $info->slug)->assertOk()->assertSee('Pengumuman Libur Semester');
    }

    public function test_admin_routes_require_authentication(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/guru')->assertRedirect('/admin/login');
        $this->get('/admin/ekstrakurikuler')->assertRedirect('/admin/login');
        $this->get('/admin/prestasi')->assertRedirect('/admin/login');
        $this->get('/admin/ppdb')->assertRedirect('/admin/login');
        $this->get('/admin/galeri')->assertRedirect('/admin/login');
        $this->get('/admin/informasi')->assertRedirect('/admin/login');
    }

    public function test_admin_can_update_teacher_and_student_counts(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->put('/admin/statistik', [
                'jumlah_guru' => 55,
                'jumlah_siswa' => 810,
            ])
            ->assertRedirect('/admin');

        $this->assertDatabaseHas('school_profiles', [
            'id' => 1,
            'jumlah_guru' => 55,
            'jumlah_siswa' => 810,
        ]);

        $this->get('/')->assertSee('55')->assertSee('810');
    }

    public function test_admin_can_manage_ppdb_and_gallery(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post('/admin/ppdb', [
                'judul' => 'PPDB Gelombang 2',
                'tahun_ajaran' => '2026/2027',
                'deskripsi' => 'Pendaftaran gelombang 2 dibuka.',
                'is_active' => '1',
            ])
            ->assertRedirect('/admin/ppdb');

        $this->assertDatabaseHas('ppdb_infos', ['judul' => 'PPDB Gelombang 2']);
        $this->get('/ppdb')->assertSee('PPDB Gelombang 2');

        $file = UploadedFile::fake()->create('upacara.jpg', 100, 'image/jpeg');

        $this->actingAs($admin)
            ->post('/admin/galeri', [
                'judul' => 'Upacara Bendera',
                'deskripsi' => 'Kegiatan hari Senin',
                'foto' => $file,
            ])
            ->assertRedirect('/admin/galeri');

        $gallery = Gallery::first();
        $this->assertNotNull($gallery);
        Storage::disk('public')->assertExists($gallery->foto);
        $this->get('/galeri')->assertSee('Upacara Bendera');
    }

    public function test_admin_can_manage_information(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();

        $file = UploadedFile::fake()->create('berita.jpg', 150, 'image/jpeg');

        $this->actingAs($admin)
            ->post('/admin/informasi', [
                'judul' => 'Karya Ilmiah Siswa Lolos Nasional',
                'kategori' => 'Prestasi',
                'ringkasan' => 'Dua siswa berhasil melaju ke tingkat nasional.',
                'konten' => 'Isi tulisan lengkap tentang karya ilmiah siswa...',
                'gambar' => $file,
                'is_published' => '1',
            ])
            ->assertRedirect('/admin/informasi');

        $info = Information::first();
        $this->assertNotNull($info);
        $this->assertEquals('Karya Ilmiah Siswa Lolos Nasional', $info->judul);
        Storage::disk('public')->assertExists($info->gambar);

        $this->get('/informasi')->assertSee('Karya Ilmiah Siswa Lolos Nasional');
        $this->get('/informasi/' . $info->slug)->assertSee('Karya Ilmiah Siswa Lolos Nasional');

        // Admin update
        $this->actingAs($admin)
            ->put('/admin/informasi/' . $info->id, [
                'judul' => 'Karya Ilmiah Siswa Raih Juara 1 Nasional',
                'kategori' => 'Prestasi',
                'ringkasan' => 'Update perolehan medali emas nasional.',
                'konten' => 'Konten yang sudah diperbarui...',
                'is_published' => '1',
            ])
            ->assertRedirect('/admin/informasi');

        $this->assertDatabaseHas('information', [
            'id' => $info->id,
            'judul' => 'Karya Ilmiah Siswa Raih Juara 1 Nasional',
        ]);
    }

    public function test_admin_can_update_school_profile_principal_and_contacts(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();

        $schoolPhoto = UploadedFile::fake()->create('sekolah.jpg', 120, 'image/jpeg');
        $principalPhoto = UploadedFile::fake()->create('kepsek.jpg', 120, 'image/jpeg');

        $this->actingAs($admin)
            ->put('/admin/profil', [
                'nama_sekolah' => 'SMA Negeri Harapan Bangsa',
                'sambutan_judul' => 'Selamat Datang di SMA Harapan Bangsa',
                'sambutan_isi' => 'Sambutan hangat dari kami.',
                'profil_sekolah' => 'Sekolah unggulan berbasis teknologi.',
                'foto_sekolah' => $schoolPhoto,
                'sejarah_sekolah' => 'Berdiri sejak tahun 1995.',
                'visi_misi' => 'Visi unggul dan berkarakter.',
                'npsn' => '20108888',
                'akreditasi' => 'A',
                'nama_kepala_sekolah' => 'Dr. Budi Santoso, M.Pd.',
                'profil_kepala_sekolah' => 'Bio singkat kepala sekolah.',
                'foto_kepala_sekolah' => $principalPhoto,
                'motivasi_kepala_sekolah' => 'Teruslah belajar dan berkarya.',
                'jumlah_guru' => 50,
                'jumlah_siswa' => 800,
                'alamat' => 'Jl. Merdeka No. 99',
                'kontak' => '(021) 8888-9999',
                'email' => 'kontak@harapanbangsa.sch.id',
                'fax' => '(021) 8888-0000',
            ])
            ->assertRedirect('/admin/profil');

        $profile = SchoolProfile::current();
        Storage::disk('public')->assertExists($profile->foto_sekolah);
        Storage::disk('public')->assertExists($profile->foto_kepala_sekolah);

        $this->get('/')
            ->assertOk()
            ->assertSee('kontak@harapanbangsa.sch.id')
            ->assertSee('(021) 8888-0000')
            ->assertSee('(021) 8888-9999');

        $this->get('/profil')
            ->assertOk()
            ->assertSee('Berdiri sejak tahun 1995.')
            ->assertSee('Dr. Budi Santoso, M.Pd.')
            ->assertSee('Teruslah belajar dan berkarya.');
    }

    public function test_admin_can_manage_teachers_extracurriculars_and_achievements(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post('/admin/guru', [
                'nama' => 'Pak Joko, S.Pd.',
                'kategori' => 'Guru',
                'mata_pelajaran' => 'Fisika',
            ])
            ->assertRedirect('/admin/guru');

        $this->assertDatabaseHas('teachers', ['nama' => 'Pak Joko, S.Pd.']);
        $this->get('/guru')->assertOk()->assertSee('Pak Joko, S.Pd.');

        $this->actingAs($admin)
            ->post('/admin/ekstrakurikuler', [
                'nama' => 'Basket Putra',
                'pembina' => 'Coach Andi',
                'jadwal' => 'Sabtu, 09.00 WIB',
            ])
            ->assertRedirect('/admin/ekstrakurikuler');

        $this->assertDatabaseHas('extracurriculars', ['nama' => 'Basket Putra']);
        $this->get('/ekstrakurikuler')->assertOk()->assertSee('Basket Putra');

        $this->actingAs($admin)
            ->post('/admin/prestasi', [
                'judul' => 'Juara 1 Basket Provinsi',
                'peraih' => 'Tim Basket SMANGAT',
                'tingkat' => 'Provinsi',
                'tahun' => '2026',
            ])
            ->assertRedirect('/admin/prestasi');

        $this->assertDatabaseHas('achievements', ['judul' => 'Juara 1 Basket Provinsi']);
        $this->get('/prestasi')->assertOk()->assertSee('Juara 1 Basket Provinsi');

        Storage::fake('public');
        $slideFile = UploadedFile::fake()->create('slide.jpg', 120, 'image/jpeg');

        $this->actingAs($admin)
            ->post('/admin/hero-slides', [
                'judul' => 'Slide Kampus Pagi',
                'gambar' => $slideFile,
                'urutan' => 1,
                'is_active' => '1',
            ])
            ->assertRedirect('/admin/hero-slides');

        $slide = HeroSlide::first();
        $this->assertNotNull($slide);
        Storage::disk('public')->assertExists($slide->gambar);
        $this->get('/')->assertOk()->assertSee($slide->gambar);
    }
}
