<?php
include 'db.php'; // Incluir la conexión a la base de datos

// Eliminar factura
if (isset($_GET['eliminar'])) {
    $id_factura = $_GET['eliminar'];

    // Eliminar la factura de la base de datos
    $stmt = $conn->prepare("DELETE FROM factura WHERE id_factura = ?");
    $stmt->bind_param("i", $id_factura);

    if ($stmt->execute()) {
        // Redirigir para evitar reenvío de formulario al actualizar la página
        header("Location: factura.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar la factura: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

// Obtener facturas
$sql_facturas = "SELECT id_factura, cedula_cliente, nombre_cliente, telefono, total, metodo_pago FROM factura";
$result_facturas = $conn->query($sql_facturas);

if ($result_facturas->num_rows > 0) {
    $facturas = [];
    while ($row = $result_facturas->fetch_assoc()) {
        $facturas[] = $row;
    }
} else {
    $facturas = [];
}

$conn->close();
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Facturas</h2>

        <!-- Botón para abrir el formulario modal -->
        <li class="nav-item">
            <a href="#FacturaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Factura</a>
        </li>

        <!-- Formulario Modal para agregar Factura -->
        <div class="modal fade" id="FacturaModal" tabindex="-1" aria-labelledby="FacturaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="FacturaModalLabel">Agregar Factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese el teléfono" required>
                            </div>
                            <div class="mb-3">
                                <label for="totalFactura" class="form-label">Total</label>
                                <input type="number" step="0.01" class="form-control" name="totalFactura" id="totalFactura" placeholder="Ingrese el monto total" required>
                            </div>
                            <div class="mb-3">
                                <label for="metodoPago" class="form-label">Método de Pago</label>
                                <select class="form-control" name="metodoPago" id="metodoPago" required>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Sinpe">Sinpe</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Factura</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Facturas -->
        <h3 class="mt-5 mb-3 text-center">Lista de Facturas</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID de Factura</th>
                    <th>Cédula del Cliente</th>
                    <th>Nombre del Cliente</th>
                    <th>Teléfono</th>
                    <th>Total</th>
                    <th>Método de Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($facturas)) {
                    foreach ($facturas as $factura) {
                        echo "<tr>";
                        echo "<td>" . $factura['id_factura'] . "</td>";
                        echo "<td>" . $factura['cedula_cliente'] . "</td>";
                        echo "<td>" . $factura['nombre_cliente'] . "</td>";
                        echo "<td>" . $factura['telefono'] . "</td>";
                        echo "<td>" . $factura['total'] . "</td>";
                        echo "<td>" . $factura['metodo_pago'] . "</td>";
                        echo "<td>
                                <a href='editar_factura.php?editar=" . $factura['id_factura'] . "' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='factura.php?eliminar=" . $factura['id_factura'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No hay facturas disponibles.</td></tr>";
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

