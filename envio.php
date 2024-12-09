<?php include 'layout/nav.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Envíos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
    
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Envíos</h2>

 

        

        <!-- Modal para modificar envío -->
        <div class="modal fade" id="modificarEnvioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Envío</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
