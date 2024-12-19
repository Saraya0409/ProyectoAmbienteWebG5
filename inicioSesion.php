<?php
// Incluir la conexión a la base de datos
include 'db.php';

// Iniciar la sesión al principio
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si los campos existen y no están vacíos
    if (isset($_POST['nombre_usuario']) && isset($_POST['contrasena']) && !empty($_POST['nombre_usuario']) && !empty($_POST['contrasena'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $contrasena = $_POST['contrasena'];

        // Preparar la consulta para verificar si el usuario existe
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si el usuario existe
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($contrasena, $usuario['contrasena'])) {
                // Si la contraseña es correcta, iniciar la sesión
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_usuario']; // Guardar el nombre de usuario en la sesión
                header('Location: index.php'); // Redirigir al index
                exit();
            } else {
                echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>El usuario no existe.</div>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<div class='alert alert-danger'>Por favor, ingresa ambos campos.</div>";
    }
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
                <img src="logo.png" alt="Logo" style="height: auto; width: 100px;">
            </a>
        </div>
    </nav>

    <!-- Formulario de Inicio de Sesión -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
                <form method="POST" action="inicioSesion.php">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
                <!-- Botón para redirigir a la página de crear usuario -->
                <div class="mt-4 text-center">
                    <a href="crear_usuario.php" class="btn btn-secondary">Crear Usuario</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


