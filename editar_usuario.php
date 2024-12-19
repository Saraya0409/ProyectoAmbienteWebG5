<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Verificar si el parámetro 'editar' está presente en la URL para editar
if (isset($_GET['editar'])) {
    $id_usuario = $_GET['editar'];

    // Obtener los detalles del usuario a editar
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $stmt->close();

    if (!$usuario) {
        echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
        exit;
    }

    // Procesar la actualización del usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_usuario'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

        // Actualizar el usuario
        $stmt = $conn->prepare("UPDATE usuario SET nombre_usuario = ?, contrasena = ? WHERE id_usuario = ?");
        $stmt->bind_param("ssi", $nombre_usuario, $contrasena, $id_usuario);

        if ($stmt->execute()) {
            // Redirigir a la lista de usuarios después de la actualización
            header("Location: usuario.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar el usuario: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

    // Procesar la eliminación del usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_usuario'])) {
        // Eliminar el usuario
        $stmt = $conn->prepare("DELETE FROM usuario WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            // Redirigir a la lista de usuarios después de la eliminación
            header("Location: usuario.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar el usuario: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}

$conn->close();  // Cerrar la conexión
?>

<!-- HTML para el formulario de edición y eliminación -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar o Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Editar o Eliminar Usuario</h2>

        <!-- Formulario para editar el usuario -->
        <form method="POST" action="editar_usuario.php?editar=<?php echo $usuario['id_usuario']; ?>">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" value="<?php echo $usuario['nombre_usuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" required>
            </div>
            <button type="submit" name="editar_usuario" class="btn btn-primary w-100">Actualizar Usuario</button>
        </form>

        <!-- Formulario para eliminar el usuario -->
        <form method="POST" action="editar_usuario.php?editar=<?php echo $usuario['id_usuario']; ?>" class="mt-3">
            <button type="submit" name="eliminar_usuario" class="btn btn-danger w-100" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar Usuario</button>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

