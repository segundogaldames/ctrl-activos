<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb-3">
        <label for="count" class="form-label">Cantidad <span class="text-danger">*</span> </label>
        <input type="number" name="count" value="{{ old('count', $detail->count) }}" class="form-control" id="count"
            aria-describedby="emailHelp">
        @if($errors->has('count')) <p class="alert alert-danger mt-2">{{ $errors->first('count') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Precio (pesos) <span class="text-danger">*</span> </label>
        <input type="number" name="price" value="{{ old('price', $detail->price) }}" class="form-control" id="price"
            aria-describedby="emailHelp">
        @if($errors->has('price')) <p class="alert alert-danger mt-2">{{ $errors->first('price') }}</p>@endif
    </div>

    <div class="mb-3">
        <label for="product" class="form-label">Producto <span class="text-danger">*</span> </label>
        <select name="product" id="product" class="form-control">
            <option value="">Seleccione...</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} -
                    {{ $product->model }} -
                    {{ $product->trademark->name }}
                </option>
            @endforeach
        </select>
        @if($errors->has('product')) <p class="alert alert-danger mt-2">{{ $errors->first('product') }}</p>@endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
