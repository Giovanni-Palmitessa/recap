@extends('admin.layouts.base')

@section('contents') 

    <div class="container mt-5 text-center">
        <h1>{{ $post->titolo }}</h1>
        <h3>ID: {{ $post->id }}</h3>

        <p>{{ $post->descrizione }}</p>
    </div>

@endsection