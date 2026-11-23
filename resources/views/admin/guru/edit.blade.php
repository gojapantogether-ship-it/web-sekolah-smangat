@extends('layouts.admin')

@section('title', 'Edit Guru / GTK')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <h1>Edit Guru / GTK</h1>
        <a class="btn" href="{{ route('admin.guru.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.guru.update', $guru) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')

        <div class="grid">
            <div>
                <label for="nama">Nama Lengkap &amp; Gelar</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $guru->nama) }}" required>
            </div>
            <div>
                <label for="nip">NIP / NUPTK (Opsional)</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}">
            </div>
        </div>

        <div class="grid">
            <div>
                <label for="kategori">Kategori</label>
                @php $kat = old('kategori', $guru->kategori); @endphp
                <select id="kategori" name="kategori" required>
                    <option value="Guru" {{ $kat == 'Guru' ? 'selected' : '' }}>Guru</option>
                    <option value="Tenaga Kependidikan" {{ $kat == 'Tenaga Kependidikan' ? 'selected' : '' }}>Tenaga Kependidikan</option>
                </select>
            </div>
            <div>
                <label for="jabatan">Jabatan (Opsional)</label>
                <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $guru->jabatan) }}">
            </div>
        </div>

        <label for="mata_pelajaran">Mata Pelajaran / Bidang Tugas (Opsional)</label>
        <input type="text" id="mata_pelajaran" name="mata_pelajaran" value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}">

        <label for="bio">Bio Singkat (Opsional)</label>
        <textarea id="bio" name="bio">{{ old('bio', $guru->bio) }}</textarea>

        <label for="foto">Foto Profil (Opsional)</label>
        @if ($guru->foto)
            <p style="margin:8px 0;"><img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}" style="max-width:140px; border-radius:10px; border:1px solid var(--border);"></p>
        @endif
        <input type="file" id="foto" name="foto" accept="image/*" style="margin-top:6px;">

        <p style="margin-top:20px; margin-bottom:0;">
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a class="btn" href="{{ route('admin.guru.index') }}">Batal</a>
        </p>
    </form>
@endsection
