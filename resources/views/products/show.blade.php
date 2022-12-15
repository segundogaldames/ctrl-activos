<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>Código:</th>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <th>Modelo:</th>
                <td>{{ $product->model }}</td>
            </tr>
            <tr>
                <th>Marca:</th>
                <td>{{ $product->trademark->name }}</td>
            </tr>
            <tr>
                <th>Tipo:</th>
                <td>{{ $product->type->name }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>{{ $product->status->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $product->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $product->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
            <a href="{{ route('inventories.addInventory', $product) }}" class="btn btn-outline-success">Agregar Inventario</a>
        </p>
    </div>
</x-page>
