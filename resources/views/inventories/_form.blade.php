<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb3">
        <label class="form-label">Producto: {{ $product->name }} - {{ $product->model }}</label>
    </div>
    <div class="mb-3">
        <label for="code" class="form-label">Código <span class="text-danger">*</span> </label>
        <input type="text" name="code" value="{{ old('code', $inventory->code) }}" class="form-control" id="code"
            aria-describedby="emailHelp">
        @if($errors->has('code')) <p class="alert alert-danger mt-2">{{ $errors->first('code') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="adquisition" class="form-label">Factura Compra <span class="text-danger">*</span> </label>
        <select name="adquisition" id="adquisition" class="form-control">
            <option value="">Seleccione...</option>
            @foreach ($adquisitions as $adquisition)
                <option value="{{ $adquisition->id }}">
                    {{ $adquisition->factura }}
                </option>
            @endforeach
        </select>
        @if($errors->has('adquisition')) <p class="alert alert-danger mt-2">{{ $errors->first('adquisition') }}</p>@endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
