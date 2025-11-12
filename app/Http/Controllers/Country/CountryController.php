<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public $country,$countries;
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

    public function store (Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'continent_name' => 'required',
                'date_and_time_foundation' => 'required',
            ]);

            DB::beginTransaction();
            $data = Country::create($request->all());
            DB::commit();

            if ($data) {
                return response()->json(['message' => 'País cadastrado com sucesso!'],200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
         return response()->json(['error' => $th->getmessage()], 500);
        }
    }

    public function edit ($id) 
    {
        try {
            $this->country = Country::query()->find($id);
            if ($this->country) {
                return response()->json(['data' => $this->country]);
            }else{
              return response()->json(['message' => 'Nenhum resultado encontrado!'], 404);
            }

        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getmessage()], 500);
        }
    }

    public function delete($id) 
    {
        try {
            DB::beginTransaction();
            $this->country = Country::query()->findOrFail($id);           
            $deletedCountries = Country::destroy([$this->country->id]);
            DB::commit();
            if ($deletedCountries > 0) {
              return response()->json(['message' => 'Registo eliminado com sucesso!']);
            }
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getmessage()], 500);
        }
    }

    public function update (Request $request, $id) {
        try {
        DB::beginTransaction();
        $request->validate([
            'name' => 'required',
            'continent_name' => 'required',
            'date_and_time_foundation' => 'required',
        ]);
         $this->country = Country::query()->findOrFail($id);
            $updatedCountry = $this->country->update($request->all());
            DB::commit();
            if ($updatedCountry) {
                return response()->json(['message' => "Registo atualizado com sucesso!"]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
           return response()->json(['error' => $th->getmessage()], 500);
        }
    }
}
