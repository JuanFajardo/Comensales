<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Cliente;
use App\Models\Mesa;
use App\Models\Venta;
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
        //return $request->all();
        $datos = json_decode($request->json, true)[0];
        $idproducto = $datos['id'];
    
        $producto = Submenu::find($idproducto);
        $mesa = Mesa::find(Session::get('id_mesa'));
        $ip = $request->ip();

        $venta = new Ventadetalle();
        $venta->id_venta   = 0;
        $venta->id_producto= $producto->id;
        $venta->id_menu    = $producto->id_menu;
        $venta->id_submenu = $producto->id;
        $venta->titulo     = $producto->submenu;
        $venta->tipo_comanda= $producto->tipo_comanda;
        
        $venta->cantidad   = $datos['cantidad'];
        $venta->precio     = $datos['precio'];
        $venta->total      = ($datos['cantidad'] * $datos['precio']);
        $venta->id_mesa    = $mesa->id;
        $venta->mesa       = $mesa->mesa;
        $venta->id_mesero  = Auth::id();
        $venta->mesero     = Auth::user()->name;
        $venta->id_cliente = $mesa->id_cliente;
        $venta->cliente    = $mesa->cliente;
        $venta->cantidad_comensales = (isset($mesa) && is_object($mesa)) ? ($mesa->cantidad_comensales ?? 0) : 0;
        $venta->ocupado    = $mesa->ocupado;
        $venta->ip         = $ip;

        // Corregido
        $venta->tipo_pedido = $request->tipo_pedido;
        $venta->comentario_pedido = $request->comentario_pedido;

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
        $ventas = Ventadetalle::Where('id_mesa', Session::get('id_mesa'))
                              ->where('fecha_pago', 'like', '1900-01-01%')
                              ->orderBy('titulo', 'asc')->get();
        return view('pisqa.factura', compact('ventas', 'menus', 'mesas', 'clientes'));
    }

    public function destroy($id, $ruta){
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
        //return $request->all();
        $viejo = Mesa::find($id);
        $nuevo = Mesa::find( $request->mesa );

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
        $viejo->cantidad_comensales = "0";
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
       
    public function comanda($id)
    {
        [$mesaId, $tipoComanda] = explode(';', $id);

        $mesa = Mesa::find($mesaId);
        if (!$mesa) {
            return redirect()->back()->with('error', 'Mesa no encontrada.');
        }

        $query = Ventadetalle::where('id_mesa', $mesaId)
            ->where('fecha_pago', '1900-01-01 01:01:01.000');

        if ($tipoComanda !== 'comanda') {
            $query->where('tipo_comanda', $tipoComanda);
        }
        $ventas = $query->get();
        $data = [
            'mesa' => $mesa,
            'ventas' => $ventas,
            'comanda' => $tipoComanda,
        ];
        
        return view('pisqa.comanda', $data);
    }

    
    public function pagar($id, $tipo, Request $request){
        $mesa = Mesa::find($id);
        $venta = "";
        $productos = $request->productos;
        //return $productos;
        //{"6":{"precio":"35","codigo":"6","cantidad":"5"},"7":{"precio":"25","codigo":"7","cantidad":"4"},"13":{"precio":"10","codigo":"13","cantidad":"2"},"14":{"precio":"10","codigo":"14","cantidad":"2"},"15":{"precio":"10","codigo":"15","cantidad":"1","producto":"1"}}
        $cantidadContar = 0; 
        $pedidoSeparado = [];
        $idsActualizados = []; // Para almacenar los IDs de los registros actualizados
        $idsNuevos = []; // Para almacenar los IDs de los nuevos registros
        $totalVenta = 0;
        foreach ($productos as $producto) {
            if (isset($producto['producto'])) {
                $cantidad = $producto['producto'];
                $cantidadContar++;
                $codigoId = $producto['codigo'];
                $datos = Ventadetalle::find($codigoId);
                $totalVenta = $totalVenta + ($producto['precio'] * $cantidad);
                if ($datos) {
                    // Guardar el ID del registro actualizado
                    $idsActualizados[] = $datos->id;
                    // Actualizar los datos existentes
                    $datos->cantidad = $datos->cantidad - $cantidad;
                    $datos->total = $datos->total - ($datos->precio * $cantidad);
                    $datos->save();
                    // Crear un nuevo registro basado en el actual
                    $nuevoDetalle = $datos->replicate(); // Clonar el registro actual
                    $nuevoDetalle->cantidad = $cantidad; // Establecer la nueva cantidad
                    $nuevoDetalle->total = $datos->precio * $cantidad; // Calcular el nuevo total
                    $nuevoDetalle->fecha_pago = now(); // Fecha actual de pago
                    $nuevoDetalle->save();
                    // Guardar el ID del nuevo registro
                    $idsNuevos[] = $nuevoDetalle->id;
                    // Agregar el nuevo detalle al array de separados
                    $pedidoSeparado[] = $nuevoDetalle;
                }
            }
        }
        
        //return $pedidoSeparado;
        if( $cantidadContar != 0){
            $ventasDetalles = collect($pedidoSeparado);
        }else{
            foreach ($productos as $producto) {
                $idsNuevos[] = $codigoId = $producto['codigo'];
                $ventasDetalles = Ventadetalle::whereIn('id', $idsNuevos)->get();
                //$totalVenta = Ventadetalle::sum('total')->Where('id', $idsNuevos); 
                $totalVenta = Ventadetalle::whereIn('id', $idsNuevos)->sum('total');

            }
        }
        // Obtener datos del mesero y cajero desde la sesión
            $id_cajero  = \Auth()->user()->id;
            $cajero     = \Auth()->user()->name;
            $id_mesero  = $ventasDetalles->first()->id_mesero;
            $mesero     = $ventasDetalles->first()->mesero;    
            $clinte     = Cliente::find( $mesa->id_cliente );
                     
            $fechaPago  = now();                    
        // Crear un nuevo registro en la tabla 'ventas'
            $venta = Venta::create([
                'fecha_pedido'  => $ventasDetalles->first()->created_at,
                'fecha_pago'    => $fechaPago,
                'id_mesero'     => $id_mesero,
                'mesero'        => $mesero,
                'id_cajero'     => $id_cajero,
                'cajero'        => $cajero,
                'cliente'       => $clinte->cliente,
                'id_cliente'    => $clinte->id,
                'pago'          => $clinte->tipo,
                'tipo_pago'     => $clinte->tipo == "normal" ?  $tipo : "Sin pago",   //Efectivo o tareta
                'comensales'    => $mesa->cantidad_comensales,
                'total'         => $totalVenta, 
                'ip'            => $request->ip(),
            ]);
        // Actualizar los detalles de la venta en 'ventadetalles'
            foreach ($ventasDetalles as $detalle) {
                $detalle->update([

                    'id_venta' => $venta->id, 
                    'tipo_pago' => $tipo, //Efectivo o tareta
                    'fecha_pago' => $fechaPago, 

                ]);
            }
        // Si envian todos los productospara pagar
            if( $cantidadContar == 0){
                $mesa->update([
                    'ocupado' => 'no',
                    'id_mesero' => '0',
                    'mesero' => '0',
                    'id_cliente' => '0',
                    'cliente' => '0',
                    'cantidad_comensales' => '0',
                    'ocupado' => '0',
                ]);
            }
        $ventas = $ventasDetalles;
        return view('pisqa.pago',compact('mesa', 'ventas', 'venta'));
    }

}
