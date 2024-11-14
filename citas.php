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
        <h2 class="mb-4 text-center">Administrar Citas</h2>

        <!-- Botón para abrir el formulario modal de agregar cita -->
        <a href="#citaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Cita</a>

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
                                <label for="cedulaPaciente" class="form-label">Cédula del Paciente</label>
                                <input type="text" class="form-control" name="cedulaPaciente" id="cedulaPaciente" placeholder="Ingrese la cédula del paciente" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreCita" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreCita" id="nombreCita" placeholder="Ingrese el nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="correoCita" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="correoCita" id="correoCita" placeholder="Ingrese el correo" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefonoCita" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefonoCita" id="telefonoCita" placeholder="Ingrese el teléfono" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaCita" class="form-label">Fecha</label>
                                <input type="date" class="form-control" name="fechaCita" id="fechaCita" required>
                            </div>
                            <div class="mb-3">
                                <label for="horaCita" class="form-label">Hora</label>
                                <input type="time" class="form-control" name="horaCita" id="horaCita" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Cita</button>
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
                    <th>ID Cita</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="citaTableBody">
                <!-- Ejemplo de datos de prueba -->
                <tr>
                    <td>001</td>
                    <td>123456789</td>
                    <td>Juan Pérez</td>
                    <td>juan.perez@gmail.com</td>
                    <td>12345678</td>
                    <td>2024-11-20</td>
                    <td>10:00</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#citaModal">Modificar</button>
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
