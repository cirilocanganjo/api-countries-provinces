<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public $countries;
    public function getCountries (Request $request) 
    {
        try {
           $this->countries = Country::query()->when($request->searcher, function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->searcher}%");
           })->get();

           if($this->countries->isNotEmpty()) {
            return response()->json(['data' => $this->countries], 200);
           }else{
               return response()->json(['message' => 'Nenhum resultado encontrado!'], 404);
            }

        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getmessage()], 500);
        }
    }

    public function store () {
        try {
            //code...
        } catch (\Throwable $th) {
         return response()->json(['error' => $th->getmessage()], 500);
        }
    }
}
