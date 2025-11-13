@props(['provinces' => [], 'countries' => []])
 <div class='col-md-6'>
           <div class='card'>
                <div class='card-title bg-info text-light'>
                    <h2 class='mx-2'>Províncias</h2>
                </div>

                <div class='card-body'>
                    <div class='d-flex align-items-center gap-1'>
                        <button data-bs-toggle='modal' data-bs-target='#province' class='btn btn-primary'>Adicionar<button>
                        <input class='form-control' placeholder='Pesquisar ...' type='text' wire:model.live='provinceSearcher' />
                    </div>

                    <div class='table-responsive'>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                  <th>Data</th>
                                  <th>Província</th>
                                  <th>País</th>
                                 <th>Fundação</th>
                                 <th>Status</th>
                                 <th>Opções</th>
                                </tr>
                            </thead>

                              <tbody>
                                <tbody>
                                    @if ($provinces)
                                    @foreach ($provinces as $province)
                                    
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($province['created_at'])->format('Y-m-d') }}</td>                                        
                                        <td>{{ $province['name'] }}</td>                                        
                                        <td>{{ $province['country']['name'] }}</td>                                        
                                        <td>{{ $province['date_and_time_foundation'] }}</td>                                        
                                        <td>{{ $province['status'] }}</td>     
                                        <td>
                                            <div class='d-flex align-items-center'>
                                                <button
                                                 wire:click="editProvince({{ $province['id'] }})"
                                                 data-bs-toggle='modal' 
                                                 data-bs-target='#province' 
                                                 class='btn btn-sm btn-primary'>  Editar</button>
                                                <button
                                                wire:click="deleteProvince({{ $province['id'] }})"
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