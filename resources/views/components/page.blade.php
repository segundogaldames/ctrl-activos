@extends('layouts.app')

@section('content')
<x-dashboard :module=$module></x-dashboard>
    <h2>{{ $subject }}</h2>
    {{ $slot }}
@endsection
