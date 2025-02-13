<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Listagem de usuario
        $user = User::all();
        return view('admin.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
}