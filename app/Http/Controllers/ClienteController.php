<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar el formulario para crear un nuevo cliente
    public function create()
    {
        return view('clientes.create');
    }
    
    // Guardar un nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string',
            'nit' => 'required|string',
            'tipo' => 'required|string',
            'extra' => 'nullable|string',
            'baja' => 'nullable|boolean',
        ]);

        Cliente::create($request->all());
        
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    // Mostrar el formulario para editar un cliente
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'cliente' => 'required|string',
            'nit' => 'required|string',
            'tipo' => 'required|string',
            'extra' => 'nullable|string',
            'baja' => 'nullable|boolean',
        ]);

        $cliente->update($request->all());
        
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    // Eliminar un cliente
    public function destroy(Cliente $cliente)
    {   
        if ($cliente->baja == 1) {
            $cliente->update(['baja' => 0]);
        } else {
            $cliente->update(['baja' => 1]);
        }
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}