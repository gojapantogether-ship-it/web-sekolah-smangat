@extends('layouts.admin')

@section('title', 'Edit Slide Background Home')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <h1>Edit Slide Background Home</h1>
        <a class="btn" href="{{ route('admin.hero-slides.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')

        <label for="judul">Judul / Keterangan Slide (Opsional)</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $heroSlide->judul) }}">

        <label for="urutan">Urutan Tampil</label>
        <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', $heroSlide->urutan) }}">

        <label>Gambar Saat Ini</label>
        <p style="margin:8px 0;">
            <img src="{{ asset('storage/' . $heroSlide->gambar) }}" alt="{{ $heroSlide->judul }}" style="max-width:280px; border-radius:10px; border:1px solid var(--border);">
        </p>

        <label for="gambar">Ganti Gambar (Opsional)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*" style="margin-top:6px;">

        <label style="display:inline-flex; align-items:center; gap:8px; font-weight:600; cursor:pointer; margin-top:16px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $heroSlide->is_active) ? 'checked' : '' }} style="width:auto; margin:0;">
            Aktifkan di slideshow background Home
        </label>

        <p style="margin-top:20px; margin-bottom:0;">
            <button type="submit" class="btn btn-primary">Update Slide</button>
            <a class="btn" href="{{ route('admin.hero-slides.index') }}">Batal</a>
        </p>
    </form>
@endsection
