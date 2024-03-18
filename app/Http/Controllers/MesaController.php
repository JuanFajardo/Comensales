<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;

class MesaController extends Controller
{
    // Mostrar todos las mesas
    public function index()
    {
        $mesas = Mesa::all();
        return view('mesas.index', compact('mesas'));
    }

    // Mostrar el formulario para crear una nueva mesa
    public function create()
    {
        return view('mesas.create');
    }

    // Guardar una nueva mesa
    public function store(Request $request)
    {
        $request['baja']= 1;
        $request->validate([
            'mesa' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        Mesa::create($request->all());
        
        return redirect()->route('mesas.index')->with('success', 'Mesa creada correctamente');
    }

    // Mostrar el formulario para editar una mesa
    public function edit(Mesa $mesa)
    {
        return view('mesas.edit', compact('mesa'));
    }

    // Actualizar una mesa
    public function update(Request $request, Mesa $mesa)
    {
        $request->validate([
            'mesa' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        $mesa->update($request->all());
        
        return redirect()->route('mesas.index')->with('success', 'Mesa actualizada correctamente');
    }

    // Eliminar una mesa
    public function destroy(Mesa $mesa)
    {
        //$producto->delete();
        if ($mesa->baja == 1) {
            $mesa->update(['baja' => 0]);
        } else {
            $mesa->update(['baja' => 1]);
        }
        return redirect()->route('mesas.index')->with('success', 'Mesa eliminada correctamente');
    }
}