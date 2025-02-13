<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use app\Http\Controllers\Auth;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        //A nossa pagina inicial
        $properties = Property::where('status', 'disponivel');
        //filtro de limite de img
        $properties = Property::with(['images' => function($query) {
            $query->limit(1);
        }])->get();
        $properties = Property::query();
        //Filtros
        if (request()->filled('search')) {
            $properties = $properties->where('title','LIKE','%'. $request-> search .'%')
                                    ->orWhere('address', 'LIKE', '%' . $request->description . '%')
                                    ->orWhere('description', 'LIKE', '%' . $request->search . '%');
    }

    if (request()->filled('type')) {
        $properties = $properties->where('type', $request->type);
                                
    }

    //Mais filtros aqui
    $properties = $properties->paginate(6);
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
        /*
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
        //$data['user_id'] = auth()->user()->id;
        //Uploade de imagem   
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/properties'), $imageName);
    
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image' => $imageName,
                ]);
            }
        }

        //$data = $request->all();
        $data = [
            'user_id'=> auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request-> price,
            'address' => $request->address,
            'type' => $request->type,
            'quartos' => $request->quartos,
            'banheiros' => $request->banheiros,
            'area' => $request->area,
        ];

       
        //dd($data);//
        Property::create($data);*/
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'type' => 'required|in:Aluguel,Venda',
            'quartos' => 'required|integer',
            'banheiros' => 'required|integer',
            'area' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $property = Property::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'address' => $request->address,
            'type' => $request->type,
            'quartos' => $request->quartos,
            'banheiros' => $request->banheiros,
            'area' => $request->area,
        ]);
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/properties'), $imageName);
    
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image' => $imageName,
                ]);
            }
        }
       
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
        // Garantir que o usuário autenticado é o dono do imóvel
        if ($property->user_id !== Auth::id()) {
            return redirect()->route('properties.index')->with('error', 'Você não tem permissão para editar este imóvel.');
        }

        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            return redirect()->route('properties.index')->with('error', 'Você não tem permissão para editar este imóvel.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'type' => 'required|in:Aluguel,Venda',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'address' => $request->address,
            'type' => $request->type,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'area' => $request->area,
        ]);
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/properties'), $imageName);
    
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image' => $imageName,
                ]);
            }
        }
        $property->save();

        return redirect()->route('properties.index')->with('success', 'Imóvel atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }

    public function destroyImage(Property $property, Image $image)
{
    // Verifique se a imagem pertence ao imóvel
    if ($image->property_id !== $property->id) {
        abort(403, 'Ação não autorizada');
    }

    // Exclua a imagem
    Storage::delete('public/images/properties/'.$image->image);
    $image->delete();

    return back()->with('success', 'Imagem excluída com sucesso');
}
}
