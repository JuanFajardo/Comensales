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

        //return $request->all();

        $submenu = new Submenu();
        $submenu->img = $imageName;
        $submenu->id_menu = $request->id_menu;
        $submenu->submenu = $request->submenu;
        $submenu->descripcion = $request->descripcion;
        $submenu->peso = $request->peso;
        $submenu->precio_compra = $request->precio_compra;
        $submenu->precio_venta = $request->precio_venta;
        $submenu->promocion = $request->promocion;
        $submenu->baja = $request->baja;
        $submenu->save();
        
        //return $submenu;
        return redirect()->route('submenus.index')->with('success', 'Submenú creado correctamente');
    }

    public function edit(Submenu $submenu){
        $menus = Menu::all();
        return view('submenus.edit', compact('submenu', 'menus'));
    }
    
    public function update(Request $request, Submenu $submenu){
        $request->validate([
            'img' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'id_menu' => 'required',
            'submenu' => 'required',
            'descripcion' => 'required',
            'peso' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'promocion' => 'required|in:0,1',
            'baja' => 'required|in:0,1',
        ]);

        if ($request->hasFile('img')) {
            $imageName = time() . '_submenu.' . $request->img->extension();
            $request->img->move(public_path('assets/img'), $imageName);
            $submenu->img = $imageName;
        }

        $submenu->id_menu = $request->id_menu;
        $submenu->submenu = $request->submenu;
        $submenu->descripcion = $request->descripcion;
        $submenu->peso = $request->peso;
        $submenu->precio_compra = $request->precio_compra;
        $submenu->precio_venta = $request->precio_venta;
        $submenu->promocion = $request->promocion;
        $submenu->baja = $request->baja;
        $submenu->save();
        
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
