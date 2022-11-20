<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $employee->id }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $employee->name }}</td>
            </tr>
            <tr>
                <th>RUT:</th>
                <td>{{ $employee->rut }}</td>
            </tr>
            <tr>
                <th>Teléfono:</th>
                <td>{{ $employee->phone }}</td>
            </tr>
            <tr>
                <th>Cargo:</th>
                <td>{{ $employee->position->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $employee->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $employee->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
