<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb3">
        <label class="form-label">Producto:
            @if ($button == 'Guardar')
                {{ $product->name }} - {{ $product->model }}
            @else
                {{ $inventory->product->name }} - {{ $inventory->product->model }}
            @endif
        </label>
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
            @if ($button == 'Editar')
                <option value="{{ $inventory->adquisition_id }}">{{ $inventory->adquisition->factura }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($adquisitions as $adquisition)
                <option value="{{ $adquisition->id }}">
                    {{ $adquisition->factura }}
                </option>
            @endforeach
        </select>
        @if($errors->has('adquisition')) <p class="alert alert-danger mt-2">{{ $errors->first('adquisition') }}</p>@endif
    </div>

    @if ($button == 'Editar')
        <div class="mb-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span> </label>
            <select name="status" id="status" class="form-control">
                <option value="{{ $inventory->status_id }}">{{ $inventory->status->name }}</option>
                <option value="">Seleccione...</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('status')) <p class="alert alert-danger mt-2">{{ $errors->first('status') }}</p>@endif
        </div>
    @endif

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
