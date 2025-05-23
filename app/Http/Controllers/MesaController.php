<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;
use App\Models\Cliente;
use App\Models\Ventadetalle;

class MesaController extends Controller
{
    public function index(){
        $mesas = Mesa::all();
        return view('mesas.index', compact('mesas'));
    }

    public function create(){
        return view('mesas.create');
    }

    public function show($id){
        $mesas = Mesa::Where('id', '!=', $id)->where('baja','1')->get();
        $clientes = Cliente::Where('baja','1')->get();
        $mesa = Mesa::find($id);
        $ventas = Ventadetalle::Where('id_mesa', $id)
                                ->where('fecha_pago', 'like', '1900-01-01%')
                                ->get();
        return view('mesas.show', compact('mesas', 'mesa', 'ventas', 'clientes'));
    }

    public function store(Request $request)
    {
        $request['baja']= 1;
        $request['id_mesero']= 0;
        $request['mesero']= "0";
        $request['id_cliente']= 0;
        $request['cliente']= "0";
        $request['cantidad_comensales']= "0";
        $request['ocupado']= "0";

        $request->validate([
            'mesa' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);
        Mesa::create($request->all());
        return redirect()->route('mesas.index')->with('success', 'Mesa creada correctamente');
    }

    // Mostrar el formulario para editar una mesa
    public function edit(Mesa $mesa)
    {
        return view('mesas.edit', compact('mesa'));
    }

    // Actualizar una mesa
    public function update(Request $request, Mesa $mesa)
    {
        $request['id_mesero']= 0;
        $request['mesero']= "0";
        $request['id_cliente']= 0;
        $request['cliente']= "0";
        $request['cantidad_comensales']= "0";
        $request['ocupado']= "0";

        $request->validate([
            'mesa' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);
        $mesa->update($request->all());
        return redirect()->route('mesas.index')->with('success', 'Mesa actualizada correctamente');
    }

    // Librerar Mesa
    public function liberar($id)
    {
        $detalles = Ventadetalle::Where("id_mesa",$id)
        ->Where("fecha_pago","1900-01-01 01:01:01")
        ->Where("tipo_pago","NO")
        ->Where("cantidad",">","0")->count();
        
        if($detalles == 0){
            $mesa = Mesa::find($id);
            $mesa->id_mesero = 0;
            $mesa->mesero = "0";
            $mesa->id_cliente = 0;
            $mesa->cliente = "0";
            $mesa->cantidad_comensales = "0";
            $mesa->ocupado = "0";
            $mesa->save();
        }
        return redirect()->action([MesaController::class, 'index']);
    }

    public function destroy(Request $request){
        $detalle = Ventadetalle::find( $request->pedidoId );
        $detalle->update(
            [   
                'cantidad' => -1,
                'precio' => 0,
                'total' => 0,
                'pago_cantidad' => 0,
                'pago_costo' => 0,
                'eliminacion_comentario' => $request->razon,
                'eliminacion' => date('Y-m-d H:i:s'),
            ]
        );
        return redirect()->route('mesas.show', $request->mesaId )->with('success', 'Pedido eliminado ');
    }

    public function activar($id){
        $mesa = Mesa::find($id);
        if ($mesa->baja == 1) {
            $mesa->update(['baja' => 0]);
        } else {
            $mesa->update(['baja' => 1]);
        }
        return redirect()->route('mesas.index')->with('success','_ ');
    }
}