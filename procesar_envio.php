<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $metodo_pago = $_POST['metodo_pago'];

    // Calcula el total del carrito
    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }

    // Inserta en la tabla factura
    $stmtFactura = $conn->prepare("INSERT INTO factura (cedula_cliente, nombre_cliente, telefono, total, metodo_pago) VALUES (?, ?, ?, ?, ?)");
    $stmtFactura->bind_param("sssss", $cedula, $nombre, $telefono, $total, $metodo_pago);
    $stmtFactura->execute();
    $idFactura = $stmtFactura->insert_id;

    // Inserta en la tabla envio
    $stmtEnvio = $conn->prepare("INSERT INTO envio (nombre, cedula, direccion, metodo_pago, id_factura) VALUES (?, ?, ?, ?, ?)");
    $stmtEnvio->bind_param("ssssi", $nombre, $cedula, $direccion, $metodo_pago, $idFactura);
    $stmtEnvio->execute();

    // Inserta cada producto del carrito en la tabla ventas
    $stmtVenta = $conn->prepare("INSERT INTO ventas (id_producto, cantidad, nombre_producto, id_factura, total) VALUES (?, ?, ?, ?, ?)");
    foreach ($_SESSION['carrito'] as $idProducto => $producto) {
        $cantidad = $producto['cantidad'];
        $nombreProducto = $producto['nombre'];
        $subtotal = $producto['precio'] * $cantidad;
        $stmtVenta->bind_param("iisid", $idProducto, $cantidad, $nombreProducto, $idFactura, $subtotal);
        $stmtVenta->execute();

        // Verificar y actualizar el inventario
        $stmtVerificar = $conn->prepare("SELECT cantidad FROM producto WHERE id_producto = ?");
        $stmtVerificar->bind_param("i", $idProducto);
        $stmtVerificar->execute();
        $resultado = $stmtVerificar->get_result();
        $productoInventario = $resultado->fetch_assoc();

        if ($productoInventario['cantidad'] >= $cantidad) {
            // Preparar la consulta para actualizar el inventario
            $stmtInventario = $conn->prepare("UPDATE producto SET cantidad = cantidad - ? WHERE id_producto = ?");
            $stmtInventario->bind_param("ii", $cantidad, $idProducto);
            $stmtInventario->execute();
        } else {
            echo "Error: No hay suficiente inventario para el producto: $nombreProducto";
            exit(); // Detener el proceso si no hay suficiente inventario
        }
    }

    // Limpia el carrito después del envío
    unset($_SESSION['carrito']);

    // Redirige con el código de la factura en la URL
    header("Location: formEnvio.php?codigoFactura=$idFactura");
    exit();

    // Cierra las conexiones
    $stmtFactura->close();
    $stmtEnvio->close();
    $stmtVenta->close();
    $stmtInventario->close();
    $conn->close();
}
?>
