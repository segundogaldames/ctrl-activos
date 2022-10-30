<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Activo:</th>
                <td>
                    @if ($user->active == 1)
                        Si
                    @else
                        No
                    @endif
                </td>
            </tr>
            <tr>
                <th>Rol:</th>
                <td>{{ $user->role->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $user->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $user->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
