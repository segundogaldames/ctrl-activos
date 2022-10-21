<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($roles) && count($roles))
        <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-success">
                                <x-buttonView></x-buttonView>
                            </a>
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-outline-warning">
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
