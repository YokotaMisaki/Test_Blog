<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

//　ブログ一覧を表示
Route::get('/', [BlogController::class, 'showList'])->name
('blogs');

// ブログ登録画面を表示
Route::get('/blog/create', [BlogController::class, 'showCreate'])->name
('create');//⇦ルート名

// ブログ登録
Route::post('/blog/store', [BlogController::class, 'exeStore'])->name
('store');

// ブログ詳細画面表示
Route::get('/blog/{id}', [BlogController::class, 'showDetail'])->name
('show');


// 未ログイン時はログインページにリダイレクト
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//検索機能
Route::get('/search', [BlogController::class, 'getSearch'])->name
('search');

//ブログ削除
Route::post('/blog/delete/{id}', [BlogController::class,'exeDelete'])->name
('delete');