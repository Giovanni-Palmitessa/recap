@extends('admin.layouts.base')

@section('contents') 

        <div class="edit container">

        <h1 class="mb-3">Edit the Post</h1>
    
        <form 
            class="create-form"
            method="POST"
            action="{{ route('admin.posts.update', ['post' => $post]) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('put')

            <div class="input-group mb-3">
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="titolo" class="form-label">titolo</label>
                <input 
                    type="text" 
                    class="form-control 
                    @error('titolo') is-invalid @enderror" 
                    id="titolo" 
                    name="titolo" 
                    value="{{ old('titolo', $post->titolo) }}"
                >
                @error('titolo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="descrizione" class="form-label">descrizione</label>
                <textarea 
                    class="form-control 
                    @error('descrizione') is-invalid @enderror" 
                    id="descrizione" 
                    rows="3" 
                    name="descrizione"
                >{{ old('descrizione', $post->descrizione) }}</textarea>
                @error('descrizione')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                @enderror
            </div>       


            <div class="mb-3">
                <label
                for="tag_id"
                class="form-label
                @error('tag_id') is-invalid @enderror">Tag</label>
                <select
                    class="form-select" 
                    aria-label="Default select" 
                    id="tag_id" name="tag_id"
                    value="{{ old('tag_id') }}"
                >
                    @foreach($tags as $tag)
                        <option
                            value="{{ $tag->id }}"
                            @if (old('tag_id', $post->tag->id) == $tag->id) selected @endif
                        >
                            {{ $tag->nome }}
                        </option>
                    @endforeach
                </select>
                @error('tag_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                @enderror
            </div>   
            
            <div class="mb-3">
                <h3>Tecnologia</h3>
    
                @foreach ($technologies as $technology)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" name="technologies[]"  @if (in_array($technology->id, old('technologies', $post->technologies->pluck('id')->all())))
                        checked  
                    @endif >
                    <label class="form-check-label" for="flexCheckDefault">
                      {{$technology->nome}}
                    </label>
                </div>
                @endforeach
            </div>

            <div class="create-button">
                <a class="btn btn-secondary" href="/admin/posts">Back</a>
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>

    </div>

@endsection