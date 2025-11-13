@props(['countries' => []])

<div class='col-md-6'>
            <div class='card'>
                <div class='card-title bg-secondary text-light'>
                    <h2 class='mx-2'>Países</h2>
                </div>

                <div class='card-body'>

                    <div class='d-flex align-items-center gap-4 '>
                        <button data-bs-toggle='modal' data-bs-target='#country' class='btn btn-primary'>Adicionar<button>
                        <input  class='form-control ' placeholder='Pesquisar ...' type='text' wire:model.live='countrySearcher' />
                    </div>

                    <div class='table-responsive'>
                        <table class='table table-hover'>
                            <thead>
                                <th>Data</th>
                                <th>País</th>
                                <th>Continente</th>
                                <th>Fundação</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </thead>

                            <tbody>
                                <tbody>
                                    @if ($countries)
                                    @foreach ($countries as $country)
                                    
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($country['created_at'])->format('Y-m-d') }}</td>                                        
                                        <td>{{ $country['name'] }}</td>                                        
                                        <td>{{ $country['continent_name'] }}</td>                                        
                                        <td>{{ $country['date_and_time_foundation'] }}</td>                                        
                                        <td>{{ $country['status'] }}</td>     
                                        <td>
                                            <div class='d-flex align-items-center'>
                                                <button
                                                 wire:click="editCountry({{ $country['id'] }})"
                                                 data-bs-toggle='modal' 
                                                 data-bs-target='#country' 
                                                 class='btn btn-sm btn-primary'>  Editar</button>
                                                <button
                                                wire:click="deleteCountry({{ $country['id'] }})"
                                                class='mx-1 btn btn-sm btn-danger'>
                                                    Eliminar

                                                </button>
                                            </div>
                                        </td>                                   
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan='10' class='alert alert-warning text-center'>Nenhum resultado encontrado!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
