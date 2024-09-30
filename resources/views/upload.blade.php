@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Búsqueda de Documentos</h1>
        
        <!-- Formulario de búsqueda -->
        <form action="{{ route('process.files') }}" method="POST">
            @csrf
            <input type="text" name="search" placeholder="Buscar documento..." required>
            <button type="submit">Buscar</button>
        </form>
</div>
@endsection