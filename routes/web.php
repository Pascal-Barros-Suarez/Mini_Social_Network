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
    return 'wellcome ' . $nombre;
});

//Crea una ruta que tenga un parámetro que sea opcional y tenga un valor por defecto en caso de que no se especifique.
Route::get('/goodbye/{nombre?}', function ($nombre = 'Pascal') {
    return 'goodbye ' . $nombre;
});

// Crea una ruta que atienda por POST y compruébala con Postman.
Route::post('/wellcome/{nombre?}', function ($nombre = 'Pascal') {
    return 'hi ' . $nombre;
});

// Crea una ruta que atienda por GET y por POST (en un único método) y compruébalas. Vuelve a habilitar el filtro VerifyCsrfToken en el fichero kernel.php (carpeta Http).
Route::match(['get', 'post'], '/getpost', function () {
    return 'esta ruta atiende tanto por get como por post';
});

//Crea una ruta que compruebe que un parámetro está formado sólo por números.
Route::get('/num/{num}', function ($num) {
    return 'tu numero: ' . $num;
});

//Crea una ruta con dos parámetros que compruebe que el primero está formado sólo por letras y el segundo sólo por números.
Route::get('/numlet/{num}/{leter}', function ($num, $leter) {
    return 'tu numero: ' . $num . ' y tu frase: ' . $leter;
});

//Utiliza el helper env para que cuando se acceda a la ruta /host nos devuleva la dirección IP donde se encuentra la base de datos de nuestro proyecto.
Route::get('/host', function () {
    return 'tu ip: ' . env('DB_HOST');
});