@extends('layouts.admin')

@section('title', 'Tambah Slide Background Home')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <h1>Tambah Slide Background Home</h1>
        <a class="btn" href="{{ route('admin.hero-slides.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf

        <label for="judul">Judul / Keterangan Slide (Opsional)</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Tampak Depan Gedung Sekolah">

        <label for="urutan">Urutan Tampil</label>
        <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', 1) }}">

        <label for="gambar">Pilih Gambar Background (Wajib, Maks 4MB)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*" required style="margin-top:6px;">

        <label style="display:inline-flex; align-items:center; gap:8px; font-weight:600; cursor:pointer; margin-top:16px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:auto; margin:0;">
            Aktifkan di slideshow background Home
        </label>

        <p style="margin-top:20px; margin-bottom:0;">
            <button type="submit" class="btn btn-primary">Simpan Slide</button>
            <a class="btn" href="{{ route('admin.hero-slides.index') }}">Batal</a>
        </p>
    </form>
@endsection
