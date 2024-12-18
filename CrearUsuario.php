<?php
// Incluir la conexión a la base de datos
include 'db.php';

// Verificar que los datos se envíen mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar que el nombre de usuario no esté vacío
    if (!empty($username) && !empty($password)) {
        // Preparar la consulta para verificar si el nombre de usuario ya existe
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si el nombre de usuario ya existe
        if ($result->num_rows > 0) {
            echo "El nombre de usuario ya está registrado.";
        } else {
            // Si no existe, crear el nuevo usuario
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Se utiliza un hash para la contraseña
            $stmt = $conn->prepare("INSERT INTO usuario (nombre_usuario, contrasena) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Usuario creado exitosamente.";
            } else {
                echo "Error al crear el usuario: " . $stmt->error;
            }
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }

    $conn->close();
} else {
    echo "Acción no permitida.";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - Farmacia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="/ProyectoAmbienteWebG5/logo.png" alt="Logo" style="height: auto; width: 100px;">
            </a>
        </div>
    </nav>

    <!-- Formulario de Crear Usuario -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Crear Usuario</h2>
                <form method="POST" action="agregar_usuario.php">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombreUsuario" required>  <!-- Asegúrate de que sea 'nombreUsuario' -->
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </div>
            </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
