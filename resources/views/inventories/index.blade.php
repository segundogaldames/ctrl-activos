<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($inventories) && count($inventories))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Producto</th>
                <th>Código</th>
                <th>Fecha de Compra</th>
                <th>Status</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
            <tr>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->product->name }}</td>
                <td>{{ $inventory->code }}</td>
                <td>
                    <a href="{{ route('adquisitions.show',$inventory->adquisition->id) }}" title="Ver detalle factura">
                        {{ $inventory->adquisition->created_at }}
                    </a>
                </td>
                <td>{{ $inventory->status->name }}</td>
                <td>{{ $inventory->created_at }}</td>
                <td>
                    <a href="{{ route('inventories.show', $inventory) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-outline-warning">
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
