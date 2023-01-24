<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store']);


require __DIR__ . '/auth.php';

//Crea una ruta que tenga un parámetro que sea opcional y comprueba que funciona.
Route::get('/wellcome/{nombre?}', function ($nombre = null) {
    return 'wellcome '.$nombre;
});

//Crea una ruta que tenga un parámetro que sea opcional y tenga un valor por defecto en caso de que no se especifique.
Route::get('/goodbye/{nombre?}', function ($nombre = 'Pascal') {
    return 'goodbye '.$nombre;
});


Route::post('/wellcome/{nombre?}', function ($nombre = 'Pascal') {
    return 'hi '.$nombre;
});
