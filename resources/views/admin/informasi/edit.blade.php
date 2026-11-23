@extends('layouts.admin')

@section('title', 'Edit Informasi - ' . $informasi->judul)

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <div>
            <h1 style="margin:0;">Edit Informasi Sekolah</h1>
            <p style="color:var(--text-muted); margin:4px 0 0;">Perbarui tulisan maupun gambar informasi sekolah.</p>
        </div>
        <div style="display:flex; gap:8px;">
            <a class="btn" href="{{ route('informasi.detail', $informasi->slug) }}" target="_blank">Lihat di Web</a>
            <a class="btn" href="{{ route('admin.informasi.index') }}">&larr; Kembali</a>
        </div>
    </div>

    <form action="{{ route('admin.informasi.update', $informasi) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')

        {{-- BAGIAN 1: TEMPAT MENARUH TULISAN INFORMASI --}}
        <h3 style="border-bottom: 2px solid var(--toska-100); padding-bottom: 6px; color: var(--toska-900); margin-top: 10px;">
            1. Tempat Menaruh Tulisan Informasi
        </h3>

        <label for="judul">Judul Informasi <span style="color:#ef4444;">*</span></label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $informasi->judul) }}" required>

        <div class="grid" style="margin-top: 10px;">
            <div>
                <label for="kategori">Kategori Informasi <span style="color:#ef4444;">*</span></label>
                <select id="kategori" name="kategori" required>
                    @php $currentCat = old('kategori', $informasi->kategori); @endphp
                    <option value="Pengumuman" {{ $currentCat == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Berita" {{ $currentCat == 'Berita' ? 'selected' : '' }}>Berita Sekolah</option>
                    <option value="Prestasi" {{ $currentCat == 'Prestasi' ? 'selected' : '' }}>Prestasi Siswa/Guru</option>
                    <option value="Kegiatan" {{ $currentCat == 'Kegiatan' ? 'selected' : '' }}>Kegiatan & Ekstrakurikuler</option>
                    <option value="Akademik" {{ $currentCat == 'Akademik' ? 'selected' : '' }}>Informasi Akademik</option>
                </select>
            </div>
            <div>
                <label for="tanggal_publikasi">Tanggal Publikasi</label>
                <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', $informasi->tanggal_publikasi?->format('Y-m-d')) }}">
            </div>
        </div>

        <label for="ringkasan">Ringkasan Singkat (Lead / Cuplikan)</label>
        <textarea id="ringkasan" name="ringkasan" style="min-height: 70px;">{{ old('ringkasan', $informasi->ringkasan) }}</textarea>

        <label for="konten">Isi Konten Informasi Lengkap <span style="color:#ef4444;">*</span></label>
        <textarea id="konten" name="konten" style="min-height: 220px;" required>{{ old('konten', $informasi->konten) }}</textarea>

        {{-- BAGIAN 2: TEMPAT MENARUH GAMBAR INFORMASI --}}
        <h3 style="border-bottom: 2px solid var(--toska-100); padding-bottom: 6px; color: var(--toska-900); margin-top: 28px;">
            2. Template Menaruh Gambar Informasi
        </h3>

        <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: 12px; padding: 18px; margin-top: 10px;">
            @if ($informasi->gambar)
                <div style="margin-bottom: 14px;">
                    <span style="display:block; font-size:0.85rem; font-weight:700; color:var(--text-muted); margin-bottom:6px;">Gambar Saat Ini:</span>
                    <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" style="max-width: 280px; max-height: 180px; border-radius: 8px; border: 1px solid var(--border); object-fit: cover;">
                </div>
            @endif

            <label for="gambar" style="margin-top: 0;">Ganti / Unggah Gambar Baru (Opsional)</label>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 2px 0 10px;">Kosongkan jika tidak ingin mengubah gambar yang sudah ada.</p>
            <input type="file" id="gambar" name="gambar" accept="image/*">
        </div>

        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border);">
            <label style="display:inline-flex; align-items:center; gap:8px; font-weight: normal; cursor: pointer;">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $informasi->is_published) ? 'checked' : '' }} style="width: auto; margin: 0;">
                <span style="font-weight: 600; color: var(--text-dark);">Tampilkan informasi ini di web publik (Aktif)</span>
            </label>
        </div>

        <div style="margin-top: 24px; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">Perbarui Informasi</button>
            <a href="{{ route('admin.informasi.index') }}" class="btn">Batal</a>
        </div>
    </form>
@endsection
