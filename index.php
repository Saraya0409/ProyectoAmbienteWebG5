<?php include 'layout/nav.php'; 
include 'DB.php';  // Incluir la conexión a la base de datos


// Captura valores de búsqueda y filtro
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
                        <img class="card-img-top" src="<?php echo '/'.htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>" />
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
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="carrito.php">Agregar Al Carrito</a></div>
                        </div>
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
    
</body>

</html>
