@extends('layouts.admin')

@section('title', 'Kelola Informasi PPDB')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Kelola Informasi PPDB</h1>
        <a class="btn" href="{{ route('admin.ppdb.create') }}">+ Tambah Info PPDB</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun Ajaran</th>
                <th>Jadwal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ppdbInfos as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tahun_ajaran ?? '-' }}</td>
                    <td>
                        {{ $item->tanggal_mulai?->format('d/m/Y') ?? '-' }} -
                        {{ $item->tanggal_selesai?->format('d/m/Y') ?? '-' }}
                    </td>
                    <td>{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td>
                        <a class="btn" href="{{ route('admin.ppdb.edit', $item) }}">Edit</a>
                        <form action="{{ route('admin.ppdb.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus informasi PPDB ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data informasi PPDB.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
