<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $validations = [
        'titolo' => 'required|string|max:100|min:5',
        'descrizione' => 'required|string',
    ];

    private $validations_messages = [
        'required' => 'Il campo :attribute è richiesto',
        'min' => 'Il campo :attribute deve avere almeno :min caratteri',
        'max' => 'Il campo :attribute deve avere massimo :max caratteri',
        'exists' => 'Il campo :attribute non è valido',
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
        return view('admin.posts.create');
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

         // salvare i dati nel db se validi
         $newPost = new Post();
         $newPost->titolo = $data['titolo'];
         $newPost->descrizione = $data['descrizione'];
 
         $newPost->save();

         return to_route('admin.posts.show', ['post' => $newPost]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::where('id', $id)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validare i dati del form
        $request->validate(
            [
                'titolo'        => 'required|string|max:100',
                'descrizione'   => 'required|string',
            ],
            // custom error message
            // [
            //     'title.required'    => 'Title required!',
            //     'title.min'         => 'Title needs minimum 5 letter!',
            // ]
        );

        $data = $request->all();

        // aggiornare i dati nel db se validi
        $post->titolo        = $data['titolo'];
        $post->descrizione      = $data['descrizione'];
        $post->update();

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
        $post->delete();
        return to_route('admin.posts.index')->with('delete_success', $post);
    }
}
