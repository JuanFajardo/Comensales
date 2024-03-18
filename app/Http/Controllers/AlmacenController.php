<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;
use App\Models\Producto;
use App\Models\Menu;
use App\Models\Submenu;

class AlmacenController extends Controller
{
    // Mostrar todos los elementos en el almacén
    public function index()
    {
        $almacenes = Almacen::all();
        return view('almacenes.index', compact('almacenes'));
    }

    // Mostrar el formulario para crear un nuevo elemento en el almacén
    public function create()
    {
        $productos = Producto::Where('baja', true)->get();
        $menus = Menu::Where('baja', true)->get();
        $submenus = Submenu::Where('baja', true)->get();
        return view('almacenes.create', compact('productos', 'menus', 'submenus'));
    }

    // Guardar un nuevo elemento en el almacén
    public function store(Request $request)
    {
        $request['cantidad_salida'] = 0;
        Almacen::create($request->all());
        
        return redirect()->route('almacenes.index')->with('success','Elemento del almacén creado correctamente');
    }

    public function show(Almacen $almacen)
    {
        return view('almacenes.show', compact('almacen'));
    }

    public function edit(Almacen $almacen)
    {
        return view('almacenes.edit', compact('almacen'));
    }

    public function update(Request $request, Almacen $almacen)
    {
        
        $almacen->update($request->all());
        return redirect()->route('almacenes.index')->with('success','Elemento del almacén actualizado correctamente');
    }

    public function destroy(Almacen $almacen)
    {
        if ($almacen->baja == 1) {
            $almacen->update(['baja' => 0]);
        } else {
            $almacen->update(['baja' => 1]);
        }
        return redirect()->route('almacenes.index')->with('success','Elemento del almacén eliminado correctamente');
    }
}