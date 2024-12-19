<?php
// Inicia sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['usuario_id']); 
$usuario_nombre = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : ''; 

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
   
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/ProyectoAmbienteWebG5/js/scripts.js"></script>
    <style>
        input.error, textarea.error {
        border-color: #e74c3c;
        }
        body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        }
    </style>
        
</head>
<!-- nav.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">
                <img src="\ProyectoAmbienteWebG5\logo.png" alt="Start Bootstrap"
                    style="height: auto; width: 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="factura.php">Facturas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="envio.php">Envios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="ventas.php">Ventas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="usuario.php">Usuarios</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="nav-link active" href="categoria.php">Categorias</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="nav-link active" href="producto.php">Productos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-success" style="background-color: #28a745; color: white; font-weight: bold; padding: 8px 16px; border-radius: 5px; margin-left: 10px; text-align: center;" data-bs-toggle="modal" data-bs-target="#formularioModal">
                            Agendar Cita
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="buscarCita.php" class="btn"
                            style="background-color: #28a745; color: white; font-weight: bold; padding: 8px 16px; border-radius: 5px; margin-left: 10px; text-align: center;">
                            Buscar Cita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="buscarFactura.php" class="btn"
                            style="background-color: #28a745; color: white; font-weight: bold; padding: 8px 16px; border-radius: 5px; margin-left: 10px; text-align: center;">
                            Buscar Factura
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <button class="btn btn-success" style="background-color: #28a745; color: white; font-weight: bold; padding: 8px 16px; border-radius: 5px; margin-left: 10px; text-align: center;" data-bs-toggle="modal" data-bs-target="#formularioModal">
                            Agendar Cita
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="buscarCita.php" class="btn"
                            style="background-color: #28a745; color: white; font-weight: bold; padding: 8px 16px; border-radius: 5px; margin-left: 10px; text-align: center;">
                            Buscar Cita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="buscarFactura.php" class="btn"
                            style="background-color: #28a745; color: white; font-weight: bold; padding: 8px 16px; border-radius: 5px; margin-left: 10px; text-align: center;">
                            Buscar Factura
                        </a>
                    </li>
                </ul>
                <?php endif; ?>


<div class="d-flex align-items-center">
    <li class="nav-item dropdown me-3" style="list-style-type: none; margin: 0; padding: 0;">
        <?php if ($isLoggedIn): ?>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $usuario_nombre; ?> <!-- Mostrar nombre de usuario -->
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="list-style-type: none; padding: 0; margin: 0;">
                <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
        <?php else: ?>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuario</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="list-style-type: none; padding: 0; margin: 0;">
                <li><a class="dropdown-item" href="inicioSesion.php">Iniciar Sesión</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Cerrar Sesión</a></li> <!-- Opción que no hace nada -->
            </ul>
        <?php endif; ?>
    </li>
</div>
                    <form class="d-flex">
                    <a href="carrito.php" class="btn" style="color: #2e2b27; border-color: #2e2b27;">
                        <i class="bi-cart-fill me-1" style="color: #2e2b27;"></i>
                        Carrito
                        <span id="cantidadCarrito" class="badge text-white ms-1 rounded-pill"
                            style="background-color: #2e2b27;">
                            <?php echo isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0; ?>
                        </span>

                    </a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Codigo para Agendar Citas-->
    <div class="modal fade" id="formularioModal" tabindex="-1" aria-labelledby="formularioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formularioModalLabel">Formulario de Cita Médica</h5>
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

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
</html>