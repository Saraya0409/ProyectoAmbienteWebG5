<?php
include 'db.php'; // Incluir la conexión a la base de datos

// Procesar la solicitud de agregar una nueva venta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $nombre_producto = $_POST['nombre_producto'];
    $id_factura = $_POST['id_factura'];
    $total = $_POST['total'];

    // Validar y asegurar que los datos sean válidos
    if (is_numeric($id_producto) && is_numeric($cantidad) && is_numeric($id_factura) && is_numeric($total)) {
        // Insertar la venta en la base de datos
        $stmt = $conn->prepare("INSERT INTO ventas (id_producto, cantidad, nombre_producto, id_factura, total) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisid", $id_producto, $cantidad, $nombre_producto, $id_factura, $total);

        if ($stmt->execute()) {
            // Redirigir al archivo principal (ventas.php) después de la inserción exitosa
            header('Location: ventas.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al agregar la venta: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Todos los campos deben ser válidos.</div>";
    }
}

$conn->close(); // Cerrar la conexión
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Agregar Nueva Venta</h2>

        <!-- Formulario para agregar una nueva venta -->
        <form method="POST" action="agregar_venta.php">
            <div class="mb-3">
                <label for="id_producto" class="form-label">ID del Producto</label>
                <input type="number" class="form-control" name="id_producto" id="id_producto" placeholder="Ingrese el ID del producto" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Ingrese la cantidad" required>
            </div>
            <div class="mb-3">
                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="mb-3">
                <label for="id_factura" class="form-label">ID de la Factura</label>
                <input type="number" class="form-control" name="id_factura" id="id_factura" placeholder="Ingrese el ID de la factura asociada" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" step="0.01" class="form-control" name="total" id="total" placeholder="Ingrese el total de la venta" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Agregar Venta</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
