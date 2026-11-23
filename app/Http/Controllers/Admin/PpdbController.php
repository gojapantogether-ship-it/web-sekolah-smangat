<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbInfo;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index()
    {
        $ppdbInfos = PpdbInfo::latest()->get();

        return view('admin.ppdb.index', compact('ppdbInfos'));
    }

    public function create()
    {
        return view('admin.ppdb.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tahun_ajaran' => ['nullable', 'string', 'max:50'],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'deskripsi' => ['required', 'string'],
            'persyaratan' => ['nullable', 'string'],
            'link_pendaftaran' => ['nullable', 'url', 'max:255'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        PpdbInfo::create($data);

        return redirect()->route('admin.ppdb.index')->with('success', 'Informasi PPDB berhasil ditambahkan.');
    }

    public function edit(PpdbInfo $ppdb)
    {
        return view('admin.ppdb.edit', compact('ppdb'));
    }

    public function update(Request $request, PpdbInfo $ppdb)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tahun_ajaran' => ['nullable', 'string', 'max:50'],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'deskripsi' => ['required', 'string'],
            'persyaratan' => ['nullable', 'string'],
            'link_pendaftaran' => ['nullable', 'url', 'max:255'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $ppdb->update($data);

        return redirect()->route('admin.ppdb.index')->with('success', 'Informasi PPDB berhasil diperbarui.');
    }

    public function destroy(PpdbInfo $ppdb)
    {
        $ppdb->delete();

        return redirect()->route('admin.ppdb.index')->with('success', 'Informasi PPDB berhasil dihapus.');
    }
}
