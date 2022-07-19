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

    if(Auth::check()) 
    {
        return redirect()->route('home');

    } else {

        return redirect()->route('login');

    }

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user_profile', [App\Http\Controllers\UserController::class, 'index'])->name('user_profile');

Route::post('/user_profile_update', [App\Http\Controllers\UserController::class, 'update'])->name('user_profile_update');


//Route::get('/organigramme1', [App\Http\Controllers\OrganigrammeController::class, 'index'])->name('organigramme');

Route::get('/organigramme', [App\Http\Controllers\OrganigrammeController::class, 'home_organigramme'])->name('home_organigramme');


Route::post('/array_organigramme', [App\Http\Controllers\OrganigrammeController::class, 'array_organigramme'])->name('test_ajax');

Route::post('/fill_drop_down', [App\Http\Controllers\OrganigrammeController::class, 'all_data_select'])->name('array_drop_down');

Route::post('/store_dossier', [App\Http\Controllers\OrganigrammeController::class, 'store_dossier'])->name('store_dossier');


Route::get('/array_organigramme_simple', [App\Http\Controllers\OrganigrammeController::class, 'array_organigramme_simple']);


Route::post('/delete_dossier', [App\Http\Controllers\OrganigrammeController::class, 'delete_dossier']);



Route::get('/table_organigramme', [App\Http\Controllers\OrganigrammeController::class, 'table_organigramme']);

Route::post('/create_organigramme', [App\Http\Controllers\OrganigrammeController::class, 'create_organigramme']);

Route::post('/delete_organigramme', [App\Http\Controllers\OrganigrammeController::class, 'delete_organigramme_item']);

Route::get('/organigramme/{id}/edit',[App\Http\Controllers\OrganigrammeController::class, 'edit_organigramme']);


Route::post('/check_have_parent',[App\Http\Controllers\OrganigrammeController::class, 'check_have_parent']);


