<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($statuses) && count($statuses))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>
                    <a href="{{ route('statuses.show', $status) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('statuses.edit', $status) }}" class="btn btn-outline-warning">
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
