<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($products) && count($products))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->model }}</td>
                <td>{{ $product->trademark->name }}</td>
                <td>{{ $product->type->name }}</td>
                <td>{{ $product->status->name }}</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning">
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
