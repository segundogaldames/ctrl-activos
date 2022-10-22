@extends('layouts.app')
<x-title>{{ $module }}</x-title>
@section('content')
<x-dashboard :module=$module></x-dashboard>
<div class="card">
    <div class="card-header">
        <h2>
            {{ $subject }}
            @if (isset($new))
                <a href="{{ $route }}" class="btn btn-outline-dark">{{ $new }}</a>
            @endif
    </h2>
    </div>
    <div class="card-body">
        @include('partials._messages')
        {{ $slot }}

    </div>
</div>
@endsection
