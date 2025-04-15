<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OutfitsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrendaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EtiquetaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Sin autenticación)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren autenticación)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Página principal del dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Página de outfits
    Route::get('/outfits', function () {
        return view('outfits');
    })->name('outfits');

    // Página del guardarropa (Closet)
    Route::get('/closet', [PrendaController::class, 'index'])->name('closet.index');

    /*
    |--------------------------------------------------------------------------
    | Rutas RESTful de recursos (CRUD)
    |--------------------------------------------------------------------------
    */

    Route::resource('closet', PrendaController::class);
    Route::resource('outfits', OutfitsController::class);
    Route::resource('categorias', CategoriaController::class)->only(['index', 'store']);
    Route::resource('marcas', MarcaController::class)->only(['index', 'store']);
    Route::resource('tallas', TallaController::class)->only(['index', 'store']);
    Route::resource('colores', ColorController::class)->only(['index', 'store']);
    Route::resource('etiquetas', EtiquetaController::class)->only(['index', 'store']);

    /*
    |--------------------------------------------------------------------------
    | Rutas para APIs y AJAX
    |--------------------------------------------------------------------------
    */
    
    Route::get('/prenda/{id}', [PrendaController::class, 'getPrenda']);
    
    Route::get('/api/prendas', [PrendaController::class, 'getAllPrendas'])->name('prendas.api');
    Route::get('/api/categorias', [CategoriaController::class, 'getAllCategorias'])->name('categorias.api');
    Route::get('/api/marcas', [MarcaController::class, 'getAllMarcas'])->name('marcas.api');
    Route::get('/api/colores', [ColorController::class, 'getAllColors'])->name('colores.api');
    Route::get('/api/tallas', [TallaController::class, 'getAllTallas'])->name('tallas.api');
    Route::get('/api/outfits', [OutfitsController::class, 'getAllOutfits'])->name('outfits.api');
    
});

/*
|--------------------------------------------------------------------------
| Rutas de Perfil de Usuario
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';