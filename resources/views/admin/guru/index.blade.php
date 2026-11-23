@extends('layouts.admin')

@section('title', 'Kelola Direktori Guru & GTK')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:18px;">
        <div>
            <h1>Direktori Guru &amp; GTK</h1>
            <p style="color:var(--text-muted); margin:0; font-size:0.92rem;">Kelola daftar guru dan tenaga kependidikan yang tampil di halaman publik.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.guru.create') }}">+ Tambah Guru / GTK</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:72px;">Foto</th>
                    <th>Nama &amp; NIP</th>
                    <th>Kategori</th>
                    <th>Jabatan / Mapel</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teachers as $guru)
                    <tr>
                        <td>
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}" style="width:52px; height:52px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                            @else
                                <div style="width:52px; height:52px; border-radius:10px; background:var(--toska-100); color:var(--toska-800); font-weight:800; display:flex; align-items:center; justify-content:center;">
                                    {{ strtoupper(substr($guru->nama, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $guru->nama }}</strong>
                            @if ($guru->nip)
                                <div style="font-size:0.82rem; color:var(--text-muted);">NIP: {{ $guru->nip }}</div>
                            @endif
                        </td>
                        <td>
                            <span style="display:inline-block; padding:3px 9px; border-radius:999px; font-size:0.78rem; font-weight:700; background:var(--toska-100); color:var(--toska-800);">
                                {{ $guru->kategori }}
                            </span>
                        </td>
                        <td>
                            <div>{{ $guru->mata_pelajaran ?: '-' }}</div>
                            @if ($guru->jabatan)
                                <div style="font-size:0.82rem; color:var(--text-muted);">{{ $guru->jabatan }}</div>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                <a class="btn" style="padding:5px 10px; font-size:0.82rem;" href="{{ route('admin.guru.edit', $guru) }}">Edit</a>
                                <form action="{{ route('admin.guru.destroy', $guru) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data guru ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:5px 10px; font-size:0.82rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:24px; color:var(--text-muted);">Belum ada data Guru / GTK.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
