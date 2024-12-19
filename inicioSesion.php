<?php
include 'db.php'; // Incluir la conexión a la base de datos

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Preparar la consulta para obtener el usuario de la base de datos
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar si la contraseña es correcta
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Iniciar sesión
            session_start();
            $_SESSION['usuario_id'] = $usuario['id_usuario']; // Guardar el ID del usuario en la sesión

            // Redirigir al index.php después de iniciar sesión correctamente
            header('Location: index.php');
            exit(); // Terminar la ejecución del script
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Farmacia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="\ProyectoAmbienteWebG5\logo.png" alt="Start Bootstrap" style="height: auto; width: 100px;">
            </a>
        </div>
    </nav>

    <!-- Formulario de Inicio de Sesión -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
                <!-- Botón para redirigir a la página de crear usuario -->
                <div class="mt-4 text-center">
                    <a href="CrearUsuario.php" class="btn btn-secondary">Crear Usuario</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

