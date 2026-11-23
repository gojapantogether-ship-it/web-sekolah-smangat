@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <h1>Edit Ekstrakurikuler</h1>
        <a class="btn" href="{{ route('admin.ekskul.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.ekskul.update', $ekstrakurikuler) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')

        <label for="nama">Nama Ekstrakurikuler</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $ekstrakurikuler->nama) }}" required>

        <div class="grid">
            <div>
                <label for="pembina">Nama Pembina (Opsional)</label>
                <input type="text" id="pembina" name="pembina" value="{{ old('pembina', $ekstrakurikuler->pembina) }}">
            </div>
            <div>
                <label for="jadwal">Jadwal Latihan (Opsional)</label>
                <input type="text" id="jadwal" name="jadwal" value="{{ old('jadwal', $ekstrakurikuler->jadwal) }}">
            </div>
        </div>

        <label for="deskripsi">Deskripsi Kegiatan (Opsional)</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>

        <label for="foto">Foto Kegiatan (Opsional)</label>
        @if ($ekstrakurikuler->foto)
            <p style="margin:8px 0;"><img src="{{ asset('storage/' . $ekstrakurikuler->foto) }}" alt="{{ $ekstrakurikuler->nama }}" style="max-width:220px; border-radius:10px; border:1px solid var(--border);"></p>
        @endif
        <input type="file" id="foto" name="foto" accept="image/*" style="margin-top:6px;">

        <p style="margin-top:20px; margin-bottom:0;">
            <button type="submit" class="btn btn-primary">Update Ekskul</button>
            <a class="btn" href="{{ route('admin.ekskul.index') }}">Batal</a>
        </p>
    </form>
@endsection
