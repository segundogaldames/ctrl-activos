<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $adquisition->id }}</td>
            </tr>
            <tr>
                <th>Proveedor:</th>
                <td>{{ $adquisition->provider->name }}</td>
            </tr>
            <tr>
                <th>Creado por:</th>
                <td>{{ $adquisition->user->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $adquisition->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $adquisition->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
            <a href="{{ route('details.addDetail', $adquisition) }}" class="btn btn-outline-success">Agregar Detalle</a>
        </p>
    </div>
</x-page>
