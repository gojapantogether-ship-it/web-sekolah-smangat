@extends('layouts.admin')

@section('title', 'Tambah Guru / GTK')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <h1>Tambah Guru / GTK</h1>
        <a class="btn" href="{{ route('admin.guru.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf

        <div class="grid">
            <div>
                <label for="nama">Nama Lengkap &amp; Gelar</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>
            <div>
                <label for="nip">NIP / NUPTK (Opsional)</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip') }}">
            </div>
        </div>

        <div class="grid">
            <div>
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="Guru" {{ old('kategori') == 'Guru' ? 'selected' : '' }}>Guru</option>
                    <option value="Tenaga Kependidikan" {{ old('kategori') == 'Tenaga Kependidikan' ? 'selected' : '' }}>Tenaga Kependidikan</option>
                </select>
            </div>
            <div>
                <label for="jabatan">Jabatan (Opsional)</label>
                <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Wali Kelas XII / Kepala TU">
            </div>
        </div>

        <label for="mata_pelajaran">Mata Pelajaran / Bidang Tugas (Opsional)</label>
        <input type="text" id="mata_pelajaran" name="mata_pelajaran" value="{{ old('mata_pelajaran') }}" placeholder="Contoh: Matematika">

        <label for="bio">Bio Singkat (Opsional)</label>
        <textarea id="bio" name="bio">{{ old('bio') }}</textarea>

        <label for="foto">Foto Profil (Opsional)</label>
        <input type="file" id="foto" name="foto" accept="image/*" style="margin-top:6px;">

        <p style="margin-top:20px; margin-bottom:0;">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a class="btn" href="{{ route('admin.guru.index') }}">Batal</a>
        </p>
    </form>
@endsection
