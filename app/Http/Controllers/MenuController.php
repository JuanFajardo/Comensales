<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
     // Mostrar todos los productos
     public function index()
     {
         $menus = Menu::all();
         return view('menus.index', compact('menus'));
     }
 
     // Mostrar el formulario para crear un nuevo producto
     public function create()
     {
         return view('menus.create');
     }
 
     // Guardar un nuevo producto
     public function store(Request $request){
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu' => 'required',
            'descripcion' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fondo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '_menu.' . $request->img->extension();
        $request->img->move(base_path('es\assets\img'), $imageName);

        $logoName = time() . '_logo.' . $request->logo->extension();
        $request->logo->move(base_path('es\assets\img'), $logoName);

        $fondoName = time() . '_fondo.' . $request->fondo->extension();
        $request->fondo->move(base_path('es\assets\img'), $fondoName);
    
        Menu::create([
            'img' => $imageName, 
            'menu' => $request->menu,
            'logo' => $logoName,
            'fondo' => $fondoName,
            'descripcion' => $request->descripcion,
            'baja' => '1',
        ]);
        
        return redirect()->route('menus.index')->with('success','Menu creado correctamente');
     }
 

     // Mostrar el formulario para editar un producto
    public function edit(Menu $menu){
        return view('menus.edit', compact('menu'));
    }
 
    public function update(Request $request,  $id){
        $menu = Menu::find($id);
        
        if ($request->hasFile('img')) {
            $imageName = time() . '_menu.' . $request->img->extension();
            $request->img->move(base_path('es/assets/img'), $imageName);
            $menu->img = $imageName;
        }
    
        if ($request->hasFile('logo')) {
            $logoName = time() . '_logo.' . $request->logo->extension();
            $request->logo->move(base_path('es/assets/img'), $logoName);
            $menu->logo = $logoName;
        }
    
        if ($request->hasFile('fondo')) {
            $fondoName = time() . '_fondo.' . $request->fondo->extension();
            $request->fondo->move(base_path('es/assets/img'), $fondoName);
            $menu->fondo = $fondoName;
        }
        $menu->update($request->except(['img', 'logo', 'fondo']));
        return redirect()->route('menus.index')->with('success','Menu actualizado correctamente');
    }
 
     
     public function destroy(Menu $producto, $id)
     {
        $menu = Menu::find($id);
        if ($menu->baja == 1) {
            $menu->update(['baja' => 0]);
        } else {
            $menu->update(['baja' => 1]);
        }
        return redirect()->route('menus.index')->with('success','Menu eliminado correctamente');
     }
}
