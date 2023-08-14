@extends('admin.layouts.base')

@section('contents')

    <h1>{{$tag->nome}}</h1>
    <p>{{$tag->descrizione}}</p>

    <h2>Posts with this tag:</h2>
    <ul>
        @foreach ($tag->posts as $post)
            <li><a href="{{ route('admin.posts.show', ['post' => $post]) }}">{{ $post->titolo }}</a></li>
        @endforeach
    </ul>
    
@endsection