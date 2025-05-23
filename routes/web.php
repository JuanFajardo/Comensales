<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\PisqawarmisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        if (auth()->user()->tipo == "mesero") {
            return  redirect('/PhisqaWarmis');
        }else{
            return view('pisqa');
        }
    });

    Route::get('change', [UserController::class, 'change'])->name('user.change');
    Route::post('change', [UserController::class, 'changePost'])->name('user.changePost');
    
    Route::resource('usuarios', UserController::class);
    Route::resource('almacen', AlmacenController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('mesas', MesaController::class);
    Route::get('mesas/activar/{id}', [MesaController::class, 'activar'])->name('mesa.activar');

    Route::resource('clientes', ClienteController::class);
    Route::get('clientes/baja/{id}', [ClienteController::class, 'baja'])->name('cliente.baja');
    Route::resource('submenus', SubmenuController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('ventas', VentaController::class);
    Route::post('registro', [VentaController::class, 'registro'])->name('ventas.registro');

    Route::get('Cierre', [VentaController::class, 'cierre'])->name('ventas.cierre');

    Route::get('reporte', [VentaController::class, 'reporteGet'])->name('ventas.reporteGet');
    Route::post('reporte', [VentaController::class, 'reportePost'])->name('ventas.reportePost');
    Route::get('reporteCierre', [VentaController::class, 'reporteCierreGet'])->name('ventas.reporteCierre');
    Route::get('reporteCierre/{id}', [VentaController::class, 'reporteCierreId'])->name('ventas.reporteCierreId');
    Route::get('reporteCierreMenu/{id}', [VentaController::class, 'reporteCierreMenu'])->name('ventas.reporteCierreMenu');
    Route::get('reporteMesa', [VentaController::class, 'reporteMesa'])->name('ventas.reporteMesa');
    
    Route::get('limpiarcookies', [PisqawarmisController::class, 'limpiarcookies'])->name('pisqa.limpiarcookies');
    Route::get('cargarcookies/{id}', [PisqawarmisController::class, 'cargarcookies'])->name('pisqa.cargarcookies');
    Route::get('librerarmesa/{id}', [MesaController::class, 'liberar'])->name('mesas.liberar');

    Route::get('PhisqaWarmis', [PisqawarmisController::class, 'index']);
    Route::get('PhisqaWarmis/{id}', [PisqawarmisController::class, 'detalle']);
    Route::get('PhisqaBuscar/{id}/{buscar}', [PisqawarmisController::class, 'buscar']);

    Route::get('PhisqaWarmis/detalle/{id}', [PisqawarmisController::class, 'detallePedido']);

    Route::get('PhisqaSession/getMesa', [PisqawarmisController::class, 'getMesa']);
    Route::get('PhisqaSession/setMesa/{id}', [PisqawarmisController::class, 'setMesa']);
    Route::get('Phisqa/comprasVer', [PisqawarmisController::class, 'comprasVer']);
    Route::post('Phisqa/comprasSet', [PisqawarmisController::class, 'comprasSet']);

    Route::post('Phisqa/Actualizar', [PisqawarmisController::class, 'actualizarPedido'])->name('pisqa.actualizarPedido');
    Route::put('Phisqa/Mesa/{id}', [PisqawarmisController::class, 'actualizarMesa'])->name('mesas.cambio');
    Route::put('Phisqa/Mesadato/{id}', [PisqawarmisController::class, 'actualizarMesaDato'])->name('mesas.cambiodato');

    Route::get('Phisqa/comanda/{id}', [PisqawarmisController::class, 'comanda'])->name('mesas.comanda');
    Route::post('Phisqa/pagar/{id}/{tipo}', [PisqawarmisController::class, 'pagar'])->name('mesas.pagar');
    
    Route::delete('Phisqa/{id}/{ruta}', [PisqawarmisController::class, 'destroy'])->name('pisqa.destroy');
    Route::get('factura', [PisqawarmisController::class, 'factura'])->name('pisqa.factura');
});