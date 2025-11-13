@props(['countries' => [], 'provinceStatus' => false])

<div wire:ignore.self class="modal fade" id="province" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog  modal-dialog-scrollable">
          <div class='modal-content'>
            <div class="modal-header">
                <h5 class="modal-title text-uppercase"> {{ $provinceStatus ? 'Editar província' : 'Adicionar província'}} </h5>
                <button id='closeProvinceModal' wire:click='close' class="modal-close" onclick="closeModal()">&times;</button>
            </div>

            <div class='modal-body'>
                <div class='form-group'>
                    <label>Nome da província</label>
                    <input class='form-control' type='text' wire:model='province_name' />
                    @error('province_name') <span class='text-danger'>{{$message}}</span> @enderror
                </div>

                <div class='form-group'>
                    <label>País</label>
                    <select class='form-control' wire:model='provinces_country'>
                        <option>Selecionar</option>
                        @if ($countries)
                        @foreach ($countries as $country)
                        <option value='{{$country['id']}}'>{{$country['name']}}</option>                            
                        @endforeach
                        @endif
                    </select>
                    @error('provinces_country') <span class='text-danger'>{{$message}}</span> @enderror
                </div>
              

                <div class='form-group'>
                    <label>Data de fundação</label>
                    <input class='form-control' type='datetime-local' wire:model='province_date_and_time_foundation' />
                    @error('province_date_and_time_foundation') <span class='text-danger'>{{$message}}</span> @enderror
                </div>

                <div class='{{$provinceStatus ? 'd-block' : 'd-none'}} form-group'>
                    <label>Status</label>
                    <select wire:model='province_status' class='form-control'>
                        <option>Selecionar</option>
                        <option value='1'>Activo</option>
                        <option value='0'>Inactivo</option>
                    </select>
                </div>

                <div>
                    <button 
                    wire:click='{{ $provinceStatus ? 'updateProvince' : 'storeProvince' }}'
                    class='btn {{ $provinceStatus ? 'btn-success' : 'btn-primary' }} 
                    '>{{$provinceStatus ? 'Atualizar' : 'Salvar'}}
                 </button>
                </div>
            </div>

          </div>
        </div>
</div>