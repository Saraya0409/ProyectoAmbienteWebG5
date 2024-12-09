<?php include 'layout/nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    
    
    
    <!-- Cart Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <h2 class="fw-bolder mb-4" style="color: #332F24;">Tu Carrito</h2>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Drosera Homaccord Gotas 30ml Heel</td>
                        <td>
                            <div class="carrito-actions d-flex justify-content-center align-items-center">
                                <input type="number" value="1" min="1" style="width: 60px; text-align: center; border: 1px solid #ced4da; border-radius: 4px; padding: 5px;">
                                <button class="btn btn-primary btn-sm ms-2">
                                    <i class="bi bi-arrow-repeat"></i> Actualizar
                                </button>
                                <button class="btn btn-danger btn-sm ms-2">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </div>
                        </td>
                        <td>₡9000</td>
                    </tr>
                    <tr>
                        <td>Nux Vomica 9 CH Glóbulos 4g Boiron</td>
                        <td>
                            <div class="carrito-actions d-flex justify-content-center align-items-center">
                                <input type="number" value="2" min="1" style="width: 60px; text-align: center; border: 1px solid #ced4da; border-radius: 4px; padding: 5px;">
                                <button class="btn btn-primary btn-sm ms-2">
                                    <i class="bi bi-arrow-repeat"></i> Actualizar
                                </button>
                                <button class="btn btn-danger btn-sm ms-2">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </div>
                        </td>
                        <td>₡3000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Total:</td>
                        <td class="fw-bold">₡12000</td>
                    </tr>
                </tfoot>
            </table>
            <!-- Botones de Pago -->
            <div class="text-end">
                <a href="formEnvio.php" class="btn btn-success btn-lg me-2" style="background-color: #28a745; border-color: #28a745; color: white;">
                    Envío a Casa
                </a>
                <a href="pagoLocal.php" class="btn btn-success btn-lg" style="background-color: #28a745; border-color: #28a745; color: white;">
                    Pago en Local
                </a>
            </div>
        </div>
    </section>
    
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
