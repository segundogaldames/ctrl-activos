<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($providers) && count($providers))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>RUT</th>
                <th>Negocio</th>
                <th>Comuna</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($providers as $provider)
            <tr>
                <td>{{ $provider->id }}</td>
                <td>{{ $provider->name }}</td>
                <td>{{ $provider->rut }}</td>
                <td>{{ $provider->business }}</td>
                <td>{{ $provider->city->name }}</td>
                <td>
                    <a href="{{ route('providers.show', $provider) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('providers.edit', $provider) }}" class="btn btn-outline-warning">
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
