<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->get();

        return view('admin.guru.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:50'],
            'kategori' => ['required', 'string', 'max:100'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'mata_pelajaran' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:4096'],
            'bio' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        Teacher::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru / GTK berhasil ditambahkan.');
    }

    public function edit(Teacher $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Teacher $guru)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:50'],
            'kategori' => ['required', 'string', 'max:100'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'mata_pelajaran' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:4096'],
            'bio' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru / GTK berhasil diperbarui.');
    }

    public function destroy(Teacher $guru)
    {
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru / GTK berhasil dihapus.');
    }
}
