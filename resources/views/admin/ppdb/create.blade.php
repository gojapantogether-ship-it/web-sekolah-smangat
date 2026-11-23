@extends('layouts.admin')

@section('title', 'Tambah Informasi PPDB')

@section('content')
    <h1>Tambah Informasi PPDB</h1>

    <form action="{{ route('admin.ppdb.store') }}" method="POST" class="card">
        @csrf

        <label for="judul">Judul Informasi PPDB</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>

        <label for="tahun_ajaran">Tahun Ajaran</label>
        <input type="text" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh: 2026/2027" value="{{ old('tahun_ajaran') }}">

        <div class="grid">
            <div>
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
            </div>
            <div>
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
            </div>
        </div>

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>

        <label for="persyaratan">Persyaratan</label>
        <textarea id="persyaratan" name="persyaratan">{{ old('persyaratan') }}</textarea>

        <label for="link_pendaftaran">Link Pendaftaran (Opsional)</label>
        <input type="url" id="link_pendaftaran" name="link_pendaftaran" placeholder="https://..." value="{{ old('link_pendaftaran') }}">

        <label style="font-weight: normal;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            Tampilkan di halaman publik (Aktif)
        </label>

        <p>
            <button type="submit" class="btn">Simpan</button>
            <a class="btn" href="{{ route('admin.ppdb.index') }}">Batal</a>
        </p>
    </form>
@endsection
