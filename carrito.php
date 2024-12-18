<?php
session_start();

    // Inicializar el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Lógica para agregar un producto al carrito
    if (isset($_POST['agregar_carrito'])) {
        $id_producto = $_POST['id_producto'];
        $nombre_producto = $_POST['nombre_producto'];
        $precio = $_POST['precio'];

        // Si el producto ya está en el carrito, aumenta la cantidad
        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += 1;
        } else {
            // Si no está, agrega el producto al carrito
            $_SESSION['carrito'][$id_producto] = [
                'nombre' => $nombre_producto,
                'precio' => $precio,
                'cantidad' => 1,
            ];
        }

        // Calcula la cantidad total de productos en el carrito
        $totalCantidad = array_sum(array_column($_SESSION['carrito'], 'cantidad'));

        // Devuelve la cantidad total como respuesta en formato JSON
        echo json_encode(['totalCantidad' => $totalCantidad]);
        exit();
    }

    // Lógica para eliminar un producto del carrito
    if (isset($_POST['eliminar_carrito'])) {
        $id_producto = $_POST['id_producto'];
        unset($_SESSION['carrito'][$id_producto]);
    }

    // Calcular el total del carrito
    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'layout/nav.php'; ?>
    <div class="container my-5">
        <h2 class="fw-bolder mb-4">Tu Carrito</h2>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['carrito'])): ?>
                    <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td>₡<?php echo number_format($producto['precio'], 2); ?></td>
                            <td>₡<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                            <td>
                                <form method="POST" action="carrito.php">
                                    <input type="hidden" name="id_producto" value="<?php echo $id; ?>">
                                    <button type="submit" name="eliminar_carrito" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">El carrito está vacío.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td class="fw-bold">₡<?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-end">
            <a href="formEnvio.php" class="btn btn-success btn-lg me-2">Envío a Casa</a>
            <a href="pagoLocal.php" class="btn btn-success btn-lg">Pago en Local</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
