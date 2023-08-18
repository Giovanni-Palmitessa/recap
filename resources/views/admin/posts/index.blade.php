@extends('admin.layouts.base')

@section('contents')

    <h1>Post</h1>

    {{-- @if (session('delete_success'))
        @php $portfolio = session('delete_success') @endphp
        <div class="alert alert-danger">
            Il portfolio "{{ $portfolio->name }}" è stato eliminato per sempre :(
        </div>
    @endif --}}

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Tag</th>                
                <th scope="col">Tecnologia</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->titolo }}</td>
                    <td><a href="{{ route('admin.tags.show', ['tag' => $post->tag]) }}">{{ $post->tag->nome }}</a></td>
                    <td>
                        @foreach ($post->technologies as $technology)
                            <a href="{{ route('admin.technologies.show', ['technology' => $technology]) }}">{{ $technology->nome }}</a>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.posts.show', ['post' => $post]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post]) }}">Edit</a>

                        <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $post->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action=""
                        data-template="{{ route('admin.posts.destroy', ['post' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                        {{-- data-id="{{$post->slug}}" --}}
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- {{ $portfolios->links() }} --}}

@endsection