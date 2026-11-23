@extends('layouts.admin')

@section('title', 'Tambah Foto Galeri')

@section('content')
    <h1>Tambah Foto Galeri</h1>

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf

        <label for="judul">Judul Foto</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>

        <label for="deskripsi">Deskripsi (Opsional)</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>

        <label for="foto">Pilih File Foto</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>

        <p>
            <button type="submit" class="btn">Simpan Foto</button>
            <a class="btn" href="{{ route('admin.galeri.index') }}">Batal</a>
        </p>
    </form>
@endsection
