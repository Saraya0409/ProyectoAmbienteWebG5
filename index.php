<?php
session_start(); // Inicia la sesión al principio del archivo
include 'db.php';

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Procesar solicitudes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verificar_inventario'])) {
    header('Content-Type: application/json');

    $idProducto = (int)$_POST['id_producto'];

    if (!isset($_SESSION['inventario_temporal'])) {
        $_SESSION['inventario_temporal'] = [];
    }

    if (!isset($_SESSION['inventario_temporal'][$idProducto])) {
        $stmt = $conn->prepare("SELECT cantidad FROM producto WHERE id_producto = ?");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
            $_SESSION['inventario_temporal'][$idProducto] = $producto['cantidad'];
        } else {
            echo json_encode(['disponible' => false, 'mensaje' => 'Producto no encontrado']);
            exit();
        }
    }

    $cantidadDisponible = $_SESSION['inventario_temporal'][$idProducto];

    if ($cantidadDisponible > 0) {
        $_SESSION['inventario_temporal'][$idProducto]--;
        echo json_encode(['disponible' => true, 'cantidad_disponible' => $cantidadDisponible - 1]);
    } else {
        echo json_encode(['disponible' => false, 'cantidad_disponible' => 0, 'mensaje' => 'No hay suficiente inventario']);
    }

    exit();
}

include 'layout/nav.php';

// Captura valores de búsqueda y filtro (GET)
$busqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '';
$filtroCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Consulta para cargar todas las categorías
$sqlCategorias = "SELECT * FROM categoria";
$resultCategorias = $conn->query($sqlCategorias);

// Consulta dinámica para los productos
$sql = "SELECT * FROM producto";
$conditions = [];
if (!empty($busqueda)) {
    $conditions[] = "nombre LIKE '%" . $conn->real_escape_string($busqueda) . "%'";
}
if (!empty($filtroCategoria)) {
    $conditions[] = "id_categoria = " . (int)$filtroCategoria;
}
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
    
<body>



    <!-- Search and Filter Section -->
    <section class="py-3">
        <div class="container">
            <form method="GET" action="index.php">
                <div class="row">
                    <!-- Search Bar -->
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre de producto" value="<?php echo htmlspecialchars($busqueda); ?>" />
                            <button class="btn btn-outline-dark" type="submit">Buscar</button>
                        </div>
                    </div>
                    <!-- Category Filter -->
                    <div class="col-md-4">
                        <select class="form-select" name="categoria" onchange="this.form.submit()">
                            <option value="">Filtrar por categoría</option>
                            <?php while ($cat = $resultCategorias->fetch_assoc()): ?>
                                <option value="<?php echo $cat['id_categoria']; ?>" 
                                    <?php if ($filtroCategoria == $cat['id_categoria']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($cat['nombre']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>" />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo htmlspecialchars($row['nombre']); ?></h5>
                                <h6 style="color: #6c757d;"><?php echo htmlspecialchars($row['descripcion']); ?></h6>
                                <!-- Product price-->
                                ₡<?php echo number_format($row['precio'], 2); ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-outline-dark mt-auto agregar-carrito" 
                                data-id="<?php echo $row['id_producto']; ?>" 
                                data-nombre="<?php echo htmlspecialchars($row['nombre']); ?>" 
                                data-precio="<?php echo $row['precio']; ?>">
                                Agregar Al Carrito
                            </button>
                        </div>
                    </div>>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php include 'layout/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Script para manejar el carrito
        $(document).on("click", ".agregar-carrito", function (e) {
            e.preventDefault();
            let idProducto = $(this).data("id");
            let nombreProducto = $(this).data("nombre");
            let precioProducto = $(this).data("precio");

            // Verifica la cantidad disponible antes de agregar
            $.ajax({
                url: "index.php",
                type: "POST",
                data: {
                    verificar_inventario: true,
                    id_producto: idProducto,
                },
                success: function (response) {
                    const inventarioData = typeof response === "object" ? response : JSON.parse(response);
                    if (inventarioData.disponible) {
                        $.ajax({
                            url: "carrito.php",
                            type: "POST",
                            data: {
                                agregar_carrito: true,
                                id_producto: idProducto,
                                nombre_producto: nombreProducto,
                                precio: precioProducto,
                            },
                            success: function (response) {
                                const carritoData = typeof response === "object" ? response : JSON.parse(response);
                                $("#cantidadCarrito").text(carritoData.totalCantidad);
                                alert("Producto agregado al carrito!");
                            },
                            error: function () {
                                alert("Error al agregar el producto al carrito.");
                            },
                        });
                    } else {
                        alert("El producto '" + nombreProducto + "' no tiene suficiente inventario disponible.");
                    }
                },
                error: function () {
                    alert("Error al verificar el inventario.");
                },
            });
        });

        $(document).on("click", ".eliminar-carrito", function (e) {
            e.preventDefault();
            let idProducto = $(this).data("id");

            $.ajax({
                url: "carrito.php",
                type: "POST",
                data: {
                    eliminar_carrito: true,
                    id_producto: idProducto,
                },
                success: function (response) {
                    const carritoData = typeof response === "object" ? response : JSON.parse(response);
                    $("#cantidadCarrito").text(carritoData.totalCantidad);
                    alert("Producto eliminado del carrito!");
                    location.reload();
                },
                error: function () {
                    alert("Error al eliminar el producto del carrito.");
                },
            });
        });
    </script>

</body>
</html>
