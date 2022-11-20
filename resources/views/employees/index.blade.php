<x-page :module=$module :subject=$subject :route=$route :new=$new>
    @if (isset($employees) && count($employees))
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>RUT</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->rut }}</td>
                <td>{{ $employee->position->name }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-outline-success">
                        <x-buttonView></x-buttonView>
                    </a>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-outline-warning">
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
