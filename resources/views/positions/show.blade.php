<x-page :module=$module :subject=$subject>
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Id:</th>
                <td>{{ $position->id }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $position->name }}</td>
            </tr>
            <tr>
                <th>Fecha creación:</th>
                <td>{{ $position->created_at }}</td>
            </tr>
            <tr>
                <th>Fecha actualización:</th>
                <td>{{ $position->updated_at }}</td>
            </tr>
        </table>
        <p>
            <x-buttonBack :back=$back></x-buttonBack>
        </p>
    </div>
</x-page>
