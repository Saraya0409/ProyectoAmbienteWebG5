<?php include 'layout/nav.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Productos</h2>

        <!-- Botón para abrir el formulario modal -->
        <li class="nav-item">
            <a href="#ProductoModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Producto</a>
        </li>

        <!-- Formulario Modal para agregar Producto -->
        <div class="modal fade" id="ProductoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="ProductoForm" method="POST" action="agregar_producto.php">
                            <div class="mb-3">
                                <label for="productoId" class="form-label">ID de Producto</label>
                                <input type="text" class="form-control" name="productoId" id="productoId" placeholder="Ingrese el ID del producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Ingrese la categoría del producto (ej. Medicamento, Gel, Glóbulos)" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreProducto" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" placeholder="Ingrese el nombre del producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripción del producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="ProductoPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="precio" id="ProductoPrecio" placeholder="Ingrese el precio del producto" required min="0" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="ProductoCantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="ProductoCantidad" placeholder="Ingrese la cantidad del producto" required min="1" step="1">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para modificar Producto -->
        <div class="modal fade" id="modificarProductoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modificarProductoForm" method="POST" action="modificar_producto.php">
                            <div class="mb-3">
                                <label for="editProductoId" class="form-label">ID de Producto</label>
                                <input type="text" class="form-control" name="editProductoId" id="editProductoId" required>
                            </div>
                            <div class="mb-3">
                                <label for="editCategoria" class="form-label">Categoría</label>
                                <input type="text" class="form-control" name="editCategoria" id="editCategoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNombreProducto" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="editNombreProducto" id="editNombreProducto" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDescripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="editDescripcion" id="editDescripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductoPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="editProductoPrecio" id="editProductoPrecio" required min="0" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="editProductoCantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="editProductoCantidad" id="editProductoCantidad" required min="1" step="1">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de Productos -->
        <h3 class="mt-5 mb-3 text-center">Lista de Productos</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID de Producto</th>
                    <th>Categoría</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="ProductoTableBody">
                <!-- Producto 1 -->
                <tr>
                    <td>001</td>
                    <td>Jarabe</td>
                    <td>Drosera Homaccord Gotas 30ml Heel</td>
                    <td>Gotas homeopáticas para diversas aplicaciones</td>
                    <td>₡9000</td>
                    <td>
                        <input type="number" value="2" readonly style="width: 60px; text-align: center; border: 1px solid #ced4da; border-radius: 4px; padding: 5px;">
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#modificarProductoModal">
                            <i class="bi bi-pencil-square"></i> Modificar
                        </button>
                        <button class="btn btn-danger btn-sm ms-2">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
                <!-- Producto 2 -->
                <tr>
                    <td>002</td>
                    <td>Glóbulos</td>
                    <td>Nux Vomica 9 CH Glóbulos 4g Boiron</td>
                    <td>Glóbulos para el tratamiento de dolencias digestivas</td>
                    <td>₡3000</td>
                    <td>
                        <input type="number" value="5" readonly style="width: 60px; text-align: center; border: 1px solid #ced4da; border-radius: 4px; padding: 5px;">
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#modificarProductoModal">
                            <i class="bi bi-pencil-square"></i> Modificar
                        </button>
                        <button class="btn btn-danger btn-sm ms-2">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
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
