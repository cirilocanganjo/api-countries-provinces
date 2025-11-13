@props(['countryStatus' => false])
<div wire:ignore.self class="modal fade" id="country" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog  modal-dialog-scrollable">
          <div class='modal-content'>
            <div class="modal-header">
                <h5 class="modal-title text-uppercase"> {{ $countryStatus ? 'Editar país' : 'Adicionar país'}} </h5>
                <button id='closeCountryModal' wire:click='close' class="modal-close" onclick="closeModal()">&times;</button>
            </div>

            <div class='modal-body'>
                <div class='form-group'>
                    <label>Nome do país</label>
                    <input class='form-control' type='text' wire:model='country_name' />
                    @error('country_name') <span class='text-danger'>{{$message}}</span> @enderror
                </div>

                <div class='form-group'>
                    <label>Continente</label>
                    <input class='form-control' type='text' wire:model='country_continent_name' />
                    @error('country_continent_name') <span class='text-danger'>{{$message}}</span> @enderror
                </div>

                <div class='form-group'>
                    <label>Data de fundação</label>
                    <input class='form-control' type='datetime-local' wire:model='country_date_and_time_foundation' />
                    @error('country_date_and_time_foundation') <span class='text-danger'>{{$message}}</span> @enderror
                </div>

                <div class='{{$countryStatus ? 'd-block' : 'd-none'}} form-group'>
                    <label>Status</label>
                    <select wire:model='country_status' class='form-control'>
                        <option>Selecionar</option>
                        <option value='1'>Activo</option>
                        <option value='0'>Inactivo</option>
                    </select>
                </div>

                <div>
                    <button 
                    wire:click='{{ $countryStatus ? 'updateCountry' : 'storeCountry' }}'
                    class='btn {{ $countryStatus ? 'btn-success' : 'btn-primary' }} 
                    '>{{$countryStatus ? 'Atualizar' : 'Salvar'}}
                 </button>
                </div>
            </div>

          </div>
        </div>
</div>

