<?php

use App\Http\Controllers\Province\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(ProvinceController::class)->group(function () {
Route::get("/provincias", 'getProvinces');
Route::get("/provincias/paises-associados", 'getProvinceswithInnerJoin');
Route::post("/provincias", "store");
Route::get("/provincias/{id}", "edit");
Route::put("/provincias/{id}", "update");
Route::delete("/provincias/{id}", "delete");
});