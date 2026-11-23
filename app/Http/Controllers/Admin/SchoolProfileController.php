<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function edit()
    {
        $profile = SchoolProfile::current();

        return view('admin.profil.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'sambutan_judul' => ['required', 'string', 'max:255'],
            'sambutan_isi' => ['nullable', 'string'],
            'profil_sekolah' => ['nullable', 'string'],
            'foto_sekolah' => ['nullable', 'image', 'max:4096'],
            'sejarah_sekolah' => ['nullable', 'string'],
            'visi_misi' => ['nullable', 'string'],
            'npsn' => ['nullable', 'string', 'max:50'],
            'akreditasi' => ['nullable', 'string', 'max:50'],
            'nama_kepala_sekolah' => ['nullable', 'string', 'max:255'],
            'profil_kepala_sekolah' => ['nullable', 'string'],
            'foto_kepala_sekolah' => ['nullable', 'image', 'max:4096'],
            'motivasi_kepala_sekolah' => ['nullable', 'string'],
            'jumlah_guru' => ['required', 'integer', 'min:0'],
            'jumlah_siswa' => ['required', 'integer', 'min:0'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'kontak' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'fax' => ['nullable', 'string', 'max:100'],
        ]);

        $profile = SchoolProfile::current();

        if ($request->hasFile('logo')) {
            $request->file('logo')->move(public_path('images'), 'logo.png');
            if (file_exists(public_path('images/logo.png'))) {
                @copy(public_path('images/logo.png'), public_path('favicon.png'));
            }
        }

        if ($request->hasFile('foto_sekolah')) {
            if ($profile->foto_sekolah) {
                Storage::disk('public')->delete($profile->foto_sekolah);
            }
            $data['foto_sekolah'] = $request->file('foto_sekolah')->store('sekolah', 'public');
        }

        if ($request->hasFile('foto_kepala_sekolah')) {
            if ($profile->foto_kepala_sekolah) {
                Storage::disk('public')->delete($profile->foto_kepala_sekolah);
            }
            $data['foto_kepala_sekolah'] = $request->file('foto_kepala_sekolah')->store('kepala-sekolah', 'public');
        }

        $profile->update($data);

        return redirect()->route('admin.profil.edit')->with('success', 'Profil sekolah, kepala sekolah, dan kontak berhasil diperbarui.');
    }
}
