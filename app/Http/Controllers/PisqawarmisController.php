<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Cliente;
use App\Models\Mesa;
use App\Models\Ventadetalle;
use App\Models\Producto;

class PisqawarmisController extends Controller
{
    public  $seleccionMesa = array();

    public function index(){
        $menus = Menu::Where('baja','1')->get();
        $mesas = Mesa::Where('baja','1')->get();
        $clientes = Cliente::Where('baja','1')->get();
        return view('pisqa.index', compact('menus', 'mesas', 'clientes'));
    }

    public function detalle($id){
        $dato = Menu::find($id);
        $menus = Submenu::Where('baja','1')->where('id_menu', $id)->orderBy('promocion', 'desc')->get();
        $mesas = Mesa::Where('baja','1')->get();
        $clientes = Cliente::Where('baja','1')->get();
        return view('pisqa.detalle', compact('menus', 'dato', 'mesas', 'clientes'));
    }

    public function buscar($id, $buscar){        
        $menus = Submenu::Where('baja','1')->where('id_menu', $id)->where('submenu', 'like',  $buscar.'%')->get();
        return $menus;
    }

    public function detallePedido($id){
        $dato = Submenu::find($id);
        return $dato;
    }

    

    public function getMesa(){
        //"cliente":"Juan Fajardo, 123456789","id":"1","id_mesa":1,"mesa":"Mesa 01, m1","id_cliente":1,"comenzales":"100"}*/
        return Session::get('mesa');
    }

    public function setMesa($id){
        $vector = explode(";", $id);
        $mesas = explode(",", $vector[0]);
        $mesa = Mesa::Where('mesa', trim($mesas[0]))->where('codigo', trim($mesas[1]))->get();
        
        if (  $vector[1] == "0" ) {
            echo "verdad";
            $activar = Mesa::find( $mesa[0]->id );
            $activar->id_mesero = Auth::id();
            $activar->mesero = Auth::user()->name;
            $activar->save();
            //'id', 'mesa', 'codigo', 'descripcion', 'id_mesero', 'mesero', 'id_cliente', 'cliente', 'cantidad_comensales', 'ocupado', 'baja',
            Session::put('id', '1');
            Session::put('id_mesa', $activar->id);
            Session::put('mesa', $activar->mesa);
            Session::put('id_cliente', $activar->id_cliente);
            Session::put('cliente', $vector[1]);
            Session::put('id_mesero', Auth::id());
            Session::put('mesero', Auth::user()->name);
            Session::put('comenzales', $activar->comenzales);
            Session::put('ocupado', $activar->ocupado);
        }else{
            echo "falso";            
            $clientes = explode(",", $vector[1]);
            $comenzal =  $vector[2];

            $cliente = Cliente::Where('cliente',  trim($clientes[0]))->where('nit', trim($clientes[1]))->get();
            
            $ocupado = date('Y-m-d H:i:s');
            $activar = Mesa::find($mesa[0]->id);
            $activar->id_mesero = Auth::id();
            $activar->mesero = Auth::user()->name;
            $activar->id_cliente = $cliente[0]->id;
            $activar->cliente = $vector[1];
            $activar->cantidad_comensales = $comenzal;
            $activar->ocupado = $ocupado;
            $activar->save();
            
            Session::put('id', '1');
            Session::put('id_mesa', $mesa[0]->id);
            Session::put('mesa', $vector[0]);
            Session::put('id_cliente', $cliente[0]->id);
            Session::put('cliente', $vector[1]);
            Session::put('id_mesero', \Auth::id());
            Session::put('mesero', Auth::user()->name);
            Session::put('comenzales', $comenzal);
            Session::put('ocupado', $ocupado);
        }
        //return Session::all(); 
        return $id;
    }


