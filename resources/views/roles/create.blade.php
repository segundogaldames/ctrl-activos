<x-page :module=$module :subject=$subject>
    <p class="text-danger">Campos obligatorios *</p>
    <form action="{{ route('roles.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Rol <span class="text-danger">*</span> </label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="role"
                aria-describedby="emailHelp">
            @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('roles.index') }}" class="btn btn-link">Volver</a>
    </form>
</x-page>
