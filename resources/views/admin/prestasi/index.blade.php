@extends('layouts.admin')

@section('title', 'Kelola Pojok Prestasi')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:18px;">
        <div>
            <h1>Kelola Pojok Prestasi</h1>
            <p style="color:var(--text-muted); margin:0; font-size:0.92rem;">Catat dan publikasikan prestasi membanggakan siswa dan sekolah.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.prestasi.create') }}">+ Tambah Prestasi</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:90px;">Foto</th>
                    <th>Judul Prestasi</th>
                    <th>Peraih</th>
                    <th>Tingkat &amp; Tahun</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($achievements as $item)
                    <tr>
                        <td>
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" style="width:76px; height:52px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                            @else
                                <div style="width:76px; height:52px; border-radius:8px; background:var(--toska-50); color:var(--toska-700); display:flex; align-items:center; justify-content:center;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $item->judul }}</strong></td>
                        <td>{{ $item->peraih ?: '-' }}</td>
                        <td>
                            <span style="display:inline-block; padding:3px 9px; border-radius:999px; font-size:0.78rem; font-weight:700; background:var(--toska-100); color:var(--toska-800);">
                                {{ $item->tingkat }}
                            </span>
                            @if ($item->tahun)
                                <span style="font-size:0.85rem; color:var(--text-muted); margin-left:4px;">({{ $item->tahun }})</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                <a class="btn" style="padding:5px 10px; font-size:0.82rem;" href="{{ route('admin.prestasi.edit', $item) }}">Edit</a>
                                <form action="{{ route('admin.prestasi.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data prestasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:5px 10px; font-size:0.82rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:24px; color:var(--text-muted);">Belum ada data prestasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