    public function comprasSet(Request $request){
        $datos = json_decode($request->json, true)[0];
        $idproducto = $datos['id'];
        /*
        "json": "[{"id":"4","titulo":"Cerveza Potosina en lata","img":"http://192.168.1.200/pisqa/es/assets/img/1711763567_submenu.jpg","cantidad":0,"precio":"19","total":0}]",
        *////Almacen 
        /* 'id_menu','id_submenu','id_producto','precio_compra','precio_venta','fecha_peticion','fecha_entrega','cantidad_entrada','cantidad_salida','observacion'];

        Compra
        compra detalle
            id_venta
            "id_producto": "4",
            "id_menu": xxxx,
            "titulo": "Cerveza Potosina en lata",
            "cantidad": 5,
            "precio": "19",
            "total": 95
            ------------
            'id_mesa', 
            'mesa', 
            'id_mesero', 
            'mesero', 
            'id_cliente', 
            'cliente', 
            'cantidad_comensales',
        */
        $producto = Submenu::find($idproducto);// $idproducto );
        $mesa = Mesa::find( Session::get('id_mesa') );
        //return $producto;
        //return Session::all();
        //return $mesa;
        $venta = new Ventadetalle();
        $venta->id_venta   = 0;
        $venta->id_producto= $producto->id;
        $venta->id_menu    = $producto->id_menu;
        $venta->id_submenu = $producto->id;
        $venta->titulo     = $producto->submenu;
        $venta->cantidad   = $datos['cantidad'];
        $venta->precio     = $datos['precio'];
        $venta->total      = ($datos['cantidad'] * $datos['precio']);
        $venta->id_mesa    = $mesa->id;
        $venta->mesa       = $mesa->mesa;
        $venta->id_mesero  = Auth::id();
        $venta->mesero     = Auth::user()->name;
        $venta->id_cliente = $mesa->id_cliente;
        $venta->cliente    = $mesa->cliente;
        $venta->cantidad_comensales = $mesa->cantidad_comensales;
        $venta->ocupado    = $mesa->ocupado;

        $venta->fecha_pago = '1900-01-01 01:01:01';
        $venta->eliminacion_comentario = '';
        $venta->eliminacion = '';
        $venta->save();

        return $venta;
    }

    public function factura(){
        $menus = Menu::Where('baja','1')->get();
        $mesas = Mesa::Where('baja','1')->get();
        $clientes = Cliente::Where('baja','1')->get();

        $ventas = Ventadetalle::Where('id_mesa', Session::get('id_mesa'))->where('ocupado', Session::get('ocupado'))->orderBy('titulo', 'asc')->get();
        return view('pisqa.factura', compact('ventas', 'menus', 'mesas', 'clientes'));
        
    }

    public function destroy($id, $ruta){
        //return ;
        $phisqa = Ventadetalle::find($id);
        if (!$phisqa) {
            return redirect()->back()->with('error', 'El recurso no existe.');
        }
        $phisqa->delete();
        if( $ruta == "factura"){
            return redirect()->route('pisqa.factura');
        }else{
            return redirect()->route('mesas.show', ['mesa' => $ruta]);
        }
    }

    public function actualizarPedido(Request $request){
        //return $request->all();
        //{"_token":"z6zfPx5qkfY6IZTu0QgqVLhCYjyFEFHUd8jVxBMa","cantidad":"5","id_mesa":"2","id_venta":"14","ruta":"factura"}
        $venta = Ventadetalle::find($request->id_venta);
        $venta->cantidad = $request->cantidad;
        $venta->precio   = $venta->precio;
        $venta->total    = ($venta->precio * $request->cantidad);
        $venta->save();

        if( $request->ruta == "factura")
            return redirect()->route('pisqa.factura');
        return redirect()->route('mesas.show', ['mesa'=> $request->id_mesa]);
    }

    public function actualizarMesa(Request $request, $id){
        //$viejo = $id;
        //$nuevo = $request->all();
        $viejo = Mesa::find($id);
        $nuevo = Mesa::find( $request->mesa );
        //return $nuevo;

        $nuevo->id_mesero   = $viejo->id_mesero;
        $nuevo->mesero      = $viejo->mesero;
        $nuevo->id_cliente  = $viejo->id_cliente;
        $nuevo->cliente     = $viejo->cliente;
        $nuevo->cantidad_comensales = $viejo->cantidad_comensales;
        $nuevo->ocupado     = $viejo->ocupado;
        $nuevo->save();

        $viejo->id_mesero   = "0";
        $viejo->mesero      = "0";
        $viejo->id_cliente  = "0";
        $viejo->cliente     = "0";
        $viejo->cantidad_comensales = "0";;
        $viejo->ocupado     = "0";
        $viejo->save();

        $ventas = Ventadetalle::where('id_mesa', $id)->where('ocupado', $nuevo->ocupado)->get();
        foreach ($ventas as $venta) {
            $v = Ventadetalle::find($venta->id);
            $v->id_mesa = $nuevo->id;
            $v->mesa = $nuevo->mesa;
            $v->save();
        }
        return redirect()->route('mesas.show', ['mesa'=> $id]);
    }

    public function actualizarMesaDato(Request $request, $id){
        $datos = explode(";", $request->cliente);
        $mesa = Mesa::find($id);
        $mesa->id_cliente           = $datos[0];
        $mesa->cliente              = $datos[1];
        $mesa->cantidad_comensales  = $request->cantidad;
        $mesa->save();
        return redirect()->route('mesas.show', ['mesa'=> $id]);
    }

    public function comanda($id){
        $datos = explode(';', $id);
        $mesa = Mesa::find($datos[0]);
        $ventas = Ventadetalle::Where('id_mesa', $datos[0])->where('ocupado', $datos[1])->get();
        return view('pisqa.comanda',compact('mesa', 'ventas'));

    }

}
