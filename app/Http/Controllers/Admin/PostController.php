<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $validations = [
        'titolo'        => 'required|string|max:100|min:5',
        'descrizione'   => 'required|string',
    ];

    private $validations_messages = [
        'required'  => 'Il campo :attribute è richiesto',
        'min'       => 'Il campo :attribute deve avere almeno :min caratteri',
        'max'       => 'Il campo :attribute deve avere massimo :max caratteri',
        'exists'    => 'Il campo :attribute non è valido',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $technologies = Technology::all();
        return view('admin.posts.create', compact('tags', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        $imagePath = Storage::put('uploads', $data['image']);

        // salvare i dati nel db se validi
        $newPost = new Post();
        $newPost->titolo        = $data['titolo'];
        $newPost->slug          = Post::slugger($data['titolo']);
        $newPost->image         = $imagePath;
        $newPost->tag_id        = $data['tag_id'];
        $newPost->descrizione   = $data['descrizione'];

        $newPost->save();

        // associare i tag
        $newPost->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.posts.show', ['post' => $newPost]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        // $post = Post::where('id', $id)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $tags = Tag::all();
        $technologies = Technology::all();
        return view('admin.posts.edit', compact('post', 'tags', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        // immagine caricata dall'utente
        if (isset($data['image'])) {

            $imagePath = Storage::put('uploads', $data['image']);

            if ($post->image) {
                Storage::delete($post->image);
            }

            $post->image = $imagePath;
        }


        // aggiornare i dati nel db se validi
        $post->tag_id       = $data['tag_id'];
        $post->titolo       = $data['titolo'];
        $post->descrizione  = $data['descrizione'];
        $post->update();

        // associare i tag
        $post->technologies()->sync($data['technologies'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $post = Post::where('slug', $slug)->firstOrFail();
        //dissociare tutti le technology dal post
        $post->technologies()->detach();

        // elimino il post
        $post->delete();
        return to_route('admin.posts.index')->with('delete_success', $post);
    }
}
