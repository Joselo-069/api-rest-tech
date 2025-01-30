<!DOCTYPE html>
<html>

    <head>
        <title>Recibo de Compra</title>
    </head>

    <body>
        <h2>Gracias por tu compra, {{ $sale->clients->name }}!</h2>

        <p><strong>Fecha:</strong> {{ $sale->date }}</p>
        <p><strong>Monto Total:</strong> ${{ number_format($sale->monto, 2) }}</p>

        <h3>Productos Comprados:</h3>
        <ul>
            @foreach ($products as $product)
                <li>{{ $product->name }}</li>
            @endforeach
        </ul>

        <p>Esperamos verte pronto. ¡Gracias por tu compra!</p>
    </body>

</html>