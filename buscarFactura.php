<?php
include 'db.php'; // Conexión a la base de datos
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Factura</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <?php include 'layout/nav.php'; ?>

    <!-- Contenido principal -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Buscar Factura</h2>
        <form action="buscarFactura.php" method="GET">
            <div class="mb-3">
                <label for="numeroFactura" class="form-label">Número de Factura</label>
                <input type="text" class="form-control" id="numeroFactura" name="numeroFactura" placeholder="Ingrese el número de factura">
            </div>
            <div class="mb-3">
                <label for="cedulaCliente" class="form-label">Cédula del Cliente</label>
                <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su número de cédula">
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar Factura</button>
        </form>

        <!-- Resultados de búsqueda -->
        <?php
        if (isset($_GET['numeroFactura']) || isset($_GET['cedula'])) {
            $numeroFactura = $_GET['numeroFactura'] ?? null;
            $cedula = $_GET['cedula'] ?? null;

            // Construye la consulta dinámica
            $query = "SELECT * FROM factura WHERE 1=1";
            $params = [];
            if (!empty($numeroFactura)) {
                $query .= " AND id_factura = ?";
                $params[] = $numeroFactura;
            }
            if (!empty($cedula)) {
                $query .= " AND cedula_cliente = ?";
                $params[] = $cedula;
            }

            $stmt = $conn->prepare($query);
            if (!empty($params)) {
                $stmt->bind_param(str_repeat('s', count($params)), ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h3 class='mt-5'>Resultados de la búsqueda:</h3>";
                echo "<table class='table table-bordered mt-3'>";
                echo "<thead class='table-dark'>";
                echo "<tr>";
                echo "<th>ID Factura</th>";
                echo "<th>Cédula Cliente</th>";
                echo "<th>Nombre Cliente</th>";
                echo "<th>Teléfono</th>";
                echo "<th>Total</th>";
                echo "<th>Método de Pago</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_factura']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cedula_cliente']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre_cliente']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                    echo "<td>₡" . number_format($row['total'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($row['metodo_pago']) . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p class='text-center mt-5'>No se encontraron resultados para los criterios proporcionados.</p>";
            }

            $stmt->close();
        }
        ?>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
