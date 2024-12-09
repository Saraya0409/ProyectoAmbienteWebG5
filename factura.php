<?php include 'layout/nav.php'; ?>
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
    

    <!-- Contenido principal -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Factura de Compra</h2>


        <!-- Modal para modificar factura -->
        <div class="modal fade" id="modificarFacturaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                            <div class="mb-3">
                                <label for="editCedulaFactura" class="form-label">Cédula</label>
                                <input type="text" class="form-control" name="editCedulaFactura" id="editCedulaFactura" required>
                            </div> 
                            <div class="mb-3">
                                <label for="editTipoPago" class="form-label">Tipo de Pago</label>
                                <select class="form-control" name="editTipoPago" id="editTipoPago" required>
                                    <option value="Local">Efectivo</option>
                                    <option value="Envio">Tarjeta</option>
                                    <option value="Envio">Sinpe</option>
                                </select>
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
                    <th>Cédula</th>
                    <th>Monto</th>
                    <th>Tipo de Pago</th>
                    <th>Productos Comprados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="facturaTableBody">
                <tr>
                    <td>001</td>
                    <td>101010101</td>
                    <td>9000</td>
                    <td>Tarjeta</td>
                    <td>Nux Vomica 9 CH Glóbulos 4g Boiron: 3</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarFacturaModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>202020202</td>
                    <td>12000</td>
                    <td>Efectivo</td>
                    <td>Nux Vomica 9 CH Glóbulos 4g Boiron: 4</td>
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

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
