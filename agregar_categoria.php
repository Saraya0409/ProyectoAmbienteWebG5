<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Procesar la solicitud de agregar una nueva categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombreCategoria'];

    // Insertar la categoría en la base de datos
    $stmt = $conn->prepare("INSERT INTO categoria (nombre) VALUES (?)");
    $stmt->bind_param("s", $nombre);

    if ($stmt->execute()) {
        // Redireccionar a la página de categorías después de la inserción exitosa
        header('Location: categoria.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al agregar la categoría: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();  // Cerrar la conexión
?>

