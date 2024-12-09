<?php include 'layout/nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

      <!-- Contenido principal -->
      <section class="container my-5">
        <h2 class="mb-4 text-center">Buscar Factura</h2>
        <form action="buscarFactura.php" method="GET">
            <div class="mb-3">
                <label for="numeroFactura" class="form-label">Número de Factura</label>
                <input type="text" class="form-control" id="numeroFactura" name="numeroFactura" placeholder="Ingrese el número de factura">
            </div>
            <div class="mb-3">
                <label for="cedulaCliente" class="form-label">Cedula del Cliente</label>
                <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su numero de Cédula">
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar Factura</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>