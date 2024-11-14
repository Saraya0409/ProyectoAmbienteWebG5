<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include 'layout/nav.php'; ?>
    
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Categorias</h2>

        <!-- Botón para abrir el formulario modal -->
        <li class="nav-item">
            <a href="#CategoriaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Categoria</a>
        </li>

        <!-- Formulario Modal para agregar Categoria -->
        <div class="modal fade" id="CategoriaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="CategoriaForm" method="POST" action="agregar_Categoria.php">
                            <div class="mb-3">
                                <label for="categoriaId" class="form-label">ID</label>
                                <input type="text" class="form-control" name="categoriaId" id="categoriaId" placeholder="Ingrese el ID del Categoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreCategoria" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreCategoria" id="nombreCategoria" placeholder="Ingrese el nombre del Categoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese descripcion de la categoria" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Categoria</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para modificar Categoria -->
        <div class="modal fade" id="modificarCategoriaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modificarCategoriaForm" method="POST" action="modificar_Categoria.php">
                            <div class="mb-3">
                                <label for="editcategoriaId" class="form-label">ID</label>
                                <input type="text" class="form-control" name="editcategoriaId" id="editcategoriaId" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNombreCategoria" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="editNombreCategoria" id="editNombreCategoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="editdescripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="editdescripcion" id="editdescripcion" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de Categorias -->
        <h3 class="mt-5 mb-3 text-center">Lista de Categorias</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="CategoriaTableBody">
                <!-- Ejemplo de dos Categorias -->
                <td>001</td>
                    <td>Medicamentos Jarabe</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="text" value="Productos de jarabes" class="descripcion-categoria">
                    </td>        
                    <td>        
                            <button class="btn btn-primary btn-sm ms-2 actualizar-btn">
                                <i class="bi bi-arrow-repeat"></i> Actualizar
                            </button>
                            <button class="btn btn-danger btn-sm ms-2 eliminar-btn">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </div>
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