<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $provider->id }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $provider->name }}</td>
            </tr>
            <tr>
                <th>RUT:</th>
                <td>{{ $provider->rut }}</td>
            </tr>
            <tr>
                <th>Dirección:</th>
                <td>{{ $provider->address }}</td>
            </tr>
            <tr>
                <th>Comuna:</th>
                <td>{{ $provider->city->name }}</td>
            </tr>
            <tr>
                <th>Giro:</th>
                <td>{{ $provider->business }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $provider->email }}</td>
            </tr>
            <tr>
                <th>Sitio web:</th>
                <td>{{ $provider->website }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $provider->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $provider->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
