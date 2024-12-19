<?php
include 'db.php'; // Incluir la conexión a la base de datos

// Eliminar venta
if (isset($_GET['eliminar'])) {
    $id_venta = $_GET['eliminar'];

    // Eliminar la venta de la base de datos
    $stmt = $conn->prepare("DELETE FROM ventas WHERE id_venta = ?");
    $stmt->bind_param("i", $id_venta);

    if ($stmt->execute()) {
        // Redirigir para evitar reenvío de formulario al actualizar la página
        header("Location: ventas.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar la venta: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

// Obtener ventas
$sql_ventas = "SELECT id_venta, id_producto, cantidad, nombre_producto, id_factura, total FROM ventas";
$result_ventas = $conn->query($sql_ventas);

if ($result_ventas->num_rows > 0) {
    $ventas = [];
    while ($row = $result_ventas->fetch_assoc()) {
        $ventas[] = $row;
    }
} else {
    $ventas = [];
}

$conn->close();
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Ventas</h2>

        <!-- Botón para abrir el formulario modal -->
        <li class="nav-item">
            <a href="#VentaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Venta</a>
        </li>

        <!-- Formulario Modal para agregar Venta -->
        <div class="modal fade" id="VentaModal" tabindex="-1" aria-labelledby="VentaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="VentaModalLabel">Agregar Venta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="agregar_venta.php">
                            <div class="mb-3">
                                <label for="idProducto" class="form-label">ID del Producto</label>
                                <input type="number" class="form-control" name="idProducto" id="idProducto" placeholder="Ingrese el ID del producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Ingrese la cantidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" placeholder="Ingrese el nombre del producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="idFactura" class="form-label">ID de Factura</label>
                                <input type="number" class="form-control" name="idFactura" id="idFactura" placeholder="Ingrese el ID de la factura" required>
                            </div>
                            <div class="mb-3">
                                <label for="totalVenta" class="form-label">Total</label>
                                <input type="number" step="0.01" class="form-control" name="totalVenta" id="totalVenta" placeholder="Ingrese el monto total" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Venta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Ventas -->
        <h3 class="mt-5 mb-3 text-center">Lista de Ventas</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID de Venta</th>
                    <th>ID de Producto</th>
                    <th>Cantidad</th>
                    <th>Nombre del Producto</th>
                    <th>ID de Factura</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($ventas)) {
                    foreach ($ventas as $venta) {
                        echo "<tr>";
                        echo "<td>" . $venta['id_venta'] . "</td>";
                        echo "<td>" . $venta['id_producto'] . "</td>";
                        echo "<td>" . $venta['cantidad'] . "</td>";
                        echo "<td>" . $venta['nombre_producto'] . "</td>";
                        echo "<td>" . $venta['id_factura'] . "</td>";
                        echo "<td>" . $venta['total'] . "</td>";
                        echo "<td>
                                <a href='ventas.php?eliminar=" . $venta['id_venta'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No hay ventas disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
