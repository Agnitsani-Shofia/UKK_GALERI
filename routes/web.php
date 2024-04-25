<?php

use Illuminate\Support\Facades\Route;
use App\Models\GallaryImage;

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

Route::get('/', function () {
    $data = GallaryImage::all();
    return view('welcome', compact('data'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\ImageController::class, 'personal'])->name('home');
Route::post('/image-store', [App\Http\Controllers\ImageController::class, 'storeImage'])->name('image-store');
Route::get('/detailImage/{image}', [App\Http\Controllers\ImageController::class, 'detailImage'])->name('detail');
Route::get('/welcome', [App\Http\Controllers\ImageController::class, 'welcome'])->name('welcome');
Route::delete('/destroy/{image}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('destroy');
Route::get('/image-create', [App\Http\Controllers\HomeController::class, 'index'])->name('personal');
Route::get('/edit/{image}', [App\Http\Controllers\ImageController::class, 'edit'])->name('edit');
Route::match(['put', 'patch'], '/update/{image}', [App\Http\Controllers\ImageController::class, 'update'])->name('update');