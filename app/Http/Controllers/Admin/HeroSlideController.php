<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('urutan')->latest('id')->get();

        return view('admin.hero.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['nullable', 'string', 'max:255'],
            'gambar' => ['required', 'image', 'max:4096'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['gambar'] = $request->file('gambar')->store('hero-slides', 'public');
        $data['urutan'] = $data['urutan'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Gambar background slide Home berhasil ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $data = $request->validate([
            'judul' => ['nullable', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'max:4096'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($heroSlide->gambar) {
                Storage::disk('public')->delete($heroSlide->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('hero-slides', 'public');
        }

        $data['urutan'] = $data['urutan'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Gambar background slide Home berhasil diperbarui.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->gambar) {
            Storage::disk('public')->delete($heroSlide->gambar);
        }

        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Gambar background slide Home berhasil dihapus.');
    }
}
