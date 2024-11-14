<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'layout/nav.php'; ?>
    
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Categorías</h2>

        <li class="nav-item">
            <a href="#categoriaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Categoría</a>
        </li>

        <div class="modal fade" id="categoriaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="categoriaForm" method="POST" action="agregar_categoria.php">
                            <div class="mb-3">
                                <label for="categoriaId" class="form-label">ID</label>
                                <input type="text" class="form-control" name="categoriaId" id="categoriaId" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreCategoria" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreCategoria" id="nombreCategoria" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Categoría</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modificarCategoriaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modificarCategoriaForm" method="POST" action="modificar_categoria.php">
                            <div class="mb-3">
                                <label for="editCategoriaId" class="form-label">ID</label>
                                <input type="text" class="form-control" name="editCategoriaId" id="editCategoriaId" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNombreCategoria" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="editNombreCategoria" id="editNombreCategoria" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5 mb-3 text-center">Lista de Categorías</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="categoriaTableBody">
                <tr>
                    <td>001</td>
                    <td>Jarabe</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarCategoriaModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Glóbulos</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarCategoriaModal">Modificar</button>
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
