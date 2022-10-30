<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($users) && count($users))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    @if ($user->active == 1)
                        <span class="badge text-bg-success">Activo</span>
                    @else
                        <span class="badge text-bg-danger">Inactivo</span>
                    @endif
                </td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <a href="{{ route('users.show', $user) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning">
                        <x-buttonEdit></x-buttonEdit>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <x-noticeModel :notice=$notice></x-noticeModel>
    @endif
</x-page>
