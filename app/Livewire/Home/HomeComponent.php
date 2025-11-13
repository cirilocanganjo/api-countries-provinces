<?php

namespace App\Livewire\Home;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomeComponent extends Component
{
    public $id,$province_id,$countries = [],$country,$json,$provinces = [],$province,$countrySearcher, $provinceSearcher,$baseUrl, $countryStatus = false,$provinceStatus = false,
    $country_name,$country_continent_name,$country_date_and_time_foundation, $country_status,$province_name,$province_date_and_time_foundation,$province_status,$provinces_country;   
    protected $listeners = ["confirmCountryDeletion", "confirmProvinceDeletion"];


    public function mount () {
       $this->baseUrl = url('/api');
       $this->getCountries();
       $this->getProvinces();
    }
    #[Layout("layouts.home.app")]
    public function render()
    {
        return view('livewire.home.home-component');
    }

    public function getCountries ()
    {
        try {            
            $response = Http::get("{$this->baseUrl}/paises", [
            'searcher' => $this->countrySearcher,
        ]);       

       if ($response->successful()) {
            $this->json = $response->json();
            $this->countries = $this->json['data'] ?? [];
        } else {
            $this->countries = [];
        }

        } catch (\Throwable $th) {
         LivewireAlert::title('Erro')
          ->text('erro: ' .$th->getMessage())
          ->error()
          ->timer(0)
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function getProvinces ()
    {
        try {            
            $response = Http::get("{$this->baseUrl}/provincias/paises-associados", [
            'searcher' => $this->provinceSearcher,
        ]);       

       if ($response->successful()) {
            $this->json = $response->json();
            $this->provinces = $this->json['data'] ?? [];
        } else {
            $this->provinces = [];
        }

        } catch (\Throwable $th) {
         LivewireAlert::title('Erro')
          ->text('erro: ' .$th->getMessage())
          ->error()
          ->timer(0)
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function updatedProvinceSearcher() {
        $this->getProvinces();
    }
    

    public function updatedCountrySearcher(){            
    $this->getCountries();
    }

    
    public function storeCountry () {
           $this->validate([
            'country_name' => 'required',
            'country_continent_name' => 'required',
            'country_date_and_time_foundation' => 'required'
        ],[
            'country_name' => 'Campo obrigatório*',
            'country_continent_name' => 'Campo obrigatório*',
            'country_date_and_time_foundation' => 'Campo obrigatório*'
        ]);

        $response = Http::post("{$this->baseUrl}/paises", [
            'name' =>  $this->pull('country_name'),
            'continent_name' =>  $this->pull('country_continent_name'),
            'date_and_time_foundation' => $this->pull('country_date_and_time_foundation'),
        ]);       
        
         if ($response->successful()) {
             $this->getCountries();
             $this->resetValidation();
            LivewireAlert::title('Sucesso')
                ->text('País cadatrado com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();
         }
    }

    public function storeProvince () {
           $this->validate([
            'province_name' => 'required',
            'province_date_and_time_foundation' => 'required',
            'provinces_country' => 'required'
        ],[
            'province_name' => 'Campo obrigatório*',
            'provinces_country' => 'Campo obrigatório*',
            'province_date_and_time_foundation' => 'Campo obrigatório*'
        ]);

        $response = Http::post("{$this->baseUrl}/provincias", [
            'name' =>  $this->pull('province_name'),
            'date_and_time_foundation' => $this->pull('province_date_and_time_foundation'),
            'country_id' => $this->pull('provinces_country'),
        ]);       
        
         if ($response->successful()) {
             $this->getProvinces();
             $this->resetValidation();
            LivewireAlert::title('Sucesso')
                ->text('Província cadatrado com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();
         }
    }
    

    public function editCountry($id) {
        $this->id = $id;
        $this->country = collect($this->countries)->firstWhere('id', $id);
        if ($this->country) {
            $this->country_name = $this->country['name'];
            $this->country_continent_name = $this->country['continent_name'];
            $this->country_status = $this->country['status'];
            $this->country_date_and_time_foundation = $this->country['date_and_time_foundation'];
        }
        $this->countryStatus = true;
    }

    public function editProvince($id) {
        $this->province_id = $id;
        $this->province = collect($this->provinces)->firstWhere('id', $id);
        if ($this->province) {
            $this->province_name = $this->province['name'];
            $this->province_date_and_time_foundation = $this->province['date_and_time_foundation'];
            $this->provinces_country = $this->province['country_id'];
            $this->province_status = $this->province['status'];
        }
        $this->provinceStatus = true;
    }

    public function updateCountry() {
         $this->validate([
            'country_name' => 'required',
            'country_continent_name' => 'required',
            'country_date_and_time_foundation' => 'required'
        ],[
            'country_name' => 'Campo obrigatório*',
            'country_continent_name' => 'Campo obrigatório*',
            'country_date_and_time_foundation' => 'Campo obrigatório*'
        ]);

         $response = Http::put("{$this->baseUrl}/paises/{$this->id}", [
            'name' =>  $this->country_name,
            'continent_name' =>  $this->country_continent_name,
            'date_and_time_foundation' => $this->country_date_and_time_foundation,
            'status' =>$this->country_status
        ]); 

        if ($response->successful()) {
            $this->getCountries();
            LivewireAlert::title('Sucesso')
             ->text('País atualizado com sucesso!')
             ->success()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
        } 
    }

     public function updateProvince() {
           $this->validate([
            'province_name' => 'required',
            'province_date_and_time_foundation' => 'required',
            'provinces_country' => 'required'
        ],[
            'province_name' => 'Campo obrigatório*',
            'provinces_country' => 'Campo obrigatório*',
            'province_date_and_time_foundation' => 'Campo obrigatório*'
        ]);

         $response = Http::put("{$this->baseUrl}/provincias/{$this->province_id}", [
            'name' =>  $this->province_name,
            'date_and_time_foundation' => $this->province_date_and_time_foundation,
            'country_id' => $this->provinces_country,
            'status' =>$this->province_status
        ]); 

        if ($response->successful()) {
            $this->getProvinces();
            LivewireAlert::title('Sucesso')
             ->text('Província atualizada com sucesso!')
             ->success()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
        } 
    }

    public function deleteCountry ($id) {
         $this->id = $id;
         LivewireAlert::title('Atenção')
            ->text('Deseja realmente, eliminar este país?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirmCountryDeletion')
            ->show();
    }

    public function deleteProvince ($id) {
         $this->province_id = $id;
         LivewireAlert::title('Atenção')
            ->text('Deseja realmente, eliminar esta província?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirmProvinceDeletion')
            ->show();
    }

    public function confirmProvinceDeletion () {
         $response = Http::delete("{$this->baseUrl}/provincias/{$this->province_id}"); 
          if ($response->successful()) { 
            $this->getProvinces();
            LivewireAlert::title('Sucesso')
                ->text('Província eliminada com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();
          }
    }
    
    public function confirmCountryDeletion () {
         $response = Http::delete("{$this->baseUrl}/paises/{$this->id}"); 
          if ($response->successful()) { 
            $this->getCountries();
            LivewireAlert::title('Sucesso')
                ->text('País eliminado com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();
          }
    }
    
    public function close () {
        $this->countryStatus = false;
        $this->provinceStatus = false;
        $this->reset(['id','province_id','country_name','country_continent_name','country_date_and_time_foundation','province_name', 'province_date_and_time_foundation', 'province_status', 'provinces_country']);
        
    }

}
