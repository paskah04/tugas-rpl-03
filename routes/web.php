<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController ;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::get('/berita/{id}',[HomeController::class, 'detailBerita'])->name('home.detailBerita');
Route::get('/page/{id}',[\HomeController::class, 'detailPage'])->name('home.detailPage');
Route::get('/berita',[HomeController::class, 'semuaBerita'])->name('home.berita');

Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');

Route::group(['middleware' => 'auth:user'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password', [DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password', [DashboardController::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah', [KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah', [KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
        Route::get('/kategori/export-pdf', [KategoriController::class, 'exportPdf'])->name('kategori.exportPdf');

        Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/tambah', [BeritaController::class, 'tambah'])->name('berita.tambah');
        Route::post('/berita/prosesTambah', [BeritaController::class, 'prosesTambah'])->name('berita.prosesTambah');
        Route::get('/berita/ubah/{id}', [BeritaController::class, 'ubah'])->name('berita.ubah');
        Route::post('/berita/prosesUbah', [BeritaController::class, 'prosesUbah'])->name('berita.prosesUbah');
        Route::get('/berita/hapus/{id}', [BeritaController::class, 'hapus'])->name('berita.hapus');

        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user.tambah');
        Route::post('/user/prosesTambah', [UserController::class, 'prosesTambah'])->name('user.prosesTambah');
        Route::get('/user/ubah/{id}', [UserController::class, 'ubah'])->name('user.ubah');
        Route::post('/user/prosesUbah', [UserController::class, 'prosesUbah'])->name('user.prosesUbah');
        Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');

        Route::get('/page', [PageController::class, 'index'])->name('page.index');
        Route::get('/page/tambah', [PageController::class, 'tambah'])->name('page.tambah');
        Route::post('/page/prosesTambah', [PageController::class, 'prosesTambah'])->name('page.prosesTambah');
        Route::get('/page/ubah/{id}', [PageController::class, 'ubah'])->name('page.ubah');
        Route::post('/page/prosesUbah', [PageController::class, 'prosesUbah'])->name('page.prosesUbah');
        Route::get('/page/hapus/{id}', [PageController::class, 'hapus'])->name('page.hapus');

        Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/tambah', [MenuController::class, 'tambah'])->name('menu.tambah');
        Route::post('/menu/prosesTambah', [MenuController::class, 'prosesTambah'])->name('menu.prosesTambah');
        Route::get('/menu/ubah/{id}', [MenuController::class, 'ubah'])->name('menu.ubah');
        Route::post('/menu/prosesUbah', [MenuController::class, 'prosesUbah'])->name('menu.prosesUbah');
        Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('menu.hapus');
        Route::get('/menu/order/{idMenu}/{idSwap}', [MenuController::class, 'order'])->name('menu.order');

    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)){
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("content-Type", $type);
    return $response;
})->name('storage');
