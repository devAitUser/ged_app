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

Route::post('/fill_table_edit_attributs',[App\Http\Controllers\OrganigrammeController::class, 'fill_table_edit_attributs']);


Route::post('/update_attributs',[App\Http\Controllers\OrganigrammeController::class, 'update_attributs']);

Route::post('/remove_champs_attributs',[App\Http\Controllers\OrganigrammeController::class, 'remove_champs_attributs']);



/****Dossier */

Route::get('/create_dossier',[App\Http\Controllers\DossierController::class, 'create_dossier'])->name('create_dossier');
Route::get('/fill_parent_dossier',[App\Http\Controllers\DossierController::class, 'fill_parent_dossier']);

Route::get('/fill_sous_dossier',[App\Http\Controllers\DossierController::class, 'fill_sous_dossier']);

Route::get('/fill_sous_dossier1',[App\Http\Controllers\DossierController::class, 'fill_sous_dossier1']);


Route::post('/store_dossier',[App\Http\Controllers\DossierController::class, 'store_dossier']);

Route::get('/show_dossier/{id}',[App\Http\Controllers\DossierController::class, 'show_dossier']);


/****boites */

Route::resource('boites',App\Http\Controllers\BoiteController::class);
//Route::get('/create', [App\Http\Controllers\BoiteController::class, 'create'])->name('create');
//Route::get('/register1',[App\Http\Controllers\Auth\RegisterController::class, 'test']);
Route::get('/user_show', [App\Http\Controllers\UserController::class, 'test'])->name('user_show');
Route::get('/user_list', [App\Http\Controllers\UserController::class, 'test2'])->name('user_list');
Route::post('/ajouter', [App\Http\Controllers\UserController::class, 'create'])->name('add');
Route::get('/verify', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');
Route::post('/checkLogin', [App\Http\Controllers\UserController::class, 'checkLogin'])->name('checkLogin');
Route::get('/showUser/{id}', [App\Http\Controllers\UserController::class, 'showUser']);
Route::get('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
////////////////////////////////////////////////


Route::get('/role_liste', [App\Http\Controllers\RoleController::class, 'voirlist'])->name('role_liste');
Route::get('/listfinal', [App\Http\Controllers\RoleController::class, 'listfinal'])->name('listfinal');

//////////////////////////////////////////////////////
Route::resource('roles',App\Http\Controllers\RoleController::class);
Route::resource('permissions',App\Http\Controllers\PermissionController::class);
Route::post('/rolepermission/{role}', [App\Http\Controllers\RoleController::class, 'givePermission'])->name('rolepermission');
Route::delete('/revokePermission/{role}/{permission}', [App\Http\Controllers\RoleController::class, 'revokePermission'])->name('revokePermission');
///////////////////////////////////////////////////////////////
Route::post('/assignRole/{user}', [App\Http\Controllers\UserController::class, 'assignRole'])->name('assignRole');
Route::delete('/removeRole/{user}/{role}', [App\Http\Controllers\UserController::class, 'removeRole'])->name('removeRole');
Route::post('/givePermission/{user}', [App\Http\Controllers\UserController::class, 'givePermission'])->name('givePermission');
Route::delete('/revokePermission/{user}/permissions/{permission}', [App\Http\Controllers\UserController::class, 'revokePermission'])->name('revokePermission');


