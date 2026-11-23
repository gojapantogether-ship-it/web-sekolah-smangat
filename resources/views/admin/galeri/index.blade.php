@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto Sekolah')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Kelola Galeri Foto Sekolah</h1>
        <a class="btn" href="{{ route('admin.galeri.create') }}">+ Tambah Foto</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($galleries as $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" style="width: 100px; height: 70px; object-fit: cover; border: 1px solid #ccc;">
                    </td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <a class="btn" href="{{ route('admin.galeri.edit', $item) }}">Edit</a>
                        <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada foto di galeri.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
