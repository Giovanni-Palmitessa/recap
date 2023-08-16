@extends('admin.layouts.base')

@section('contents')

    <h1>{{$technology->nome}}</h1>

    <h2>Posts with this technology:</h2>
    <ul>
        @foreach ($technology->posts as $post)
            <li><a href="{{ route('admin.posts.show', ['post' => $post]) }}">{{ $post->nome }}</a></li>
        @endforeach
    </ul>
    
@endsection