<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $inventory->id }}</td>
            </tr>
            <tr>
                <th>Código:</th>
                <td>{{ $inventory->code }}</td>
            </tr>
            <tr>
                <th>Producto:</th>
                <td>{{ $inventory->product->name }} - {{ $inventory->product->model }}</td>
            </tr>
            <tr>
                <th>Factura:</th>
                <td>{{ $inventory->adquisition->factura }}</td>
            </tr>
            <tr>
                <th>Fecha compra:</th>
                <td>{{ $inventory->adquisition->created_at }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>{{ $inventory->status->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $inventory->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $inventory->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
