@php
    $module='otro sitio';
    $subject='pagina principal';
@endphp
<x-page :module=$module :subject=$subject>
    <h1>Hola Desde Dashboard</h1>
</x-page>
