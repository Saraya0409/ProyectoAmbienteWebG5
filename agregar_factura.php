<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Procesar la solicitud de agregar una nueva factura
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $_POST['cedulaFactura'];
    $nombre = $_POST['nombreCliente'];
    $telefono = $_POST['telefono'];
    $total = $_POST['total'];
    $metodo_pago = $_POST['metodoPago'];

    // Insertar la factura en la base de datos
    $stmt = $conn->prepare("INSERT INTO factura (cedula_cliente, nombre_cliente, telefono, total, metodo_pago) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $cedula, $nombre, $telefono, $total, $metodo_pago);

    if ($stmt->execute()) {
        // Redireccionar al archivo principal (factura.php) después de la inserción exitosa
        header('Location: factura.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al agregar la factura: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();  // Cerrar la conexión
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Agregar Nueva Factura</h2>

        <!-- Formulario para agregar una nueva factura -->
        <form method="POST" action="agregar_factura.php">
            <div class="mb-3">
                <label for="cedulaFactura" class="form-label">Cédula del Cliente</label>
                <input type="text" class="form-control" name="cedulaFactura" id="cedulaFactura" placeholder="Ingrese la cédula del cliente" required>
            </div>
            <div class="mb-3">
                <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" name="nombreCliente" id="nombreCliente" placeholder="Ingrese el nombre del cliente" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese el teléfono del cliente" required>
            </div>
            <div class="mb-3">
        <label for="total" class="form-label">Total</label>
        <input type="number" class="form-control" name="total" id="total" required step="0.01">
    </div>
            <div class="mb-3">
                <label for="metodoPago" class="form-label">Método de Pago</label>
                <select class="form-control" name="metodoPago" id="metodoPago" required>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Sinpe">Sinpe</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Agregar Factura</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
