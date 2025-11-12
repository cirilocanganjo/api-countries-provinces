<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Country\CountryController;


Route::get("/paises", [CountryController::class, 'getCountries']);
Route::get("/paises/{id}", [CountryController::class, 'edit']);
Route::post("/paises", [CountryController::class, 'store']);
Route::put("/paises/{id}", [CountryController::class, 'update']);
Route::delete("/paises/{id}", [CountryController::class, 'delete']);