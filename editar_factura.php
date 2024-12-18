<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Verificar si el parámetro 'editar' está presente en la URL
if (isset($_GET['editar'])) {
    $id_factura = $_GET['editar'];

    // Obtener los detalles de la factura a editar
    $stmt = $conn->prepare("SELECT * FROM factura WHERE id_factura = ?");
    $stmt->bind_param("i", $id_factura);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $factura = $resultado->fetch_assoc();
    $stmt->close();

    if (!$factura) {
        echo "<div class='alert alert-danger'>Factura no encontrada.</div>";
        exit;
    }

    // Procesar la actualización de la factura
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cedula = $_POST['cedulaFactura'];
        $monto = $_POST['montoFactura'];
        $tipo_pago = $_POST['tipoPago'];
        $productos = $_POST['productosFactura'];

        // Actualizar la factura
        $stmt = $conn->prepare("UPDATE factura SET cedula = ?, monto = ?, tipo_pago = ?, productos = ? WHERE id_factura = ?");
        $stmt->bind_param("sdssi", $cedula, $monto, $tipo_pago, $productos, $id_factura);

        if ($stmt->execute()) {
            // Redirigir a la página de facturas después de la actualización
            header("Location: factura.php");
            exit();  // Detener la ejecución después de la redirección
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar la factura: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}

$conn->close();  // Cerrar la conexión
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Editar Factura</h2>

        <!-- Formulario para editar la factura -->
        <form method="POST" action="editar_factura.php?editar=<?php echo $factura['id_factura']; ?>">
            <div class="mb-3">
                <label for="cedulaFactura" class="form-label">Cédula</label>
                <input type="text" class="form-control" name="cedulaFactura" id="cedulaFactura" value="<?php echo $factura['cedula']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="montoFactura" class="form-label">Monto</label>
                <input type="number" class="form-control" name="montoFactura" id="montoFactura" value="<?php echo $factura['monto']; ?>" required step="0.01">
            </div>
            <div class="mb-3">
                <label for="tipoPago" class="form-label">Tipo de Pago</label>
                <select class="form-control" name="tipoPago" id="tipoPago" required>
                    <option value="Efectivo" <?php echo $factura['tipo_pago'] == 'Efectivo' ? 'selected' : ''; ?>>Efectivo</option>
                    <option value="Tarjeta" <?php echo $factura['tipo_pago'] == 'Tarjeta' ? 'selected' : ''; ?>>Tarjeta</option>
                    <option value="Sinpe" <?php echo $factura['tipo_pago'] == 'Sinpe' ? 'selected' : ''; ?>>Sinpe</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="productosFactura" class="form-label">Productos</label>
                <textarea class="form-control" name="productosFactura" id="productosFactura" required><?php echo $factura['productos']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Actualizar Factura</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

