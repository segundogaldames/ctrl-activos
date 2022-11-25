<x-fieldRequired></x-fieldRequired>
<form action="{{ $process }}" method="post">
    @csrf
    @if ($button == 'Editar')
        @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Nombre <span class="text-danger">*</span> </label>
        <input type="text" name="name" value="{{ old('name', $provider->name) }}" class="form-control" id="name"
            aria-describedby="emailHelp">
        @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="rut" class="form-label">RUT <span class="text-danger">*</span> </label>
        <input type="text" name="rut" value="{{ old('rut', $provider->rut) }}" class="form-control" id="rut"
            aria-describedby="emailHelp">
        @if($errors->has('rut')) <p class="alert alert-danger mt-2">{{ $errors->first('rut') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="business" class="form-label">Giro <span class="text-danger">*</span> </label>
        <input type="text" name="business" value="{{ old('business', $provider->business) }}" class="form-control" id="rut"
            aria-describedby="emailHelp">
        @if($errors->has('rut')) <p class="alert alert-danger mt-2">{{ $errors->first('rut') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span> </label>
        <input type="email" name="email" value="{{ old('email', $provider->email) }}" class="form-control" id="email"
            aria-describedby="emailHelp">
        @if($errors->has('email')) <p class="alert alert-danger mt-2">{{ $errors->first('email') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="website" class="form-label">Sitio web (opcional) </label>
        <input type="url" name="website" value="{{ old('website', $provider->website) }}" class="form-control" id="website"
            aria-describedby="emailHelp">
        @if($errors->has('website')) <p class="alert alert-danger mt-2">{{ $errors->first('website') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Dirección <span class="text-danger">*</span> </label>
        <textarea name="address" id="address" class="form-control" rows="4" style="resize: none">
                {{ old('address', $provider->address) }}
            </textarea>
        @if($errors->has('name')) <p class="alert alert-danger mt-2">{{ $errors->first('name') }}</p>@endif
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">Comuna <span class="text-danger">*</span> </label>
        <select name="city" id="city" class="form-control">
            @if ($button == 'Editar')
                <option value="{{ $provider->city_id }}">{{ $provider->city->name }}</option>
            @endif
            <option value="">Seleccione...</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        @if($errors->has('city')) <p class="alert alert-danger mt-2">{{ $errors->first('city') }}</p>@endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <x-buttonBack :back=$back></x-buttonBack>
</form>
