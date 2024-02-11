<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\User;
use App\Http\Controllers\Admin\FoodCompositionList;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// あとでコメントアウト予定メール検証をする予定がないため。テストユーザーはseederで検証済みになっている。
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ユーザー管理画面
    Route::get('/user', User\IndexController::class)->name('admin.user.index');
    Route::delete('/user/{id}', User\DeleteController::class)->name('admin.user.delete');

    // 食品構成表の表示とインポート
    Route::get('/food_composition_list', FoodCompositionList\IndexController::class)->name('admin.food_composition_list.index');
    Route::post('/food_composition_list', FoodCompositionList\CreateController::class)->name('admin.food_composition_list.create');
});

require __DIR__.'/auth.php';
