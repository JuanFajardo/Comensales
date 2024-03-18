<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;

class PisqawarmisController extends Controller
{
    public  $compras = array(
        array('id' => 0, 'titulo' => '0', 'img' => '0', 'cantidad' => '0', 'precio' => '0', 'total' => '0',)
    );

    public function index(){
        $menus = Menu::Where('baja','1')->get();
        return view('pisqa.index', compact('menus'));
    }

    public function detalle($id){
        $dato = Menu::find($id);
        $menus = Submenu::Where('baja','1')->where('id_menu', $id)->get();
        return view('pisqa.detalle', compact('menus', 'dato'));
    }

    public function detallePedido($id){
        $dato = Submenu::find($id);
        return $dato;
    }

    public function comprasVer(){
        return $this->compras;
    }

    public function comprasSet(Request $request)
    {
        $json_recibido = $request->input('mi_json');
        $this->compras = json_decode($json_recibido, true);
        return $this->compras;
    }

}
