<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\PpdbInfo;
use App\Models\SchoolProfile;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = SchoolProfile::current();
        $totalPpdb = PpdbInfo::count();
        $totalGaleri = Gallery::count();
        $totalInformasi = Information::count();
        $totalGuruGtk = Teacher::count();
        $totalEkskul = Extracurricular::count();
        $totalPrestasi = Achievement::count();

        return view('admin.dashboard', compact(
            'profile',
            'totalPpdb',
            'totalGaleri',
            'totalInformasi',
            'totalGuruGtk',
            'totalEkskul',
            'totalPrestasi'
        ));
    }

    public function updateStatistik(Request $request)
    {
        $data = $request->validate([
            'jumlah_guru' => ['required', 'integer', 'min:0'],
            'jumlah_siswa' => ['required', 'integer', 'min:0'],
        ]);

        $profile = SchoolProfile::current();
        $profile->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Jumlah guru dan siswa berhasil diperbarui.');
    }
}
