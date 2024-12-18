<?php
include 'db.php'; // Incluir la conexión a la base de datos

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST['nombreUsuario'];
    $contrasena = $_POST['contrasena'];

    // Encriptar la contraseña antes de guardarla
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar el nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuario (nombre_usuario, contrasena) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre_usuario, $contrasena_encriptada);

    // Ejecutar la consulta e insertar el usuario
    if ($stmt->execute()) {
        // Redireccionar al archivo principal (usuario.php) después de la inserción exitosa
        header('Location: usuario.php');
        exit();
        echo "<div class='alert alert-success'>Usuario agregado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al agregar el usuario: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
?>
