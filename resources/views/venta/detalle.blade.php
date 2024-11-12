<table class="table table-bordered">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalles as $detalle)
        <tr>
            <td>{{ $detalle->titulo }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td>{{ $detalle->precio }}</td>
            <td>{{ $detalle->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>