<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($positions) && count($positions))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($positions as $position)
            <tr>
                <td>{{ $position->id }}</td>
                <td>{{ $position->name }}</td>
                <td>
                    <a href="{{ route('positions.show', $position) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('positions.edit', $position) }}" class="btn btn-outline-warning">
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
