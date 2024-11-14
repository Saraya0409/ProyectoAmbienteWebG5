<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
       <!-- Navigation-->
       <?php include 'layout/nav.php'; ?>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Categorías de Productos</h2>

        <!-- Botón para abrir el formulario modal -->
        <button class="btn btn-primary mb-4" onclick="abrirModal()">Agregar Categoría</button>

        <!-- Formulario Modal -->
        <div class="modal" tabindex="-1" id="categoriaModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Categoría</h5>
                        <button type="button" class="btn-close" onclick="cerrarModal()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="categoriaForm">
                            <div class="mb-3">
                                <label for="categoriaId" class="form-label">ID de Categoría</label>
                                <input type="text" class="form-control" id="categoriaId" placeholder="Ingrese el ID de la categoría">
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la Categoría</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre de la categoría">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripción de la categoría">
                            </div>
                            <button type="button" class="btn btn-primary w-100" onclick="guardarCategoria()">Guardar Categoría</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de categorías -->
        <h3 class="mt-5 mb-3 text-center">Lista de Categorías</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody id="categoriaTableBody">
            <tr>
                    <td>001</td>
                    <td>Medicamentos Jarabe</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="text" value="Productos de jarabes" class="descripcion-categoria" style="width: 100%; border: 1px solid #ced4da; border-radius: 4px; padding: 5px;">
                            <button class="btn btn-primary btn-sm ms-2 actualizar-btn">
                                <i class="bi bi-arrow-repeat"></i> Actualizar
                            </button>
                            <button class="btn btn-danger btn-sm ms-2 eliminar-btn">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Medicamentos Pastilla</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="text" value="Productos de consumo oral en pastilla" class="descripcion-categoria" style="width: 100%; border: 1px solid #ced4da; border-radius: 4px; padding: 5px;">
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
    <script>
        function abrirModal() {
            document.getElementById('categoriaForm').reset();  // Limpiar el formulario
            document.getElementById('categoriaModal').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('categoriaModal').style.display = 'none';
        }

        function guardarCategoria() {
            const id = document.getElementById('categoriaId').value;
            const nombre = document.getElementById('nombre').value;
            const descripcion = document.getElementById('descripcion').value;

            if (id && nombre && descripcion) {
                const tbody = document.getElementById('categoriaTableBody');
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${id}</td>
                    <td>${nombre}</td>
                    <td>${descripcion}</td>
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