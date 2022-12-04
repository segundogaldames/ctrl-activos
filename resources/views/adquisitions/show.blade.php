<x-page :module=$module :subject=$subject>
    <div class="row">
        <div class="col-md-5">
            <table class="table table-hover">
                <tr>
                    <th>Id:</th>
                    <td>{{ $adquisition->id }}</td>
                </tr>
                <tr>
                    <th>Proveedor:</th>
                    <td>{{ $adquisition->provider->name }}</td>
                </tr>
                <tr>
                    <th>Creado por:</th>
                    <td>{{ $adquisition->user->name }}</td>
                </tr>
                <tr>
                    <th>Fecha creación:</th>
                    <td>{{ $adquisition->created_at }}</td>
                </tr>
                <tr>
                    <th>Fecha actualización:</th>
                    <td>{{ $adquisition->updated_at }}</td>
                </tr>
            </table>
            <p>
                <x-buttonBack :back=$back></x-buttonBack>
                <a href="{{ route('details.addDetail', $adquisition) }}" class="btn btn-outline-success">Agregar Detalle</a>
            </p>
        </div>
        <div class="col-md-7">
            @if (isset($adquisition->details) && count($adquisition->details))
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adquisition->details as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>
                                    <a href="{{ route('details.show', $detail) }}">
                                        {{ $detail->product->name }}
                                    </a>
                                </td>
                                <td>{{ $detail->count }}</td>
                                <td>$ {{ number_format($detail->price,0,',','.') }}</td>
                                <td>
                                    @php
                                        $total = $detail->count * $detail->price;
                                    @endphp
                                    $ {{ number_format($total,0,',','.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-info">No hay detalles asociados</p>
            @endif
        </div>
    </div>
</x-page>
