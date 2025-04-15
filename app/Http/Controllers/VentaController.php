<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Menu;
use App\Models\Mesa;
use App\Models\User;
use App\Models\Ventadetalle;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index(){
        $datos = Venta::Where('cierre', '--')->get();
        return view('venta.index', compact('datos'));
    }

    public function show($id){
        $detalles = Ventadetalle::where('id_venta', $id)->get();
        return response()->json([
            'success' => true,
            'html' => view('venta.detalle', compact('detalles'))->render()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'usuario' => 'required|integer'
        ]);

        $fechaInicio = $request->input('fecha_inicio');
        $fechaFinal = $request->input('fecha_final');
        $usuarioId = $request->input('usuario');

        $ventas = VentaDetalle::join('ventas', 'ventas.id', '=', 'ventadetalles.id_venta')
            ->join('users', 'users.id', '=', 'ventas.id_cajero')
            ->select(
                'ventadetalles.*', 
                'ventas.*', 
                'users.name as cajero_nombre'
            )->whereBetween('ventas.created_at', [$fechaInicio, $fechaFinal]);

        if ($usuarioId != 0) {
            $ventas->where('users.id', '=', $usuarioId);
        }
        $ventas = $ventas->get();
        return view('venta.reporte', compact('ventas', 'fechaInicio', 'fechaFinal'));
    }

    public function reporteGet(){
        $meseros = User::all();
        $mesas = Mesa::all();
        $menus = Menu::all();
        return view('reporte.index', compact('meseros', 'mesas', 'menus'));
    }

    public function reportePost(){
        return view('venta.index', compact('datos'));        
    }

    public function cierre(){
        $id = Venta::max('id_cierre') + 1;

        $mesas = Mesa::where('id_mesero', '!=', '0')->count();
        if( $mesas!=0 )
                return "<script>
                    alert('Existe una mesa que no cerró.');
                    window.location.href = '" . asset('index.php/ventas') . "';
                        </script>";

        $datos = Venta::where('cierre', '--')->get();
        
        $cajero = auth()->user()->name; // Nombre del cajero actual
        $fecha = date('Y-m-d'); // Fecha actual

        // Sumas según las condiciones
        $sumaEfectivoNormal = Venta::Where('cierre', '--')
            ->where('pago', 'normal')
            ->where('tipo_pago', 'efectivo')
            ->sum('total');

        $sumaTarjetaNormal = Venta::Where('cierre', '--')
            ->where('pago', 'normal')
            ->where('tipo_pago', 'tarjeta')
            ->sum('total');

        $sumaEspecialSinPago = Venta::where('cierre', '--')
            ->where('pago', 'especial')
            ->where('tipo_pago', 'Sin pago')
            ->groupBy('cliente')
            ->select('cliente', DB::raw('SUM(total) as total'))
            ->get();
        foreach ($datos as $venta) {
            $venta->fecha_cierre = $fecha;
            $venta->cierre = $cajero;
            $venta->id_cierre = $id;
            $venta->save();
        }
        return view('venta.cierre', [
            'id' => $id,
            'cajero' => $cajero,
            'sumaEfectivoNormal' => $sumaEfectivoNormal,
            'sumaTarjetaNormal' => $sumaTarjetaNormal,
            'sumaEspecialSinPago' => $sumaEspecialSinPago,
        ]);
    }

    public function registro(Request $request){
        echo "ss";
        
        return $request->all();

        $venta = new Venta();

        $venta->fecha_pedido = date('Y-m-d H:i:s');
        $venta->fecha_pago =  date('Y-m-d H:i:s');
            
        $venta->id_mesero = auth()->user()->id;
        $venta->mesero =  auth()->user()->name;
        $venta->id_cajero = auth()->user()->id;
        $venta->cajero = auth()->user()->name;

        $venta->cliente = "0";
        $venta->id_cliente = 0;
        $venta->pago = "0";

                                
        $venta->comensales = 0;
        $venta->total = 0;
        $venta->ip = $request->ip();
        $venta->tipo_pago = "0";
        
        $venta->registro = date('Y-m-d H:i:s');
        $venta->registro_efectivo = $request->efectivo;
        $venta->registro_tarjeta = $request->tarjet;
        $venta->adelanto_efectivo = $request->adelanto;
        $venta->adelanto = $request->descripcionAdelanto;
        $venta->comentario = $request->comentario;
        $venta->save();

    }
}