<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Property;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Listagem dos favoritos
        $user = auth()->user();

        //Carrega imoveis favoritos
        $favorites = $user->favorites()->paginate(10);

        return view("favorites.index", compact("favorites"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Property $property)
    {
        //
        $user = auth()->user();

    // Verifica se já está favoritado
    if (!$user->favorites->contains($property->id)) {
        $user->favorites()->attach($property->id);
    }

    return back()->with('success', 'Imóvel adicionado aos favoritos!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favority)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favority)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
        $user = auth()->user();

    // Verifica se está favoritado antes de remover
    if ($user->favorites->contains($property->id)) {
        $user->favorites()->detach($property->id);
    }

    return back()->with('success', 'Imóvel removido dos favoritos!');
}
}
