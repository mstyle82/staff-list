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

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false
    ]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/edit-myprof', [App\Http\Controllers\HomeController::class, 'edit']);
Route::get('/myprof-image.store', [App\Http\Controllers\HomeController::class, 'store']);
Route::post('/myprof-image.store', [App\Http\Controllers\HomeController::class, 'store']);
Route::post('/edit-myprof.update', [App\Http\Controllers\HomeController::class, 'update']);

Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/list-card', [App\Http\Controllers\UserController::class, 'show_card']);
Route::post('/list-card', [App\Http\Controllers\UserController::class, 'show_card']);
Route::get('/list/{id?}', [App\Http\Controllers\UserController::class, 'list']);
Route::get('/list-image.store', [App\Http\Controllers\UserController::class, 'store']);
Route::post('/list-image.store', [App\Http\Controllers\UserController::class, 'store']);
Route::get('/edit-list/{id?}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/edit-list.update', [App\Http\Controllers\UserController::class, 'update']);

Route::get('/conf-group', [App\Http\Controllers\GroupController::class, 'index']);
Route::post('/group_store', [App\Http\Controllers\GroupController::class, 'store']);
Route::post('/group_update', [App\Http\Controllers\GroupController::class, 'update']);

Route::get('/conf-title', [App\Http\Controllers\TitleController::class, 'index']);
Route::post('/title_store', [App\Http\Controllers\TitleController::class, 'store']);
Route::post('/title_update', [App\Http\Controllers\TitleController::class, 'update']);

Route::get('/conf-team', [App\Http\Controllers\TeamController::class, 'index']);
Route::post('/team_store', [App\Http\Controllers\TeamController::class, 'store']);
Route::post('/team_update', [App\Http\Controllers\TeamController::class, 'update']);

Route::get('/conf-worklocation', [App\Http\Controllers\WorkLocationController::class, 'index']);
Route::post('/worklocation_store', [App\Http\Controllers\WorkLocationController::class, 'store']);
Route::post('/worklocation_update', [App\Http\Controllers\WorkLocationController::class, 'update']);

Route::get('/conf-tag', [App\Http\Controllers\TagController::class, 'index']);
Route::post('/conf_store', [App\Http\Controllers\TagController::class, 'store']);
Route::post('/conf_update', [App\Http\Controllers\TagController::class, 'update']);

Route::get('/conf-staff', [App\Http\Controllers\StaffStatusController::class, 'index']);
Route::post('/staff_store', [App\Http\Controllers\StaffStatusController::class, 'store']);
Route::post('/staff_update', [App\Http\Controllers\StaffStatusController::class, 'update']);


Route::group(['middleware' => 'auth'], function() {
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'getRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
 });
\URL::forceScheme('https');



