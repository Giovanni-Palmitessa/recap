@extends('admin.layouts.base')

@section('contents')
    <h1>Edit Tag</h1>
    
    <form method="POST" action="{{ route('admin.tags.update', ['tag' => $tag]) }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control @error('nome') is-invalid @enderror"
                id="nome"
                name="nome"
                value="{{ old('nome', $tag->nome) }}"
            >
            @error('nome')
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
                name="descrizione">{{ old('descrizione', $tag->descrizione) }}</textarea>
            @error('descrizione')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Salva</button>
    </form>
@endsection