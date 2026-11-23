<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    public function index()
    {
        $information = Information::latest('tanggal_publikasi')->latest('id')->get();

        return view('admin.informasi.index', compact('information'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'konten' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'max:4096'],
            'tanggal_publikasi' => ['nullable', 'date'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['slug'] = Str::slug($request->judul);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $count = 1;
        while (Information::where('slug', $data['slug'])->exists()) {
            $data['slug'] = "{$originalSlug}-" . $count++;
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('informasi', 'public');
        }

        if (empty($data['tanggal_publikasi'])) {
            $data['tanggal_publikasi'] = now()->toDateString();
        }

        Information::create($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi baru berhasil ditambahkan.');
    }

    public function edit(Information $informasi)
    {
        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, Information $informasi)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'konten' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'max:4096'],
            'tanggal_publikasi' => ['nullable', 'date'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        // Update slug if title changed
        if ($informasi->judul !== $request->judul) {
            $slug = Str::slug($request->judul);
            $originalSlug = $slug;
            $count = 1;
            while (Information::where('slug', $slug)->where('id', '!=', $informasi->id)->exists()) {
                $slug = "{$originalSlug}-" . $count++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('gambar')) {
            if ($informasi->gambar && !str_starts_with($informasi->gambar, 'http')) {
                Storage::disk('public')->delete($informasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('informasi', 'public');
        }

        $informasi->update($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Information $informasi)
    {
        if ($informasi->gambar && !str_starts_with($informasi->gambar, 'http')) {
            Storage::disk('public')->delete($informasi->gambar);
        }

        $informasi->delete();

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
