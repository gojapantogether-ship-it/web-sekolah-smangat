@extends('layouts.admin')

@section('title', 'Kelola Ekstrakurikuler')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:18px;">
        <div>
            <h1>Kelola Ekstrakurikuler</h1>
            <p style="color:var(--text-muted); margin:0; font-size:0.92rem;">Kelola kegiatan ekstrakurikuler, jadwal latihan, pembina, dan foto kegiatan.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.ekskul.create') }}">+ Tambah Ekskul</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:90px;">Foto</th>
                    <th>Nama Ekskul</th>
                    <th>Pembina</th>
                    <th>Jadwal Latihan</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($extracurriculars as $item)
                    <tr>
                        <td>
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" style="width:76px; height:52px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                            @else
                                <div style="width:76px; height:52px; border-radius:8px; background:var(--toska-50); color:var(--toska-700); font-size:0.75rem; display:flex; align-items:center; justify-content:center;">No Photo</div>
                            @endif
                        </td>
                        <td><strong>{{ $item->nama }}</strong></td>
                        <td>{{ $item->pembina ?: '-' }}</td>
                        <td>{{ $item->jadwal ?: '-' }}</td>
                        <td>
                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                <a class="btn" style="padding:5px 10px; font-size:0.82rem;" href="{{ route('admin.ekskul.edit', $item) }}">Edit</a>
                                <form action="{{ route('admin.ekskul.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus ekstrakurikuler ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:5px 10px; font-size:0.82rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:24px; color:var(--text-muted);">Belum ada data ekstrakurikuler.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
