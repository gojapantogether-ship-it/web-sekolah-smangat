@extends('layouts.admin')

@section('title', 'Kelola Slide Background Home')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:18px;">
        <div>
            <h1>Slide Background Halaman Home</h1>
            <p style="color:var(--text-muted); margin:0; font-size:0.92rem;">Gambar aktif di bawah ini berganti otomatis setiap <strong>10 detik</strong> di latar belakang halaman utama.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.hero-slides.create') }}">+ Tambah Gambar Slide</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:120px;">Gambar</th>
                    <th>Judul / Keterangan</th>
                    <th style="width:90px;">Urutan</th>
                    <th style="width:100px;">Status</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($slides as $slide)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $slide->gambar) }}" alt="{{ $slide->judul ?? 'Slide Background' }}" style="width:104px; height:62px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                        </td>
                        <td><strong>{{ $slide->judul ?: 'Tanpa Judul' }}</strong></td>
                        <td>{{ $slide->urutan }}</td>
                        <td>
                            @if ($slide->is_active)
                                <span style="color:#16a34a; font-weight:700; font-size:0.85rem;">Aktif</span>
                            @else
                                <span style="color:#94a3b8; font-weight:700; font-size:0.85rem;">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                <a class="btn" style="padding:5px 10px; font-size:0.82rem;" href="{{ route('admin.hero-slides.edit', $slide) }}">Edit</a>
                                <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus gambar slide ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:5px 10px; font-size:0.82rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:24px; color:var(--text-muted);">Belum ada gambar slide background. Sistem akan memakai gambar default.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
