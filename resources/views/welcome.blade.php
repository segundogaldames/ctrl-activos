<x-page module='Dashboard' subject='Información importante'>
    <h4>Productos en Stock</h4>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->product }}</td>
                            <td>{{ $inventory->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h4>Otra Información</h4>
        </div>
    </div>

</x-page>
