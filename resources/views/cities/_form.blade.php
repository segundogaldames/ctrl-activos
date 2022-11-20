<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Comuna <span class="text-danger">*</span> </label>
        <input type="text" name="name" value="{{ old('name', $city->name) }}" class="form-control" id="name"
            aria-describedby="emailHelp">
        @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
    </div>

    <div class="mb-3">
        <label for="area" class="form-label">Región <span class="text-danger">*</span> </label>
        <select name="area" id="area" class="form-control">
            @if ($button == 'Editar')
                <option value="{{ $city->area_id }}">{{ $city->area->name }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>
        @if($errors->has('area')) <p class="alert alert-danger mt-2">{{ $errors->first('area') }}</p>@endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
