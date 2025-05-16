<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submenu;
use App\Models\Menu;

class SubmenuController extends Controller
{
    public function index()
    {
        $submenus = Submenu::OrderBy('submenu')->get();
        return view('submenus.index', compact('submenus'));
    }

    public function create(){
        $menus = Menu::Where('baja','1')->get();
        return view('submenus.create', compact('menus'));
    }

    public function store(Request $request){
        $request->validate([
            'img' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'id_menu' => 'required',
            'submenu' => 'required',
            'descripcion' => 'required',
            'promocion' => 'required|in:0,1',
            'baja' => 'required|in:0,1',
        ]);

        $imageName = time() . '_submenu.' . $request->img->extension();
        $request->img->move(base_path('es\assets\img'), $imageName);

        Submenu::create([
            'img'           => $imageName,
            'id_menu'       => $request->id_menu,
            'submenu'       => $request->submenu,
            'descripcion'   => $request->descripcion,
            'tipo_comanda'  => $request->tipo_comanda,
            'precio_compra' => $request->precio_compra,
            'precio_venta'  => $request->precio_venta,
            'promocion'     => $request->promocion,
            'baja'          => '1',
        ]);
        return redirect()->route('submenus.index')->with('success', 'Submenú creado correctamente');
    }

    public function edit(Submenu $submenu){
        $menus = Menu::all();
        return view('submenus.edit', compact('submenu', 'menus'));
    }
    
    public function update(Request $request, Submenu $submenu){
        $submenu = Submenu::find($submenu->id);
        $request->validate([
            'id_menu' => 'required',
            'submenu' => 'required',
            'descripcion' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'promocion' => 'required|in:0,1',
            'baja' => 'required|in:0,1',
        ]);
        if ($request->hasFile('img')) {
            $request->validate([
                'img' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imageName = time() . '_submenu.' . $request->img->extension();
            $request->img->move(base_path('es/assets/img'), $imageName);
            $submenu->img = $imageName;
        }
        $submenu->update($request->except(['img', 'logo', 'fondo']));
        return redirect()->route('submenus.index')->with('success', 'Submenú actualizado correctamente');
    }

    public function destroy(Submenu $submenu){   
        if ($submenu->baja == 1) {
            $submenu->update(['baja' => 0]);
        } else {
            $submenu->update(['baja' => 1]);
        }
        return redirect()->route('submenus.index')->with('success', 'Submenú eliminado correctamente');
    }
}
