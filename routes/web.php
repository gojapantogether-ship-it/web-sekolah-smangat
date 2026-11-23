<?php

use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\PpdbController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/guru', [HomeController::class, 'guru'])->name('guru');
Route::get('/ekstrakurikuler', [HomeController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
Route::get('/prestasi', [HomeController::class, 'prestasi'])->name('prestasi');
Route::get('/ppdb', [HomeController::class, 'ppdb'])->name('ppdb');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/informasi', [HomeController::class, 'informasi'])->name('informasi');
Route::get('/informasi/{slug}', [HomeController::class, 'informasiDetail'])->name('informasi.detail');

// Autentikasi Admin
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Halaman Admin (dilindungi middleware auth)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/statistik', [DashboardController::class, 'updateStatistik'])->name('statistik.update');

    Route::get('/profil', [SchoolProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [SchoolProfileController::class, 'update'])->name('profil.update');

    Route::resource('guru', TeacherController::class)->except(['show']);
    Route::resource('ekstrakurikuler', ExtracurricularController::class)->names('ekskul')->except(['show']);
    Route::resource('prestasi', AchievementController::class)->except(['show']);
    Route::resource('ppdb', PpdbController::class)->except(['show']);
    Route::resource('galeri', GalleryController::class)->except(['show']);
    Route::resource('informasi', InformationController::class)->except(['show']);
    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
});
