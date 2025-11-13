@section('title' , 'Home | Bem-vindo')
<div class=''>
    <x-modal-countries :countryStatus="$countryStatus ?? false" />
    <x-modal-provinces :countries="$countries ?? []" :provinceStatus="$provinceStatus ?? false" />
    
    <div class='m-4 text-center'>
        <h5>Encontre Países e Províncias num só lugar!</h5>
    </div>

    <div class=' col-md-12  d-flex align-items-start justify-content-center gap-1'>     
        <x-table-countries :countries="$countries ?? []" />
        <x-table-provinces :provinces="$provinces ?? []" :countries="$countries ?? []" />
    </div>
</div>

@push("scripts")
    <script>
        $('#closeCountryModal').click(() =>  {
            $("#country").modal('hide');       
        });

        $('#closeProvinceModal').click(() =>  {
            $("#province").modal('hide');       
        });
    </script>
@endpush