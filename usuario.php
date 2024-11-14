<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include 'layout/nav.php'; ?>
    
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Usuarios</h2>

        <!-- Botón para abrir el formulario modal -->
        <li class="nav-item">
            <a href="#usuarioModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Usuario</a>
        </li>

        <!-- Formulario Modal para agregar usuario -->
        <div class="modal fade" id="usuarioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="usuarioForm" method="POST" action="agregar_usuario.php">
                            <div class="mb-3">
                                <label for="userId" class="form-label">ID</label>
                                <input type="text" class="form-control" name="userId" id="userId" placeholder="Ingrese el ID del usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreUsuario" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" placeholder="Ingrese el nombre del usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese la contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para modificar usuario -->
        <div class="modal fade" id="modificarUsuarioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modificarUsuarioForm" method="POST" action="modificar_usuario.php">
                            <div class="mb-3">
                                <label for="editUserId" class="form-label">ID</label>
                                <input type="text" class="form-control" name="editUserId" id="editUserId" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNombreUsuario" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="editNombreUsuario" id="editNombreUsuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="editContrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="editContrasena" id="editContrasena" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de usuarios -->
        <h3 class="mt-5 mb-3 text-center">Lista de Usuarios</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="usuarioTableBody">
                <!-- Ejemplo de dos usuarios -->
                <tr>
                    <td>001</td>
                    <td>Juan Pérez</td>
                    <td>********</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarUsuarioModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Maria García</td>
                    <td>********</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarUsuarioModal">Modificar</button>
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