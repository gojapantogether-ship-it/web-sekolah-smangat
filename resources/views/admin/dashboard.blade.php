@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div style="margin-bottom: 20px;">
        <h1>Dashboard Admin</h1>
        <p style="margin:0; color:var(--text-muted); font-size:0.94rem;">Ringkasan data website sekolah dan kontrol cepat statistik guru &amp; siswa.</p>
    </div>

    <div class="grid">
        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Jumlah Guru</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $profile->jumlah_guru }}</p>
            <span style="font-size: 0.82rem; color: var(--text-muted);">Tampil di halaman Home</span>
        </div>

        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Jumlah Siswa</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $profile->jumlah_siswa }}</p>
            <span style="font-size: 0.82rem; color: var(--text-muted);">Tampil di halaman Home</span>
        </div>

        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Direktori Guru &amp; GTK</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $totalGuruGtk }}</p>
            <a class="btn btn-primary" style="padding: 5px 10px; font-size: 0.82rem;" href="{{ route('admin.guru.index') }}">Kelola Guru &rarr;</a>
        </div>

        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Ekstrakurikuler</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $totalEkskul }}</p>
            <a class="btn btn-primary" style="padding: 5px 10px; font-size: 0.82rem;" href="{{ route('admin.ekskul.index') }}">Kelola Ekskul &rarr;</a>
        </div>

        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Pojok Prestasi</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $totalPrestasi }}</p>
            <a class="btn btn-primary" style="padding: 5px 10px; font-size: 0.82rem;" href="{{ route('admin.prestasi.index') }}">Kelola Prestasi &rarr;</a>
        </div>

        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Informasi &amp; Berita</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $totalInformasi }}</p>
            <a class="btn" style="padding: 5px 10px; font-size: 0.82rem;" href="{{ route('admin.informasi.index') }}">Kelola Informasi &rarr;</a>
        </div>

        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Info PPDB</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $totalPpdb }}</p>
            <a class="btn" style="padding: 5px 10px; font-size: 0.82rem;" href="{{ route('admin.ppdb.index') }}">Kelola PPDB &rarr;</a>
        </div>

        <div class="card">
            <div style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Foto Galeri</div>
            <p style="font-size: 2.1rem; font-weight: 800; margin: 6px 0; color: var(--toska-800);">{{ $totalGaleri }}</p>
            <a class="btn" style="padding: 5px 10px; font-size: 0.82rem;" href="{{ route('admin.galeri.index') }}">Kelola Galeri &rarr;</a>
        </div>
    </div>

    {{-- Kontrol cepat Jumlah Guru & Siswa --}}
    <div class="card" style="margin-top: 8px;">
        <h2 style="margin-top:0;">Update Cepat Jumlah Guru &amp; Siswa</h2>
        <p style="color: var(--text-muted); font-size: 0.92rem; margin-top: -4px;">Nilai di bawah ini langsung tampil pada bagian statistik halaman utama (Home).</p>
        <form action="{{ route('admin.statistik.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid">
                <div>
                    <label for="jumlah_guru">Jumlah Guru</label>
                    <input type="number" id="jumlah_guru" name="jumlah_guru" min="0" value="{{ old('jumlah_guru', $profile->jumlah_guru) }}" required>
                </div>
                <div>
                    <label for="jumlah_siswa">Jumlah Siswa</label>
                    <input type="number" id="jumlah_siswa" name="jumlah_siswa" min="0" value="{{ old('jumlah_siswa', $profile->jumlah_siswa) }}" required>
                </div>
            </div>
            <p style="margin-top: 16px; margin-bottom:0;"><button type="submit" class="btn btn-primary">Simpan Jumlah Guru &amp; Siswa</button></p>
        </form>
    </div>
@endsection
