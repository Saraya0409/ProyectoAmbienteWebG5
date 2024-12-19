<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Verificar si el parámetro 'eliminar' está presente en la URL
if (isset($_GET['eliminar'])) {
    $id_usuario = $_GET['eliminar'];

    // Preparar la consulta para eliminar el usuario
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

$conn->close();  // Cerrar la conexión
?>
