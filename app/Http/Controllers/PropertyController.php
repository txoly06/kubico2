<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //A nossa pagina inicial
        $properties = Property::where('status', 'disponivel');

        //Filtros
        if (request()->filled('search')) {
            $properties = $properties->where('title','LIKE','%'. $request-> search .'%')
                                     ->orWhere('address','LIKE','%'. $request->description .$request->search .'%');
    }

    if (request()->filled('type')) {
        $properties = $properties->where('type', $request->type .'%');
    }

    //Mais filtros aqui
    $properties = $properties->paginate(10);
    return view('properties.index', compact('properties'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Cadastrar imoveis
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Dados

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'type' => 'required|in:Aluguel,Venda',
            'quartos' => 'required|integer',
            'banheiros' => 'required|integer',
            'area' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        //Uploade de imagem
        if( $request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = time() . '.'. $request->image->extension();
            $request->image->move(public_path('images/properties'), $imageName);
            $data['image'] = $imageName;
        }
        Property::create($data);
        dd($data['image']);
        return redirect('/')->with('success','Imovel Cadastrado com Sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //Mostar Propriedades

        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
