<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



require __DIR__ . '/country/routes.php';
require __DIR__ . '/province/routes.php';


