@extends('layouts.admin')

@section('title', 'Edit Profil Sekolah, Kepala Sekolah & Kontak')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <div>
            <h1 style="margin:0;">Kelola Profil Sekolah, Kepala Sekolah &amp; Kontak</h1>
            <p style="color:var(--text-muted); margin:4px 0 0;">Seluruh perubahan di bawah ini langsung tampil di halaman Home dan Profil.</p>
        </div>
        <a class="btn" href="{{ route('profil') }}" target="_blank">Lihat Halaman Profil &rarr;</a>
    </div>

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 1. SAMBUTAN & IDENTITAS DASAR --}}
        <div class="card">
            <h2 style="margin-top:0; color:var(--toska-900); border-bottom:2px solid var(--toska-100); padding-bottom:8px;">
                1. Sambutan Halaman Utama (Home)
            </h2>

            <label for="nama_sekolah">Nama Sekolah</label>
            <input type="text" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $profile->nama_sekolah) }}" required>

            <label for="logo">Logo Sekolah</label>
            @if (file_exists(public_path('images/logo.png')))
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                    <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Logo Saat Ini" style="width:48px; height:48px; object-fit:contain; border:1px solid #e2e8f0; border-radius:8px; padding:4px; background:#fff;">
                    <span style="font-size:0.85rem; color:var(--text-muted);">Logo sekolah aktif saat ini</span>
                </div>
            @endif
            <input type="file" id="logo" name="logo" accept="image/png,image/jpeg,image/svg+xml,image/webp">
            <span style="font-size:0.8rem; color:var(--text-muted); display:block; margin-top:-6px; margin-bottom:12px;">Format: PNG, JPG, SVG, WebP (Maks: 2MB).</span>

            <label for="sambutan_judul">Judul Sambutan (Halaman Home)</label>
            <input type="text" id="sambutan_judul" name="sambutan_judul" value="{{ old('sambutan_judul', $profile->sambutan_judul) }}" required>

            <label for="sambutan_isi">Isi Sambutan Sekolah</label>
            <textarea id="sambutan_isi" name="sambutan_isi">{{ old('sambutan_isi', $profile->sambutan_isi) }}</textarea>
        </div>

        {{-- 2. PROFIL SEKOLAH DETAIL + FOTO SEKOLAH --}}
        <div class="card">
            <h2 style="margin-top:0; color:var(--toska-900); border-bottom:2px solid var(--toska-100); padding-bottom:8px;">
                2. Profil &amp; Sejarah Sekolah
            </h2>

            <div class="grid">
                <div>
                    <label for="npsn">NPSN</label>
                    <input type="text" id="npsn" name="npsn" value="{{ old('npsn', $profile->npsn) }}" placeholder="Contoh: 20109999">
                </div>
                <div>
                    <label for="akreditasi">Akreditasi</label>
                    <input type="text" id="akreditasi" name="akreditasi" value="{{ old('akreditasi', $profile->akreditasi) }}" placeholder="Contoh: A (Unggul)">
                </div>
            </div>

            <label for="profil_sekolah">Tentang Sekolah (Ringkasan Profil)</label>
            <textarea id="profil_sekolah" name="profil_sekolah">{{ old('profil_sekolah', $profile->profil_sekolah) }}</textarea>

            <label for="sejarah_sekolah">Sejarah Sekolah</label>
            <textarea id="sejarah_sekolah" name="sejarah_sekolah" style="min-height:140px;">{{ old('sejarah_sekolah', $profile->sejarah_sekolah) }}</textarea>

            <label for="visi_misi">Visi &amp; Misi Sekolah</label>
            <textarea id="visi_misi" name="visi_misi" style="min-height:140px;">{{ old('visi_misi', $profile->visi_misi) }}</textarea>

            <label for="foto_sekolah">Foto Sekolah (Tampil di Halaman Profil)</label>
            @if ($profile->foto_sekolah)
                <p style="margin:8px 0;">
                    <img src="{{ asset('storage/' . $profile->foto_sekolah) }}" alt="Foto Sekolah" style="max-width: 280px; border-radius:10px; border: 1px solid var(--border);">
                </p>
            @endif
            <input type="file" id="foto_sekolah" name="foto_sekolah" accept="image/*">
        </div>

        {{-- 3. PROFIL KEPALA SEKOLAH + FOTO + BIO + MOTIVASI --}}
        <div class="card">
            <h2 style="margin-top:0; color:var(--toska-900); border-bottom:2px solid var(--toska-100); padding-bottom:8px;">
                3. Profil Kepala Sekolah
            </h2>

            <label for="nama_kepala_sekolah">Nama Kepala Sekolah</label>
            <input type="text" id="nama_kepala_sekolah" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $profile->nama_kepala_sekolah) }}">

            <label for="profil_kepala_sekolah">Bio Singkat Kepala Sekolah</label>
            <textarea id="profil_kepala_sekolah" name="profil_kepala_sekolah">{{ old('profil_kepala_sekolah', $profile->profil_kepala_sekolah) }}</textarea>

            <label for="motivasi_kepala_sekolah">Sambutan Kata / Motivasi Kepala Sekolah</label>
            <textarea id="motivasi_kepala_sekolah" name="motivasi_kepala_sekolah" placeholder="Kata-kata sambutan atau motivasi dari kepala sekolah...">{{ old('motivasi_kepala_sekolah', $profile->motivasi_kepala_sekolah) }}</textarea>

            <label for="foto_kepala_sekolah">Foto Kepala Sekolah</label>
            @if ($profile->foto_kepala_sekolah)
                <p style="margin:8px 0;">
                    <img src="{{ asset('storage/' . $profile->foto_kepala_sekolah) }}" alt="Foto Kepala Sekolah" style="max-width: 180px; border-radius:10px; border: 1px solid var(--border);">
                </p>
            @endif
            <input type="file" id="foto_kepala_sekolah" name="foto_kepala_sekolah" accept="image/*">
        </div>

        {{-- 4. STATISTIK & KONTAK RESMI (TAMPIL DI HOME & PROFIL) --}}
        <div class="card">
            <h2 style="margin-top:0; color:var(--toska-900); border-bottom:2px solid var(--toska-100); padding-bottom:8px;">
                4. Data Statistik &amp; Kontak Sekolah (Tampil di Home)
            </h2>

            <div class="grid">
                <div>
                    <label for="jumlah_guru">Jumlah Guru</label>
                    <input type="number" id="jumlah_guru" name="jumlah_guru" min="0" value="{{ old('jumlah_guru', $profile->jumlah_guru) }}" required>
                </div>
                <div>
                    <label for="jumlah_siswa">Jumlah Siswa</label>
                    <input type="number" id="jumlah_siswa" name="jumlah_siswa" min="0" value="{{ old('jumlah_siswa', $profile->jumlah_siswa) }}" required>
                </div>
            </div>

            <label for="alamat">Alamat Lengkap Sekolah</label>
            <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $profile->alamat) }}">

            <div class="grid">
                <div>
                    <label for="kontak">Telepon (Telp)</label>
                    <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $profile->kontak) }}" placeholder="(021) 1234-5678">
                </div>
                <div>
                    <label for="fax">Nomor Fax</label>
                    <input type="text" id="fax" name="fax" value="{{ old('fax', $profile->fax) }}" placeholder="(021) 1234-5679">
                </div>
                <div>
                    <label for="email">Email Resmi</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" placeholder="info@sekolah.sch.id">
                </div>
            </div>
        </div>

        <p><button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 1rem;">Simpan Semua Perubahan</button></p>
    </form>
@endsection
