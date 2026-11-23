@extends('layouts.admin')

@section('title', 'Edit Foto Galeri')

@section('content')
    <h1>Edit Foto Galeri</h1>

    <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')

        <label for="judul">Judul Foto</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul) }}" required>

        <label for="deskripsi">Deskripsi (Opsional)</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>

        <label>Foto Saat Ini</label>
        <p><img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" style="max-width: 220px; border: 1px solid #ccc;"></p>

        <label for="foto">Ganti Foto (Opsional)</label>
        <input type="file" id="foto" name="foto" accept="image/*">

        <p>
            <button type="submit" class="btn">Update Foto</button>
            <a class="btn" href="{{ route('admin.galeri.index') }}">Batal</a>
        </p>
    </form>
@endsection
