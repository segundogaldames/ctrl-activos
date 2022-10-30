<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
    @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Nombre <span class="text-danger">*</span> </label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" id="name"
            aria-describedby="emailHelp" placeholder="Nombre del usuario">
        @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span> </label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="email"
            aria-describedby="emailHelp" placeholder="Email del usuario">
        @if($errors->has('email')) <p class="alert alert-danger mt-2">{{ $errors->first('email') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Rol <span class="text-danger">*</span> </label>
        <select name="role" id="role" class="form-control">
            @if ($button == 'Editar')
            <option value="{{ $user->role_id }}">{{ $user->role->name }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach

        </select>
        @if($errors->has('role')) <p class="alert alert-danger mt-2">{{ $errors->first('role') }}</p>@endif
    </div>
    @if ($button == 'Editar')
    <div class="mb-3">
        <label for="active" class="form-label">Estado <span class="text-danger">*</span> </label>
        <select name="active" id="active" class="form-control">
            @if ($user->active == 1)
                <option value="{{ $user->active }}">Activo</option>
                <option value="2">Desactivar</option>
            @else
                <option value="{{ $user->active }}">Inactivo</option>
                <option value="1">Activar</option>
            @endif

        </select>
        @if($errors->has('active')) <p class="alert alert-danger mt-2">{{ $errors->first('active') }}</p>@endif
    </div>
    @endif
    @if ($button == 'Guardar')
    <div class="mb-3">
        <label for="password" class="form-label">Password <span class="text-danger">*</span> </label>
        <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp"
            placeholder="Password del usuario">
        @if($errors->has('password')) <p class="alert alert-danger mt-2">{{ $errors->first('password') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="password-confirm" class="form-label">Confirmar password <span class="text-danger">*</span> </label>
        <input type="password" name="password_confirmation" class="form-control" id="password-confirm"
            aria-describedby="emailHelp" placeholder="Confirmar password del usuario">
    </div>
    @endif

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
