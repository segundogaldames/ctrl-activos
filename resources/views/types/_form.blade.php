<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Tipo <span class="text-danger">*</span> </label>
        <input type="text" name="name" value="{{ old('name', $type->name) }}" class="form-control" id="name"
            aria-describedby="emailHelp">
        @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
