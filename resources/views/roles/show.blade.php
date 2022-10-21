<x-page :module=$module :subject=$subject>
    <table class="table table-hover">
        <tr>
            <th>Id:</th>
            <td>{{ $role->id }}</td>
        </tr>
        <tr>
            <th>Nombre:</th>
            <td>{{ $role->name }}</td>
        </tr>
        <tr>
            <th>Fecha creación:</th>
            <td>{{ $role->created_at }}</td>
        </tr>
        <tr>
            <th>Fecha actualización:</th>
            <td>{{ $role->updated_at }}</td>
        </tr>
    </table>
    <p>
        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">Volver</a>
    </p>
</x-page>
