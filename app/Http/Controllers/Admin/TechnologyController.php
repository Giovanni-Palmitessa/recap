<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    private $validations = [
        'nome'        => 'required|string|max:20|min:1',
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
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        return view('admin.technologies.create', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        // salvare i dati nel db se validi
        $newTechnology = new Technology();
        $newTechnology->nome = $data['nome'];

        $newTechnology->save();

        // reindirizzare su una rotta di tipo get

        return to_route('admin.technologies.show', ['technology' => $newTechnology]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        // aggiornare i dati nel db se validi
        $technology->titolo       = $data['titolo'];
        $technology->descrizione  = $data['descrizione'];
        $technology->update();

        // ridirezionare su una rotta di tipo get
        return to_route('admin.technologies.show', ['technology' => $technology]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('delete_success', $technology);
    }
}
