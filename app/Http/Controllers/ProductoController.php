<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Menu;
use App\Models\Submenu;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        $menus = Menu::Where('baja', true)->get();
        $submenus = Submenu::Where('baja', true)->get();
        return view('productos.create', compact('menus', 'submenus'));
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'id_menu' => 'required',
            'id_submenu' => 'required',
            'producto' => 'required',
            'precio' => 'required',
            'peso_compra' => 'required',
            'peso_venta' => 'required',
            'baja' => 'required|boolean',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success','Producto creado correctamente');
    }

    // Mostrar un producto específico
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    // Mostrar el formulario para editar un producto
    public function edit(Producto $producto)
    {
        $menus = Menu::Where('baja', true)->get();
        $submenus = Submenu::Where('baja', true)->get();
        return view('productos.edit', compact('producto', 'menus', 'submenus'));
    }

    // Actualizar un producto
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'id_menu' => 'required',
            'id_submenu' => 'required',
            'producto' => 'required',
            'precio' => 'required',
            'peso_compra' => 'required',
            'peso_venta' => 'required',
            'baja' => 'required|boolean',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success','Producto actualizado correctamente');
    }

    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        //$producto->delete();
        if ($producto->baja == 1) {
            $producto->update(['baja' => 0]);
        } else {
            $producto->update(['baja' => 1]);
        }
        return redirect()->route('productos.index')->with('success','Producto eliminado correctamente');
    }
}
