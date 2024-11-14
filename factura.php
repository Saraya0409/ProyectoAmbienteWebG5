<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation-->
    <?php include 'layout/nav.php'; ?>

    <!-- Contenido principal -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Factura de Compra</h2>

        <!-- Botón para abrir el formulario modal de agregar factura -->
        <li class="nav-item">
            <a href="#facturaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Factura</a>
        </li>

        <!-- Formulario Modal para agregar factura -->
        <div class="modal fade" id="facturaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="facturaForm" method="POST" action="agregar_factura.php">
                            <div class="mb-3">
                                <label for="idFactura" class="form-label">ID de Factura</label>
                                <input type="text" class="form-control" name="idFactura" id="idFactura" placeholder="Ingrese el ID de la factura" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaFactura" class="form-label">Fecha</label>
                                <input type="datetime-local" class="form-control" name="fechaFactura" id="fechaFactura" required>
                            </div>
                            <div class="mb-3">
                                <label for="montoFactura" class="form-label">Monto</label>
                                <input type="number" class="form-control" name="montoFactura" id="montoFactura" placeholder="Ingrese el monto de la factura" required>
                            </div>
                            <div class="mb-3">
                                <label for="pacienteFactura" class="form-label">Paciente</label>
                                <input type="text" class="form-control" name="pacienteFactura" id="pacienteFactura" placeholder="Ingrese el nombre del paciente" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Factura</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para modificar factura -->
        <div class="modal fade" id="modificarFacturaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modificarFacturaForm" method="POST" action="modificar_factura.php">
                            <div class="mb-3">
                                <label for="editIdFactura" class="form-label">ID de Factura</label>
                                <input type="text" class="form-control" name="editIdFactura" id="editIdFactura" required>
                            </div>
                            <div class="mb-3">
                                <label for="editFechaFactura" class="form-label">Fecha</label>
                                <input type="datetime-local" class="form-control" name="editFechaFactura" id="editFechaFactura" required>
                            </div>
                            <div class="mb-3">
                                <label for="editMontoFactura" class="form-label">Monto</label>
                                <input type="number" class="form-control" name="editMontoFactura" id="editMontoFactura" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPacienteFactura" class="form-label">Paciente</label>
                                <input type="text" class="form-control" name="editPacienteFactura" id="editPacienteFactura" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla para mostrar facturas -->
        <h3 class="mt-5 mb-3 text-center">Lista de Facturas</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Paciente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="facturaTableBody">
                <tr>
                    <td>001</td>
                    <td>2024-11-20 10:00</td>
                    <td>15000</td>
                    <td>Juan Pérez</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarFacturaModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>2024-12-20 10:00</td>
                    <td>15000</td>
                    <td>Maria Garcia</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarFacturaModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
