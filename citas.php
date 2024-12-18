<?php include 'layout/nav.php'; ?>
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


    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Citas</h2>

        <!-- Botón para abrir el formulario modal de agregar cita -->
        <a  data-bs-target="#formularioModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Cita</a>
        
        <!-- Formulario Modal para agregar cita -->
        <div class="modal fade" id="formularioModal" tabindex="-1" aria-labelledby="formularioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formularioModalLabel">Agendar de Cita Médica</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formularioCitas">
                    
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" id="cedula" name="cedula" class="form-control" placeholder="Ingresa tu cédula">
                        <span id="error-cedula">La cédula es obligatoria.</span>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu nombre">
                        <span id="error-nombre">El nombre es obligatorio.</span>
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingresa tu teléfono">
                        <span id="error-telefono">El teléfono es obligatorio.</span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu correo electrónico">
                        <span id="error-email">El email es obligatorio.</span>
                    </div>
                    <div class="mb-3">
                        <label for="fechaCita" class="form-label">Fecha de cita</label>
                        <input type="date" id="fechaCita" name="fechaCita" class="form-control" placeholder="Selecciona la fecha de la cita">
                        <span id="error-fechaCita">La fecha de la cita es obligatoria.</span>
                    </div>
                    <div class="mb-3">
                        <label for="horaCita" class="form-label">Hora de la cita</label>
                        <select id="horaCita" name="horaCita" class="form-control">                            
                            <option value="08:00:00">08:00 AM</option>
                            <option value="10:00:00">10:00 AM</option>
                            <option value="11:00:00">11:00 AM</option>
                            <option value="14:00:00">02:00 PM</option>
                            <option value="16:00:00">04:00 PM</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="doctor" class="form-label">Doctor</label>
                        <select id="doctor" name="doctor" class="form-control">
                            <option value="1">Dr. Carlos Ramirez Mora</option></option>
                            <option value="2">Dr. Manuel Jimenez Sanchez</option>
                            <option value="3">Dr. Manuel Pereira Solis</option>
                        </select>
                      
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                        <button type="submit" class="btn btn-success">Enviar cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- Tabla para mostrar citas -->
        <h3 class="mt-5 mb-3 text-center">Lista de Citas</h3>
        <table class="table table-bordered text-center" id="listCita">
            <thead class="table-dark">
                <tr>
                    <th>ID Cita</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Doctor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>

</html>
