@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="my-4">Resultados de búsqueda para "<strong>{{ $searchTerm }}</strong>"</h1>

     <!-- Resultados de la búsqueda -->
     <div class="results">
            @if(!empty($matchingFiles))
                @foreach($matchingFiles as $file)
                    <div class="result-item">
                        <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ $file }}</a>
                    </div>
                @endforeach
            @else
                <p>No se encontraron documentos que coincidan con la búsqueda.</p>
            @endif
        </div>
    <a href="{{ route('upload.form') }}" class="btn btn-secondary mt-4">Volver a buscar</a>
</div>
@endsection
