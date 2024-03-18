<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'tipo' => 'required',
            'baja' => 'required',
        ]);

        //return $request->all();
        
        $request['password'] = Hash::make($request->password) ;
        $request['id_mesa'] = 0;
        $request['id_cliente'] = 0;
        
        User::create($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',// . $user->id,
            'celular' => 'required',
            'direccion' => 'required',
            'id_mesa' => 'required',
            'id_cliente' => 'required',
            'tipo' => 'required',
            'baja' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user, Request $request)
    {
        //$producto->delete();
        //return $request->all();
        $user = User::find($request->id);
        if ($request->baja == 1) {
            $user->update(['baja' => 0]);
        } else {
            $user->update(['baja' => 1]);
        }
        return redirect()->route('usuarios.index')
            ->with('success', 'Actualizacion del estado del usuario');
    }
    
}