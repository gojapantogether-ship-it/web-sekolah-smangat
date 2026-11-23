@extends('layouts.admin')

@section('title', 'Edit Informasi PPDB')

@section('content')
    <h1>Edit Informasi PPDB</h1>

    <form action="{{ route('admin.ppdb.update', $ppdb) }}" method="POST" class="card">
        @csrf
        @method('PUT')

        <label for="judul">Judul Informasi PPDB</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $ppdb->judul) }}" required>

        <label for="tahun_ajaran">Tahun Ajaran</label>
        <input type="text" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $ppdb->tahun_ajaran) }}">

        <div class="grid">
            <div>
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $ppdb->tanggal_mulai?->format('Y-m-d')) }}">
            </div>
            <div>
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $ppdb->tanggal_selesai?->format('Y-m-d')) }}">
            </div>
        </div>

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $ppdb->deskripsi) }}</textarea>

        <label for="persyaratan">Persyaratan</label>
        <textarea id="persyaratan" name="persyaratan">{{ old('persyaratan', $ppdb->persyaratan) }}</textarea>

        <label for="link_pendaftaran">Link Pendaftaran (Opsional)</label>
        <input type="url" id="link_pendaftaran" name="link_pendaftaran" value="{{ old('link_pendaftaran', $ppdb->link_pendaftaran) }}">

        <label style="font-weight: normal;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $ppdb->is_active) ? 'checked' : '' }}>
            Tampilkan di halaman publik (Aktif)
        </label>

        <p>
            <button type="submit" class="btn">Update</button>
            <a class="btn" href="{{ route('admin.ppdb.index') }}">Batal</a>
        </p>
    </form>
@endsection
