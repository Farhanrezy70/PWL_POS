<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use Monolog\Handler\RotatingFileHandler;

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
// Halaman Home
//Route::get('/', [HomeController::class, 'home']);

// Halaman Products dengan Prefix "/category"
//Route::prefix('category')->group(function () {
//    Route::get('/food-beverage', [ProductsController::class, 'foodBeverage'])->name('category.food-beverage');
//    Route::get('/beauty-health', [ProductsController::class, 'beautyHealth'])->name('category.beauty-health');
//    Route::get('/home-care', [ProductsController::class, 'homeCare'])->name('category.home-care');
//    Route::get('/baby-kid', [ProductsController::class, 'babyKid'])->name('category.baby-kid');
//});

// Halaman User profile
//Route::get('/profile', [UserController::class, 'profile'])->name('profile');

// Halaman Penjualan
//Route::get('/sales', [SalesController::class, 'index'])->name('sales');

//Route::get('/level', [LevelController::class, 'index']);
//Route::get('/kategori', [KategoriController::class, 'index']);
//Route::get('/user', [UserController::class, 'index']);
//Route::get('/user/tambah', [UserController::class, 'tambah']);
//Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
//Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
//Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
//Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//Route::get('/kategori', [KategoriController::class, 'index']);
//Route::get('/kategori/create', [KategoriController::class, 'create']);
//Route::post('/kategori', [KategoriController::class, 'store']);
//Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
//Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
//Route::resource('kategori', KategoriController::class);

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register.form');
Route::post('/register', [AuthController::class, 'store_user'])->name('register.store');

Route::middleware('auth')->group(function () {
   
    Route::get('/', [WelcomeController::class, 'index']);
   
    
        Route::middleware(['authorize:ADM'])->prefix('user')->group(function (){
        Route::get('/', [UserController::class, 'index']);       // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);    // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']);// menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);      // menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);// menampilkan halaman form tambah user ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']);      // menyimpan data user baru ajax
        Route::get('/{id}', [UserController::class, 'show']);    // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);// menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);  // menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);// menampilkan halaman form edit user ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);  // menyimpan perubahan data user ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);// menampilkan halaman form confirm delete user ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);  // untuk hapus data user ajax
        Route::delete('/{id}', [UserController::class, 'destroy']);// menghapus data user
    });
    
    
        Route::middleware(['authorize:ADM'])->prefix('level')->group(function (){
        Route::get('/', [LevelController::class, 'index']);       // menampilkan halaman awal level
        Route::post('/list', [LevelController::class, 'list']);    // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/create', [LevelController::class, 'create']);// menampilkan halaman form tambah level
        Route::post('/', [LevelController::class, 'store']);      // menyimpan data level baru
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);// menampilkan halaman form tambah level
        Route::post('/ajax', [LevelController::class, 'store_ajax']);      // menyimpan data level baru
        Route::get('/{id}', [LevelController::class, 'show']);    // menampilkan detail level
        Route::get('/{id}/edit', [LevelController::class, 'edit']);// menampilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']);  // menyimpan perubahan data level
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);// menampilkan halaman form edit level
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);  // menyimpan perubahan data level
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);// menampilkan halaman form edit level
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);  // menyimpan perubahan data level
        Route::delete('/{id}', [LevelController::class, 'destroy']);// menghapus data level
    });
        
        Route::middleware(['authorize:ADM'])->prefix('kategori')->group(function (){
        Route::get('/', [KategoriController::class, 'index']);
        Route::post('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/{id}', [KategoriController::class, 'show']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);
        Route::put('/{id}', [KategoriController::class, 'update']);
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('/{id}', [KategoriController::class, 'destroy']);
    });
    
        Route::middleware(['authorize:ADM, MNG'])->prefix('supplier')->group(function (){
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('/list', [SupplierController::class, 'list']);
        Route::get('/create', [SupplierController::class, 'create']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/{id}', [SupplierController::class, 'show']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);
        Route::put('/{id}', [SupplierController::class, 'update']);
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::delete('/{id}', [SupplierController::class, 'destroy']);
    });
    
        Route::middleware(['authorize:ADM, MNG'])->prefix('barang')->group(function (){
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/list', [BarangController::class, 'list']);
        Route::get('/create', [BarangController::class, 'create']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::get('/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);
    });
    
});    