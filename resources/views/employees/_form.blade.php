<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Nombre <span class="text-danger">*</span> </label>
        <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="form-control" id="name"
            aria-describedby="emailHelp">
        @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="rut" class="form-label">RUT <span class="text-danger">*</span> </label>
        <input type="text" name="rut" value="{{ old('rut', $employee->rut) }}" class="form-control" id="rut"
            aria-describedby="emailHelp">
        @if($errors->has('rut')) <p class="alert alert-danger mt-2">{{ $errors->first('rut') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Teléfono <span class="text-danger">*</span> </label>
        <input type="number" name="phone" value="{{ old('phone', $employee->phone) }}" class="form-control" id="name"
            aria-describedby="emailHelp">
        @if($errors->has('phone')) <p class="alert alert-danger mt-2">{{ $errors->first('phone') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="position" class="form-label">Cargo <span class="text-danger">*</span> </label>
        <select name="position" id="position" class="form-control">
            @if ($button == 'Editar')
                <option value="{{ $employee->position_id }}">{{ $employee->position->name }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($positions as $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
            @endforeach
        </select>
        @if($errors->has('position')) <p class="alert alert-danger mt-2">{{ $errors->first('position') }}</p>@endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
