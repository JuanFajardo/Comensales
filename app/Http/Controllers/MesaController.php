<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;

class MesaController extends Controller
{
    // Mostrar todos las mesas
    public function index(){
        $mesas = Mesa::all();
        return view('mesas.index', compact('mesas'));
    }

    // Mostrar el formulario para crear una nueva mesa
    public function create(){
        return view('mesas.create');
    }

    public function show($id){
        $mesas = Mesa::Where('id', '!=', $id)->get();
        $mesa = Mesa::find($id);
        return view('mesas.show', compact('mesas', 'mesa'));
    }

    // Guardar una nueva mesa
    public function store(Request $request)
    {
        $request['baja']= 1;
        $request['id_mesero']= 0;
        $request['mesero']= "0";
        $request['id_cliente']= 0;
        $request['cliente']= "0";
        $request['cantidad_comensales']= "0";
        $request['ocupado']= "0";

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
        $request['id_mesero']= 0;
        $request['mesero']= "0";
        $request['id_cliente']= 0;
        $request['cliente']= "0";
        $request['cantidad_comensales']= "0";
        $request['ocupado']= "0";

        $request->validate([
            'mesa' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);
        $mesa->update($request->all());
        return redirect()->route('mesas.index')->with('success', 'Mesa actualizada correctamente');
    }

    public function destroy(Mesa $mesa){
        if ($mesa->baja == 1) {
            $mesa->update(['baja' => 0]);
        } else {
            $mesa->update(['baja' => 1]);
        }
        return redirect()->route('mesas.index')->with('success', 'Estado de la Mesa actualizado correctamente');
    }
}