<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $city->id }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $city->name }}</td>
            </tr>
            <tr>
                <th>Región:</th>
                <td>{{ $city->area->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $city->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $city->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
