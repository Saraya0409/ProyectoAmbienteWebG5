<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php include 'layout/nav.php'; ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <h2 class="fw-bolder mb-4" style="color: #332F24;">Formulario de Pago en Local</h2>
            <form method="POST" action="procesar_pago_local.php">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre completo" required>
                </div>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su cédula" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Método de Pago</label>
                    <select class="form-control" name="metodo_pago" required>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="efectivo">Efectivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Confirmar Pedido</button>
            </form>

        </div>
    </section>
            <!-- Modal para mostrar el código de la factura -->
        <div class="modal fade" id="facturaModal" tabindex="-1" aria-labelledby="facturaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="facturaModalLabel">Factura Generada</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>¡Su factura ha sido generada con éxito!</p>
                        <p><strong>Código de Factura:</strong> <span id="codigoFactura"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="window.location.href='index.php';">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Obtén el parámetro "codigoFactura" de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const codigoFactura = urlParams.get("codigoFactura");

            if (codigoFactura) {
                // Establece el valor del código de factura en el modal
                document.getElementById("codigoFactura").innerText = codigoFactura;

                // Muestra el modal
                var facturaModal = new bootstrap.Modal(document.getElementById("facturaModal"));
                facturaModal.show();
            }
        });
        </script>


    <!-- Footer-->
    <?php include 'layout/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>