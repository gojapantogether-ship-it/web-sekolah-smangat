<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $extracurriculars = Extracurricular::latest()->get();

        return view('admin.ekskul.index', compact('extracurriculars'));
    }

    public function create()
    {
        return view('admin.ekskul.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'pembina' => ['nullable', 'string', 'max:255'],
            'jadwal' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('ekskul', 'public');
        }

        Extracurricular::create($data);

        return redirect()->route('admin.ekskul.index')->with('success', 'Data Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit(Extracurricular $ekstrakurikuler)
    {
        return view('admin.ekskul.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, Extracurricular $ekstrakurikuler)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'pembina' => ['nullable', 'string', 'max:255'],
            'jadwal' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('foto')) {
            if ($ekstrakurikuler->foto) {
                Storage::disk('public')->delete($ekstrakurikuler->foto);
            }
            $data['foto'] = $request->file('foto')->store('ekskul', 'public');
        }

        $ekstrakurikuler->update($data);

        return redirect()->route('admin.ekskul.index')->with('success', 'Data Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Extracurricular $ekstrakurikuler)
    {
        if ($ekstrakurikuler->foto) {
            Storage::disk('public')->delete($ekstrakurikuler->foto);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekskul.index')->with('success', 'Data Ekstrakurikuler berhasil dihapus.');
    }
}
