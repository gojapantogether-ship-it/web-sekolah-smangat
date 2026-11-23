<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->get();

        return view('admin.prestasi.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'peraih' => ['nullable', 'string', 'max:255'],
            'tingkat' => ['required', 'string', 'max:100'],
            'tahun' => ['nullable', 'string', 'max:20'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        Achievement::create($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data Prestasi berhasil ditambahkan.');
    }

    public function edit(Achievement $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, Achievement $prestasi)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'peraih' => ['nullable', 'string', 'max:255'],
            'tingkat' => ['required', 'string', 'max:100'],
            'tahun' => ['nullable', 'string', 'max:20'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('foto')) {
            if ($prestasi->foto) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->update($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data Prestasi berhasil diperbarui.');
    }

    public function destroy(Achievement $prestasi)
    {
        if ($prestasi->foto) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')->with('success', 'Data Prestasi berhasil dihapus.');
    }
}
