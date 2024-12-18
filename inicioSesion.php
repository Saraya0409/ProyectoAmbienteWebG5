<?php
session_start(); // Iniciar la sesión para poder almacenar datos

include 'db.php'; // Incluir la conexión a la base de datos

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar la consulta para verificar las credenciales
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $username); // Se vincula el parámetro username

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($user && password_verify($password, $user['contrasena'])) {
        // Si las credenciales son correctas, se almacenan los datos en la sesión
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['username'] = $user['nombre_usuario'];

        // Redirigir al index o a una página protegida
        header("Location: index.php");
        exit;
    } else {
        // Si las credenciales son incorrectas, mostrar un mensaje de error
        $error_message = "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
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

