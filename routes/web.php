<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\UserController;
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
    return view('index');
});



//SuperAdmin Routes
Route::prefix('superadmin')->middleware(['auth','auth.isSuperAdmin'])->name('superadmin.')->group(function(){ //isSUperAdmin is from accessSuperAdmin

    Route::resource('/users',UserController::class);

});