<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\UserProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Para o painel do usuario
        $properties = Property::where('user_id', Auth::id())->get();
        return view('user.properties.index', compact('properties'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Properly $properly)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        // Verificar se o usuário autenticado é o dono do imóvel
        if ($property->user_id !== Auth::id()) {
            return redirect()->route('user.properties.index')->with('error', 'Você não tem permissão para editar este imóvel.');
        }

        return view('user.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // Verificar se o usuário autenticado é o dono do imóvel
        if ($property->user_id !== Auth::id()) {
            return redirect()->route('user.properties.index')->with('error', 'Você não tem permissão para editar este imóvel.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:Indisponivel,Disponivel',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $property->title = $request->title;
        $property->description = $request->description;
        $property->price = $request->price;
        $property->status = $request->status;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/properties'), $imageName);
            $property->image = $imageName;
        }

        $property->save();

        return redirect()->route('user.properties.index')->with('success', 'Imóvel atualizado com sucesso!');
    }
    
     public function favorites()
    {
        // Definindo a variável $featuredProperties
        $featuredProperties = Property::where('featured', true)->get();

        // Obter os imóveis favoritos do usuário
        $favorites = auth()->user()->favorites;

        return view('user.favorites', compact('featuredProperties', 'favorites'));
    }

    public function myProperties()
    {
        // Definindo a variável $featuredProperties
        $featuredProperties = Property::where('featured', true)->get();

        // Obter os imóveis do usuário
        $myProperties = auth()->user()->properties;

        return view('user.properties.index', compact('featuredProperties', 'myProperties'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sfcr $sfcr)
    {
        //
    }
}
