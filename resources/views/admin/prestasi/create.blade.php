@extends('layouts.admin')

@section('title', 'Tambah Prestasi')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <h1>Tambah Prestasi</h1>
        <a class="btn" href="{{ route('admin.prestasi.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf

        <label for="judul">Judul Prestasi / Kejuaraan</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>

        <label for="peraih">Nama Peraih / Tim</label>
        <input type="text" id="peraih" name="peraih" value="{{ old('peraih') }}" placeholder="Contoh: Aulia Rahman / Tim Futsal">

        <div class="grid">
            <div>
                <label for="tingkat">Tingkat Kejuaraan</label>
                <select id="tingkat" name="tingkat" required>
                    <option value="Kota/Kabupaten" {{ old('tingkat') == 'Kota/Kabupaten' ? 'selected' : '' }}>Kota/Kabupaten</option>
                    <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="Nasional" {{ old('tingkat', 'Nasional') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
            </div>
            <div>
                <label for="tahun">Tahun</label>
                <input type="text" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" placeholder="Contoh: 2026">
            </div>
        </div>

        <label for="deskripsi">Deskripsi Singkat (Opsional)</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>

        <label for="foto">Foto Dokumentasi / Piala (Opsional)</label>
        <input type="file" id="foto" name="foto" accept="image/*" style="margin-top:6px;">

        <p style="margin-top:20px; margin-bottom:0;">
            <button type="submit" class="btn btn-primary">Simpan Prestasi</button>
            <a class="btn" href="{{ route('admin.prestasi.index') }}">Batal</a>
        </p>
    </form>
@endsection
