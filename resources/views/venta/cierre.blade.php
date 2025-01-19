<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Arqueo de Caja</h1>
        <hr>

        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Cierre:</strong> {{ $id }}</p>
                <p><strong>Puesto:</strong> CAJA GENERAL 2</p>
            </div>
            <div class="col-md-6">
                <p><strong>Fecha:</strong> {{ date('d/m/Y') }}</p>
                <p><strong>Hora:</strong> {{ date('H:i') }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Usuario:</strong> {{ $cajero }}</p>
                <p><strong>Terminal:</strong> PHISQA_WARMIS</p>
            </div>
            <div class="col-md-6">
                <p><strong>Turno:</strong> TARDE</p>
            </div>
        </div>

        <hr>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Cuenta</th>
                    <th>Cantidad</th>
                    <th>Saldo (Bs)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>EFECTIVO</td>
                    <td>0.00</td>
                    <td>{{ number_format($sumaEfectivoNormal, 2) }}</td>
                </tr>
                <tr>
                    <td>TARJETAS</td>
                    <td>0.00</td>
                    <td>{{ number_format($sumaTarjetaNormal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total Bs:</strong></td>
                    <td><strong>{{ number_format($sumaEfectivoNormal + $sumaTarjetaNormal, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <hr>

        <h3 class="mt-4">Clientes con Pagos Especiales</h3>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Total (Bs)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sumaEspecialSinPago as $especial)
                    <tr>
                        <td>{{ $especial->cliente }}</td>
                        <td>{{ number_format($especial->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>