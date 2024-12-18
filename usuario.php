<?php
include 'db.php';  // Incluir la conexión a la base de datos

class Usuario {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    // Método para obtener todos los usuarios
    public function obtenerUsuarios() {
        $sql = "SELECT id_usuario, nombre_usuario FROM usuario"; // Consulta SQL para obtener usuarios
        $result = $this->conn->query($sql);

        // Si se obtienen resultados, devolverlos
        if ($result->num_rows > 0) {
            $usuarios = [];
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row; // Almacenar cada usuario en el array
            }
            return $usuarios;
        } else {
            return [];  // Retornar un array vacío si no hay usuarios
        }
    }
}

// Crear una instancia de la clase Usuario
$usuario = new Usuario($conn);

// Obtener los usuarios registrados
$usuarios = $usuario->obtenerUsuarios();
?>
<?php include 'layout/nav.php'; // Incluir la barra de navegación ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<section class="container my-5">
    <h2 class="mb-4 text-center">Lista de Usuarios Registrados</h2>

    <!-- Tabla con los usuarios -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si hay usuarios
            if (!empty($usuarios)) {
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . $usuario['id_usuario'] . "</td>";
                    echo "<td>" . $usuario['nombre_usuario'] . "</td>";
                    echo "<td>
                            <a href='editar_usuario.php?editar=" . $usuario['id_usuario'] . "' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='eliminar_usuario.php?eliminar=" . $usuario['id_usuario'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No hay usuarios registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<!-- Footer -->
<?php include 'layout/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
