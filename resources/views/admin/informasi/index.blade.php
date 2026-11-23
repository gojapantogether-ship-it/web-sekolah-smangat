@extends('layouts.admin')

@section('title', 'Kelola Informasi Sekolah')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
        <div>
            <h1 style="margin:0;">Kelola Informasi Sekolah</h1>
            <p style="color:var(--text-muted); margin:4px 0 0; font-size:0.95rem;">Kelola berita, pengumuman, dan artikel informasi sekolah yang tampil di web publik.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.informasi.create') }}">+ Tambah Informasi Baru</a>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 90px;">Gambar</th>
                <th>Judul & Ringkasan</th>
                <th style="width: 130px;">Kategori</th>
                <th style="width: 120px;">Tanggal</th>
                <th style="width: 90px;">Status</th>
                <th style="width: 170px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($information as $item)
                <tr>
                    <td>
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" style="width: 80px; height: 55px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
                        @else
                            <div style="width: 80px; height: 55px; background: var(--toska-50); color: var(--toska-700); font-size: 0.75rem; display: flex; align-items: center; justify-content: center; border-radius: 6px; border: 1px solid var(--border);">
                                Tanpa Foto
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong style="color: var(--text-dark); font-size: 1rem;">{{ $item->judul }}</strong>
                        @if ($item->ringkasan)
                            <p style="margin: 4px 0 0; font-size: 0.85rem; color: var(--text-muted); line-height: 1.4;">{{ \Illuminate\Support\Str::limit($item->ringkasan, 90) }}</p>
                        @endif
                    </td>
                    <td>
                        <span style="display:inline-block; padding: 3px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; background: var(--toska-100); color: var(--toska-800);">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td style="font-size: 0.88rem; color: var(--text-muted);">
                        {{ $item->tanggal_publikasi?->format('d/m/Y') ?? '-' }}
                    </td>
                    <td>
                        @if ($item->is_published)
                            <span style="color: #16a34a; font-weight: 700; font-size: 0.85rem;">Aktif</span>
                        @else
                            <span style="color: #94a3b8; font-weight: 700; font-size: 0.85rem;">Draft</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <a class="btn" style="padding: 4px 8px; font-size: 0.82rem;" href="{{ route('informasi.detail', $item->slug) }}" target="_blank">Lihat</a>
                            <a class="btn" style="padding: 4px 8px; font-size: 0.82rem;" href="{{ route('admin.informasi.edit', $item) }}">Edit</a>
                            <form action="{{ route('admin.informasi.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.82rem;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 24px; color: var(--text-muted);">
                        Belum ada informasi sekolah yang dibuat. Silakan klik tombol <strong>+ Tambah Informasi Baru</strong>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
