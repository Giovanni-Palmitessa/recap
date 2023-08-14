@extends('admin.layouts.base')

@section('contents')
    <h1>Add new Post</h1>
    
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="titolo" class="form-label">Titolo</label>
            <input
                type="text"
                class="form-control @error('titolo') is-invalid @enderror"
                id="titolo"
                name="titolo"
                value="{{ old('titolo') }}"
            >
            @error('titolo')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descrizione" class="form-label">Descrizione</label>
            <textarea
                class="form-control @error('descrizione') is-invalid @enderror"
                id="descrizione"
                rows="3"
                name="descrizione">{{ old('descrizione') }}</textarea>
            @error('descrizione')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Salva</button>
    </form>
@endsection