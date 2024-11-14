<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
       <!-- Navigation-->
       <?php include 'layout/nav.php'; ?>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Productos</h2>

        <!-- Botón para abrir el formulario modal -->
        <button class="btn btn-primary mb-4" onclick="abrirModal()">Agregar Producto</button>

        <!-- Formulario Modal -->
        <div class="modal" tabindex="-1" id="productoModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Producto</h5>
                        <button type="button" class="btn-close" onclick="cerrarModal()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="productoForm">
                            <div class="mb-3">
                                <label for="categoriaId" class="form-label">ID de Categoría</label>
                                <input type="text" class="form-control" id="categoriaId" placeholder="Ingrese el ID de la categoría">
                            </div>
                            <div class="mb-3">
                                <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombreProducto" placeholder="Ingrese el nombre del producto">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripción del producto">
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="precio" placeholder="Ingrese el precio del producto">
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" placeholder="Ingrese la cantidad del producto">
                            </div>
                            <button type="button" class="btn btn-primary w-100" onclick="guardarProducto()">Guardar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de productos -->
        <h3 class="mt-5 mb-3 text-center">Lista de Productos</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Categoría</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody id="productoTableBody">
                <tr>
                    <td colspan="5" class="text-center">No hay productos disponibles</td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function abrirModal() {
            document.getElementById('productoForm').reset();  // Limpiar el formulario
            document.getElementById('productoModal').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('productoModal').style.display = 'none';
        }

        function guardarProducto() {
            const categoriaId = document.getElementById('categoriaId').value;
            const nombreProducto = document.getElementById('nombreProducto').value;
            const descripcion = document.getElementById('descripcion').value;
            const precio = document.getElementById('precio').value;
            const cantidad = document.getElementById('cantidad').value;

            if (categoriaId && nombreProducto && descripcion && precio && cantidad) {
                const tbody = document.getElementById('productoTableBody');
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${categoriaId}</td>
                    <td>${nombreProducto}</td>
                    <td>${descripcion}</td>
                    <td>${precio}</td>
                    <td>${cantidad}</td>
                `;
                tbody.appendChild(row);
                cerrarModal();
            } else {
                alert('Por favor, complete todos los campos');
            }
        }
    </script>
</body>
</html>