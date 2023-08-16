@extends('admin.layouts.base')

@section('contents')
    <h1>Add new Technology</h1>
    
    <form method="POST" action="{{ route('admin.technologies.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control @error('nome') is-invalid @enderror"
                id="nome"
                name="nome"
                value="{{ old('nome') }}"
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