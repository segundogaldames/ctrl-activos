<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $detail->id }}</td>
            </tr>
            <tr>
                <th>Producto:</th>
                <td>{{ $detail->product->name }}</td>
            </tr>
            <tr>
                <th>Cantidad:</th>
                <td>{{ number_format($detail->count) }}</td>
            </tr>
            <tr>
                <th>Precio:</th>
                <td>$ {{ number_format($detail->price,0,',','.') }}</td>
            </tr>
            <tr>
                <th>Total:</th>
                <td>
                    @php
                        $total = $detail->count * $detail->price;
                    @endphp
                    $ {{ number_format($total,0,',','.') }}
                </td>
            </tr>
            <tr>
                <th>Factura N°:</th>
                <td></td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $detail->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $detail->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
