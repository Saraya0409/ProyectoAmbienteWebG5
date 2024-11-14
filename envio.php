<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Envíos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'layout/nav.php'; ?>
    
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Envíos</h2>

        <!-- Botón para abrir el formulario modal de agregar envío -->
        <li class="nav-item">
            <a href="#envioModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Envío</a>
        </li>

        <!-- Formulario Modal para agregar envío -->
        <div class="modal fade" id="envioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Envío</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="envioForm" method="POST" action="agregar_envio.php">
                            <div class="mb-3">
                                <label for="envioId" class="form-label">ID Envío</label>
                                <input type="text" class="form-control" name="envioId" id="envioId" required>
                            </div>
                            <div class="mb-3">
                                <label for="facturaId" class="form-label">ID Factura</label>
                                <input type="text" class="form-control" name="facturaId" id="facturaId" required>
                            </div>
                            <div class="mb-3">
                                <label for="cedulaEnvio" class="form-label">Cédula</label>
                                <input type="text" class="form-control" name="cedulaEnvio" id="cedulaEnvio" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreEnvio" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreEnvio" id="nombreEnvio" required>
                            </div>
                            <div class="mb-3">
                                <label for="direccionEnvio" class="form-label">Dirección</label>
                                <textarea class="form-control" name="direccionEnvio" id="direccionEnvio" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Envío</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para modificar envío -->
        <div class="modal fade" id="modificarEnvioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Envío</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modificarEnvioForm" method="POST" action="modificar_envio.php">
                            <div class="mb-3">
                                <label for="editEnvioId" class="form-label">ID Envío</label>
                                <input type="text" class="form-control" name="editEnvioId" id="editEnvioId" required>
                            </div>
                            <div class="mb-3">
                                <label for="editFacturaId" class="form-label">ID Factura</label>
                                <input type="text" class="form-control" name="editFacturaId" id="editFacturaId" required>
                            </div>
                            <div class="mb-3">
                                <label for="editCedulaEnvio" class="form-label">Cédula</label>
                                <input type="text" class="form-control" name="editCedulaEnvio" id="editCedulaEnvio" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNombreEnvio" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="editNombreEnvio" id="editNombreEnvio" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDireccionEnvio" class="form-label">Dirección</label>
                                <textarea class="form-control" name="editDireccionEnvio" id="editDireccionEnvio" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla para mostrar envíos -->
        <h3 class="mt-5 mb-3 text-center">Lista de Envíos</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Envío</th>
                    <th>ID Factura</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="envioTableBody">
                <tr>
                    <td>001</td>
                    <td>001</td>
                    <td>101010101</td>
                    <td>Juan Pérez</td>
                    <td>Heredia, Heredia</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarEnvioModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>002</td>
                    <td>202020202</td>
                    <td>María González</td>
                    <td>Desparados, Alajuela</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarEnvioModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    
    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
