<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Citas y Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <?php include 'layout/nav.php'; ?>

    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Citas </h2>

        <!-- Botón para abrir el formulario modal de agregar cita -->
        <li class="nav-item">
            <a href="#citaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Cita</a>
        </li>

        <!-- Formulario Modal para agregar cita -->
        <div class="modal fade" id="citaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="citaForm" method="POST" action="agregar_cita.php">
                            <div class="mb-3">
                                <label for="idCita" class="form-label">ID de Cita</label>
                                <input type="text" class="form-control" name="idCita" id="idCita" placeholder="Ingrese el ID de la cita" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaCita" class="form-label">Fecha</label>
                                <input type="datetime-local" class="form-control" name="fechaCita" id="fechaCita" required>
                            </div>
                            <div class="mb-3">
                                <label for="usuarioCita" class="form-label">Paciente</label>
                                <input type="text" class="form-control" name="usuarioCita" id="usuarioCita" placeholder="Ingrese el nombre del paciente" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cita</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para modificar cita -->
        <div class="modal fade" id="modificarCitaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modificarCitaForm" method="POST" action="modificar_cita.php">
                            <div class="mb-3">
                                <label for="editIdCita" class="form-label">ID de Cita</label>
                                <input type="text" class="form-control" name="editIdCita" id="editIdCita" required>
                            </div>
                            <div class="mb-3">
                                <label for="editFechaCita" class="form-label">Fecha</label>
                                <input type="datetime-local" class="form-control" name="editFechaCita" id="editFechaCita" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUsuarioCita" class="form-label">Paciente</label>
                                <input type="text" class="form-control" name="editUsuarioCita" id="editUsuarioCita" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla para mostrar citas -->
        <h3 class="mt-5 mb-3 text-center">Lista de Citas</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="citaTableBody">
                <tr>
                    <td>001</td>
                    <td>2024-11-20 10:00</td>
                    <td>Juan Pérez</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarCitaModal">Modificar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>2024-12-20 10:00</td>
                    <td>Maria Garcia</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarCitaModal">Modificar</button>
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

