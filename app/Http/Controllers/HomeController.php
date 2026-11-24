<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Information;
use App\Models\PpdbInfo;
use App\Models\SchoolProfile;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = SchoolProfile::current();
        $heroSlides = HeroSlide::where('is_active', true)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();
        $latestInfo = Information::where('is_published', true)
            ->latest('tanggal_publikasi')
            ->latest('id')
            ->take(3)
            ->get();

        return view('welcome', compact('profile', 'heroSlides', 'latestInfo'));
    }

    public function profil()
    {
        $profile = SchoolProfile::current();

        return view('profil', compact('profile'));
    }

    public function guru(Request $request)
    {
        $profile = SchoolProfile::current();
        $query = Teacher::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                  ->orWhere('mata_pelajaran', 'like', "%{$cari}%")
                  ->orWhere('jabatan', 'like', "%{$cari}%");
            });
        }

        $teachers = $query->orderBy('kategori')->orderBy('nama')->get();

        return view('guru', compact('profile', 'teachers'));
    }

    public function ekstrakurikuler()
    {
        $profile = SchoolProfile::current();
        $extracurriculars = Extracurricular::orderBy('nama')->get();

        return view('ekstrakurikuler', compact('profile', 'extracurriculars'));
    }

    public function prestasi(Request $request)
    {
        $profile = SchoolProfile::current();
        $query = Achievement::query();

        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        $achievements = $query->latest('tahun')->latest('id')->get();
        $levels = Achievement::distinct()->pluck('tingkat');

        return view('prestasi', compact('profile', 'achievements', 'levels'));
    }

    public function ppdb()
    {
        $profile = SchoolProfile::current();
        $ppdbInfos = PpdbInfo::where('is_active', true)->latest()->get();

        return view('ppdb', compact('profile', 'ppdbInfos'));
    }

    public function galeri()
    {
        $profile = SchoolProfile::current();
        $galleries = Gallery::latest()->get();

        return view('galeri', compact('profile', 'galleries'));
    }

    public function informasi(Request $request)
    {
        $profile = SchoolProfile::current();
        $query = Information::where('is_published', true);

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                  ->orWhere('konten', 'like', "%{$cari}%")
                  ->orWhere('ringkasan', 'like', "%{$cari}%");
            });
        }

        $informationList = $query->latest('tanggal_publikasi')->latest('id')->paginate(6)->withQueryString();
        $categories = Information::where('is_published', true)->distinct()->pluck('kategori');

        return view('informasi', compact('profile', 'informationList', 'categories'));
    }

    public function informasiDetail($slug)
    {
        $profile = SchoolProfile::current();
        $informasi = Information::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedInfo = Information::where('is_published', true)
            ->where('id', '!=', $informasi->id)
            ->latest('tanggal_publikasi')
            ->take(3)
            ->get();

        return view('informasi-detail', compact('profile', 'informasi', 'relatedInfo'));
    }

    public function sitemap()
    {
        $staticUrls = [
            ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => route('profil'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => route('ppdb'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('informasi'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['loc' => route('guru'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => route('ekstrakurikuler'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => route('prestasi'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('galeri'), 'priority' => '0.7', 'changefreq' => 'weekly'],
        ];

        $articles = Information::where('is_published', true)
            ->latest('tanggal_publikasi')
            ->get(['slug', 'updated_at']);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($staticUrls as $item) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . e($item['loc']) . "</loc>\n";
            $xml .= '    <changefreq>' . $item['changefreq'] . "</changefreq>\n";
            $xml .= '    <priority>' . $item['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        foreach ($articles as $article) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . e(route('informasi.detail', $article->slug)) . "</loc>\n";
            if ($article->updated_at) {
                $xml .= '    <lastmod>' . $article->updated_at->toAtomString() . "</lastmod>\n";
            }
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.7</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
