<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class AdminPropertyController extends Controller
{
    //
    public function index()
    {
        $properties = Property::paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'type' => 'required|in:Aluguer,Venda',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area' => 'required|numeric',
        ]);

        Property::create($request->all());

        return redirect()->route('admin.properties.index')->with('success', 'Imóvel criado com sucesso!');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'type' => 'required|in:Aluguer,Venda',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area' => 'required|numeric',
        ]);

        $property->update($request->all());

        return redirect()->route('admin.properties.index')->with('success', 'Imóvel atualizado com sucesso!');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Imóvel excluído com sucesso!');
    }
}
