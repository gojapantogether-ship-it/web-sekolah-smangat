@extends('layouts.admin')

@section('title', 'Tambah Informasi Sekolah')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <div>
            <h1 style="margin:0;">Tambah Informasi Sekolah</h1>
            <p style="color:var(--text-muted); margin:4px 0 0;">Isi formulir dan unggah gambar informasi sekolah.</p>
        </div>
        <a class="btn" href="{{ route('admin.informasi.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf

        <div style="background: var(--toska-50); border: 1px dashed var(--toska-500); padding: 14px 18px; border-radius: 10px; margin-bottom: 20px;">
            <strong style="color: var(--toska-900); font-size: 0.95rem;">Panduan Template Penulisan Informasi:</strong>
            <p style="margin: 4px 0 0; font-size: 0.88rem; color: var(--toska-800);">
                Gunakan template ini untuk menerbitkan pengumuman, berita prestasi, atau agenda kegiatan sekolah. Anda dapat menyematkan satu gambar utama berkualitas dan isi tulisan secara terstruktur.
            </p>
        </div>

        {{-- BAGIAN 1: TEMPAT MENARUH TULISAN INFORMASI --}}
        <h3 style="border-bottom: 2px solid var(--toska-100); padding-bottom: 6px; color: var(--toska-900); margin-top: 10px;">
            1. Tempat Menaruh Tulisan Informasi
        </h3>

        <label for="judul">Judul Informasi <span style="color:#ef4444;">*</span></label>
        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Pengumuman Pembagian Rapor Semester Ganjil" required autofocus>

        <div class="grid" style="margin-top: 10px;">
            <div>
                <label for="kategori">Kategori Informasi <span style="color:#ef4444;">*</span></label>
                <select id="kategori" name="kategori" required>
                    <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Berita" {{ old('kategori') == 'Berita' ? 'selected' : '' }}>Berita Sekolah</option>
                    <option value="Prestasi" {{ old('kategori') == 'Prestasi' ? 'selected' : '' }}>Prestasi Siswa/Guru</option>
                    <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan & Ekstrakurikuler</option>
                    <option value="Akademik" {{ old('kategori') == 'Akademik' ? 'selected' : '' }}>Informasi Akademik</option>
                </select>
            </div>
            <div>
                <label for="tanggal_publikasi">Tanggal Publikasi</label>
                <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', date('Y-m-d')) }}">
            </div>
        </div>

        <label for="ringkasan">Ringkasan Singkat (Lead / Cuplikan)</label>
        <textarea id="ringkasan" name="ringkasan" style="min-height: 70px;" placeholder="Tuliskan 1-2 kalimat ringkasan yang menarik untuk ditampilkan pada kartu halaman utama...">{{ old('ringkasan') }}</textarea>

        <label for="konten">Isi Konten Informasi Lengkap <span style="color:#ef4444;">*</span></label>
        <textarea id="konten" name="konten" style="min-height: 200px;" placeholder="Tuliskan seluruh isi informasi secara lengkap di sini. Anda dapat menggunakan baris baru atau penomoran poin-poin..." required>{{ old('konten') }}</textarea>

        {{-- BAGIAN 2: TEMPAT MENARUH GAMBAR INFORMASI --}}
        <h3 style="border-bottom: 2px solid var(--toska-100); padding-bottom: 6px; color: var(--toska-900); margin-top: 28px;">
            2. Template Menaruh Gambar Informasi
        </h3>

        <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: 12px; padding: 16px; margin-top: 10px;">
            <label for="gambar" style="margin-top: 0;">Pilih File Gambar / Foto Informasi</label>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 2px 0 10px;">Format: JPG, PNG, WEBP (Maksimal 4 MB). Disarankan rasio landscape (16:9 atau 4:3).</p>
            <input type="file" id="gambar" name="gambar" accept="image/*">
        </div>

        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border);">
            <label style="display:inline-flex; align-items:center; gap:8px; font-weight: normal; cursor: pointer;">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} style="width: auto; margin: 0;">
                <span style="font-weight: 600; color: var(--text-dark);">Langsung publikasikan informasi ini di web</span>
            </label>
        </div>

        <div style="margin-top: 24px; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">Simpan Informasi</button>
            <a href="{{ route('admin.informasi.index') }}" class="btn">Batal</a>
        </div>
    </form>
@endsection
