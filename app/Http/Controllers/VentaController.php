<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Menu;
use App\Models\Mesa;
use App\Models\User;
use App\Models\Ventadetalle;

class VentaController extends Controller
{
    public function index(){
        $datos = Venta::paginate(10);;
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

        // Consultar las ventas según los filtros
        $ventas = VentaDetalle::join('ventas', 'ventas.id', '=', 'ventadetalles.id_venta')
            ->join('users', 'users.id', '=', 'ventas.id_cajero')  // Cambiamos 'user' a 'users' para reflejar el plural correcto
            ->select(
                'ventadetalles.*', 
                'ventas.*', 
                'users.name as cajero_nombre'
            )->whereBetween('ventas.created_at', [$fechaInicio, $fechaFinal]);

        if ($usuarioId != 0) {
            $ventas->where('users.id', '=', $usuarioId);
        }
        $ventas = $ventas->get();
        return view('venta.reporte', compact('ventas', 'fechaInicio', 'fechaFinal', ));
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

}
