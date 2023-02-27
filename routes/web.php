<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.index');
});

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DocumentController;

Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index')->middleware('auth');  // middleware() pour retourner a login si pas connecté
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show')->middleware('auth');
Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('blog-create', [BlogPostController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update'])->middleware('auth');
Route::delete('blog-edit/{blogPost}', [BlogPostController::class, 'destroy'])->middleware('auth');

Route::get('blog/{blogPost}/pdf', [BlogPostController::class, 'pdf'])->name('blog.pdf')->middleware('auth');



// Document
Route::get('document', [DocumentController::class, 'index'])->name('document.index')->middleware('auth');  // middleware() pour retourner a login si pas connecté
Route::get('document/{document}', [DocumentController::class, 'show'])->name('document.show')->middleware('auth');

Route::get('document-create', [DocumentController::class, 'create'])->name('document.create')->middleware('auth');
Route::get('document-create', [DocumentController::class, 'create'])->name('document.create')->middleware('auth');
Route::post('document-create', [DocumentController::class, 'store'])->name('document.store')->middleware('auth');

Route::get('download/{document}', [DocumentController::class, 'download'])->name('download')->middleware('auth');

Route::get('document-edit/{document}', [DocumentController::class, 'edit'])->name('document.edit')->middleware('auth');

Route::put('document-edit/{document}', [DocumentController::class, 'update'])->middleware('auth');
Route::delete('document-edit/{document}', [DocumentController::class, 'destroy'])->middleware('auth');




Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'authentication'])->name('login.auth');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');


Route::get('/registration', [CustomAuthController::class, 'create'])->name('user.registration');
Route::post('/registration-store', [CustomAuthController::class, 'store'])->name('user.store');

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot.pass');
Route::post('forgot-password', [CustomAuthController::class, 'tempPassword'])->name('temp.pass');
Route::get('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'newPassword'])->name('new.pass');
Route::post('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'storeNewPassword'])->name('store.pass');



use App\Http\Controllers\LocalizationController;

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');



//test eloquent
Route::get('query', [BlogPostController::class, 'query']);
Route::get('page', [BlogPostController::class, 'page']);
