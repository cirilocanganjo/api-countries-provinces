<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use \App\Models\Province;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public $status,$province,$provinces;


    public function getProvinces (Request $request) {
        try {
            $this->provinces = Province::query()->when($request->searcher, fn ($q)  => 
            $q->where('name', 'like', "%{$request->searcher}%")
            )->get();

            if ($this->provinces->isNotEmpty()) {
                return response()->json(['data' => $this->provinces]);
            }else{
             return response()->json(['message' => 'Nenhum resultado encontrado!'], 404);
            }
        } catch (\Throwable $th) {
          return response()->json(['error' => $th->getmessage()], 500);
        }
    }

    public function getProvinceswithInnerJoin(Request $request) {
        try{
            $this->provinces = Province::query()->when($request->searcher, fn ($q)  => 
            $q->where('name', 'like', "%{$request->searcher}%")
            )->with('country')
            ->get();

            if ($this->provinces->isNotEmpty()) {
                return response()->json(['data' => $this->provinces]);
            }else{
             return response()->json(['message' => 'Nenhum resultado encontrado!'], 404);
            }
        }catch(Exception $ex){
         return response()->json(['error' => $ex->getmessage()], 500);
        }
    }

    public function store (Request $request) {
        try {
            $request->validate([
                'name' => 'required',               
                'date_and_time_foundation' => 'required',
                'country_id' => 'required'
            ]);

            DB::beginTransaction();
            $data = Province::create($request->all());
            DB::commit();

            if ($data) {
                return response()->json(['message' => 'Província cadastrada com sucesso!'],200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
         return response()->json(['error' => $th->getmessage()], 500);
        }
    }

    public function edit ($id) 
    {
        try {
            $this->province = Province::query()->find($id);
            if ($this->province) {
                return response()->json(['data' => $this->province]);
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
            $this->province = Province::query()->findOrFail($id);           
            $deletedProvinces = Province::destroy([$this->province->id]);
            DB::commit();
            if ($deletedProvinces > 0) {
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
            'country_id' => 'required',
            'date_and_time_foundation' => 'required',
        ]);
         $this->status = $request->input('status');
         $this->province = Province::query()->findOrFail($id);
            $updatedProvince = $this->province->update($request->all(), ['status' => $this->status]);
            DB::commit();
            if ($updatedProvince) {
                return response()->json(['message' => "Registo atualizado com sucesso!"]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
           return response()->json(['error' => $th->getmessage()], 500);
        }
    }


    
}
