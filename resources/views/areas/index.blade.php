<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($areas) && count($areas))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areas as $area)
            <tr>
                <td>{{ $area->id }}</td>
                <td>{{ $area->name }}</td>
                <td>
                    <a href="{{ route('areas.show', $area) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('areas.edit', $area) }}" class="btn btn-outline-warning">
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
