@extends('admin.layouts.base')

@section('contents')
    <h1>Edit Technology</h1>
    
    <form method="POST" action="{{ route('admin.technologies.update', ['technology' => $technology]) }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control @error('nome') is-invalid @enderror"
                id="nome"
                name="nome"
                value="{{ old('nome', $technology->nome) }}"
            >
            @error('nome')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Salva</button>
    </form>
@endsection