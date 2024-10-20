<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RickMortyController; // Import the controller

// Ruta por defecto
Route::get('/', function () {
    return view('characters');
});

// Ruta para obtener los personajes de Rick y Morty
Route::get('/characters', [RickMortyController::class, 'getcharacters']); 
