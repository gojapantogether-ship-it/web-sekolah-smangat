@extends('layouts.admin')

@section('title', 'Edit Prestasi')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <h1>Edit Prestasi</h1>
        <a class="btn" href="{{ route('admin.prestasi.index') }}">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.prestasi.update', $prestasi) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')

        <label for="judul">Judul Prestasi / Kejuaraan</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $prestasi->judul) }}" required>

        <label for="peraih">Nama Peraih / Tim</label>
        <input type="text" id="peraih" name="peraih" value="{{ old('peraih', $prestasi->peraih) }}">

        <div class="grid">
            <div>
                <label for="tingkat">Tingkat Kejuaraan</label>
                @php $lvl = old('tingkat', $prestasi->tingkat); @endphp
                <select id="tingkat" name="tingkat" required>
                    <option value="Kota/Kabupaten" {{ $lvl == 'Kota/Kabupaten' ? 'selected' : '' }}>Kota/Kabupaten</option>
                    <option value="Provinsi" {{ $lvl == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="Nasional" {{ $lvl == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ $lvl == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
            </div>
            <div>
                <label for="tahun">Tahun</label>
                <input type="text" id="tahun" name="tahun" value="{{ old('tahun', $prestasi->tahun) }}">
            </div>
        </div>

        <label for="deskripsi">Deskripsi Singkat (Opsional)</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>

        <label for="foto">Foto Dokumentasi / Piala (Opsional)</label>
        @if ($prestasi->foto)
            <p style="margin:8px 0;"><img src="{{ asset('storage/' . $prestasi->foto) }}" alt="{{ $prestasi->judul }}" style="max-width:220px; border-radius:10px; border:1px solid var(--border);"></p>
        @endif
        <input type="file" id="foto" name="foto" accept="image/*" style="margin-top:6px;">

        <p style="margin-top:20px; margin-bottom:0;">
            <button type="submit" class="btn btn-primary">Update Prestasi</button>
            <a class="btn" href="{{ route('admin.prestasi.index') }}">Batal</a>
        </p>
    </form>
@endsection
