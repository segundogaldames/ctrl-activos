<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb-3">
        <label for="factura" class="form-label">Factura N° <span class="text-danger">*</span> </label>
        <input type="text" name="factura" value="{{ old('factura', $adquisition->factura) }}" class="form-control" id="factura"
            aria-describedby="emailHelp">
        @if($errors->has('factura')) <p class="alert alert-danger mt-2">{{ $errors->first('factura') }}</p>@endif
    </div>
    @if ($button == 'Guardar')
        <div class="mb-3">
            <label for="provider" class="form-label">Proveedor <span class="text-danger">*</span> </label>
            <select name="provider" id="provider" class="form-control">
                <option value="">Seleccione...</option>
                @foreach ($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
            @if($errors->has('provider')) <p class="alert alert-danger mt-2">{{ $errors->first('provider') }}</p>@endif
        </div>
    @endif

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
