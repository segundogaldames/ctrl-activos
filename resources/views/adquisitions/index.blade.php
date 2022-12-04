<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($adquisitions) && count($adquisitions))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Factura</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Registrado Por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adquisitions as $adquisition)
            <tr>
                <td>{{ $adquisition->id }}</td>
                <td>{{ $adquisition->factura }}</td>
                <td>{{ $adquisition->created_at }}</td>
                <td>{{ $adquisition->provider->name }}</td>
                <td>{{ $adquisition->user->name }}</td>
                <td>
                    <a href="{{ route('adquisitions.show', $adquisition) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('adquisitions.edit', $adquisition) }}" class="btn btn-outline-warning">
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
