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

    public function reportePost(Request $request){
        
        $reporteTipo = $request->input('reporte_tipo');
        // Variable para almacenar las ventas obtenidas
        $tipo = $request->tipo;
        
        $ventas = [];
        if ($reporteTipo === 'diario') {
            // Obtener las ventas del día actual
            $hoy = now()->startOfDay(); // Inicio del día
            $manana = now()->addDay()->startOfDay(); // Inicio del día siguiente
            $ventas = Venta::whereBetween('fecha_pedido', [$hoy, $manana])->get();
            $fechaInicio = date('Y-m-d');
            $fechaFinal = date('Y-m-d');
        } elseif ($reporteTipo === 'personalizado') {
            // Obtener las ventas entre dos fechas proporcionadas
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFinal = $request->input('fecha_final');
            if ($fechaInicio && $fechaFinal) {
                $ventas = Venta::whereBetween('fecha_pedido', [$fechaInicio, $fechaFinal])->get();
            } else {
                return redirect()->back()->with('error', 'Debe seleccionar ambas fechas para el reporte personalizado.');
            }
        }
        $datos = Ventadetalle::whereIn('id_venta', $ventas->pluck('id'))->get();
        return view('reporte.reporte', compact('ventas', 'fechaInicio', 'fechaFinal', 'tipo', 'datos'));
    }

    public function cierre(){
        $id = Venta::max('id_cierre') + 1;

        $mesas = Mesa::where('id_mesero', '!=', '0')->get();

        if( count( $mesas ) !=0 ){
                return "<script>
                    alert('Existe una mesa abiert. \n" + $mesas[0]->mesa + " \n "+$mesas[0]->mesero+"');
                    window.location.href = '" . asset('index.php/ventas') . "';
                    </script>";
        }

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

        return redirect()->route('ventas.reporteCierreId', ['id' => $id]);
    }

    public function registro(Request $request){
        //return $request->all();
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
        return redirect()->route('ventas.index');
    }

    public function reporteCierreGet(){
        $datos = Venta::groupBy('cierre', 'id_cierre', 'fecha_cierre')
                        ->select('cierre', 'id_cierre', 'fecha_cierre')
                        ->orderBy('id_cierre','desc')
                        ->get();
        return view('venta.cierreindex', compact('datos'));
    }

    public function reporteCierreId($id){
        $dato = Venta::groupBy('cierre', 'id_cierre', 'fecha_cierre')
                        ->select('cierre', 'id_cierre', 'fecha_cierre')
                        ->where('id_cierre', $id)
                        ->first();
        $efectivo = Venta::where('tipo_pago', 'efectivo')
                        ->where('id_cierre', $id)
                        ->selectRaw('COUNT(*) as cantidad, SUM(total) as suma')
                        ->first();
        $tarjeta = Venta::where('tipo_pago', 'tarjeta')
                        ->where('id_cierre', $id)
                        ->selectRaw('COUNT(*) as cantidad, SUM(total) as suma')
                        ->first();
        $datos = Venta::Where('id_cierre', $id)->get();
        return view('venta.cierreid', compact('dato','efectivo','tarjeta', 'datos'));
    }

    public function reporteCierreMenu($i){
        $lista = Venta::where('id_cierre', $i)->get();
        $datos = Ventadetalle::join('menus', 'menus.id', '=', 'ventadetalles.id_menu')
                    ->where('cantidad', '>', 0)
                    ->whereIn('ventadetalles.id_venta', $lista->pluck('id'))
                    ->groupBy('ventadetalles.id_menu', 'menus.menu')
                    ->selectRaw('ventadetalles.id_menu, menus.menu')
                    ->get();
        $detalles = Ventadetalle::select('id_menu', 'titulo', 'cantidad', 'total')
                 ->whereIn('ventadetalles.id_venta', $lista->pluck('id'))
                 ->where('cantidad', '>', 0)
                 ->orderBy('titulo')
                 ->get();
        $detallesAgrupados = $detalles->groupBy('titulo')->map(function ($group) {
            $first = $group->first();
            $first->cantidad = $group->sum('cantidad');
            $first->total = $group->sum('total');
            return $first;
        })->values();
        $detalles = $detallesAgrupados;
        return view('venta.cierreMenu', compact('lista','datos','detalles'));
    }

    public function reporteMesa(){
        $datos = DB::table('mesas')
        ->leftJoin('ventadetalles', function($join) {
            $join->on('mesas.id', '=', 'ventadetalles.id_mesa')
                 ->where('ventadetalles.id_venta', '=', 0)
                 ->where('ventadetalles.cantidad', '>', 0)
                 ->where('ventadetalles.total', '>', 0);
        })
        ->select(
            'mesas.id',
            'mesas.mesa',
            DB::raw('COUNT(ventadetalles.id) as cantidad')
        )
        ->groupBy('mesas.id', 'mesas.mesa')
        ->orderBy('mesas.mesa')
        ->get();

        return view('venta.reporteMesa', compact('datos'));
    }

}