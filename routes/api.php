<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ShotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('players', [PlayerController::class, 'store'])->name('players.store');
Route::put('players/{player}', [PlayerController::class, 'update'])->name('players.update');
Route::post('players/{player}/games', [ShotController::class, 'store'])->name('players.store');
Route::delete('players/{player}/games', [ShotController::class, 'destroy'])->name('players.destroy');

Route::get('players', [PlayerController::class, 'index'])->name('players.index');//revisar

Route::get('players/{player}/games', [ShotController::class, 'show'])->name('players.index');
Route::get('players/ranking', [PlayerController::class, 'rank'])->name('players.rank');
Route::get('players/ranking/loser', [PlayerController::class, 'loser'])->name('players.rankloser');
Route::get('players/ranking/winner', [PlayerController::class, 'winner'])->name('players.rankwinner');




// POST /players                  OK       // crea un jugador
// PUT /players/{id}              OK       // modifica el nom del jugador
// POST /players/{id}/games/      OK       // un jugador específic realitza una tirada dels daus.
// DELETE /players/{id}/games     OK       // elimina les tirades del jugador
// GET /players                   casi OK        // retorna el llistat de tots els jugadors del sistema amb el seu percentatge mig d’èxits 
// GET /players/{id}/games        OK       // retorna el llistat de jugades per un jugador.
// GET /players/ranking           OK         // retorna el ranking mig de tots els jugadors del sistema. És a dir, el percentatge mig d’èxits.
// GET /players/ranking/loser     OK         // retorna el jugador amb pitjor percentatge d’èxit
// GET /players/ranking/winner    OK         // retorna el jugador amb pitjor percentatge d’èxit.
