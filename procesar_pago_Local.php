<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
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

    // Inserta cada producto del carrito en la tabla ventas
    $stmtVenta = $conn->prepare("INSERT INTO ventas (id_producto, cantidad, nombre_producto, id_factura, total) VALUES (?, ?, ?, ?, ?)");
    foreach ($_SESSION['carrito'] as $idProducto => $producto) {
        $cantidad = $producto['cantidad'];
        $nombreProducto = $producto['nombre'];
        $subtotal = $producto['precio'] * $cantidad;
        $stmtVenta->bind_param("iisid", $idProducto, $cantidad, $nombreProducto, $idFactura, $subtotal);
        $stmtVenta->execute();
    }

    // Limpia el carrito después del pago
    unset($_SESSION['carrito']);

    // Muestra una alerta con el código de la factura
    header("Location: pagoLocal.php?codigoFactura=$idFactura");
    exit();


    $stmtFactura->close();
    $stmtVenta->close();
    $conn->close();
}
?>
