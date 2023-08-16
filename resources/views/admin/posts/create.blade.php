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
            <label for="tag" class="form-label">Tag</label>

            <select class="form-select @error('tag_id') is-invalid @enderror" aria-label="Default select example" id="tag" name="tag_id">
                <option selected value="0">Seleziona una categoria</option>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->nome}}</option>
                @endforeach
            </select>
            @error('tag_id')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <h3>Technologia</h3>

            @foreach ($technologies as $technology)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" name="technologies[]"  @if (in_array($technology->id, old('technologies', [])))
                    checked  
                @endif >
                <label class="form-check-label" for="flexCheckDefault">
                  {{$technology->nome}}
                </label>
            </div>
            @endforeach
            
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