<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Nombre <span class="text-danger">*</span> </label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" id="role"
            aria-describedby="emailHelp" placeholder="Nombre del producto">
        @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="code" class="form-label">Código <span class="text-danger">*</span> </label>
        <input type="text" name="code" value="{{ old('code', $product->code) }}" class="form-control" id="role"
            aria-describedby="emailHelp" placeholder="Código del producto">
        @if($errors->has('code')) <p class="alert alert-danger mt-2">{{ $errors->first('code') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="model" class="form-label">Modelo <span class="text-danger">*</span> </label>
        <input type="text" name="model" value="{{ old('model', $product->model) }}" class="form-control" id="role"
            aria-describedby="emailHelp" placeholder="Modelo del producto">
        @if($errors->has('model')) <p class="alert alert-danger mt-2">{{ $errors->first('model') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="trademark" class="form-label">Marca <span class="text-danger">*</span> </label>
        <select name="trademark" id="trademark" class="form-control">
            @if ($button == 'Editar')
                <option value="{{ $product->trademark_id }}">{{ $product->trademark->name }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($trademarks as $trademark)
                <option value="{{ $trademark->id }}">{{ $trademark->name }}</option>
            @endforeach
        </select>
        @if($errors->has('trademark')) <p class="alert alert-danger mt-2">{{ $errors->first('trademark') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipo <span class="text-danger">*</span> </label>
        <select name="type" id="type" class="form-control">
            @if ($button == 'Editar')
                <option value="{{ $product->type_id }}">{{ $product->type->name }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
        @if($errors->has('type')) <p class="alert alert-danger mt-2">{{ $errors->first('type') }}</p>@endif
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Estado <span class="text-danger">*</span> </label>
        <select name="status" id="status" class="form-control">
            @if ($button == 'Editar')
                <option value="{{ $product->status_id }}">{{ $product->status->name }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($statuses as $status)
            <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>
        @if($errors->has('status')) <p class="alert alert-danger mt-2">{{ $errors->first('status') }}</p>@endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
