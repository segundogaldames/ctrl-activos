<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($trademarks) && count($trademarks))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trademarks as $trademark)
            <tr>
                <td>{{ $trademark->id }}</td>
                <td>{{ $trademark->name }}</td>
                <td>
                    <a href="{{ route('trademarks.show', $trademark) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('trademarks.edit', $trademark) }}" class="btn btn-outline-warning">
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
