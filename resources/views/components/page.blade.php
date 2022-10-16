@extends('layouts.app')

@section('content')
<x-dashboard :module=$module></x-dashboard>
    <h2>
        {{ $subject }}
        @if (isset($new))
            <a href="{{ $route }}" class="btn btn-outline-dark">{{ $new }}</a>
        @endif
    </h2>
    @include('partials._messages')
    {{ $slot }}
@endsection
