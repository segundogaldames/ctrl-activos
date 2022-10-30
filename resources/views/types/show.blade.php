<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $type->id }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $type->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $type->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $type->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
