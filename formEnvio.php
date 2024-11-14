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
    <!-- Navigation -->
    <?php include 'layout/nav.php'; ?>


    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <!-- Formulario de Envío a Casa -->
            <h3 class="fw-bold mt-4" style="color: #332F24;">Formulario de Envío a Casa</h3>
            <form>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre completo"
                        required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección de Envío</label>
                    <textarea class="form-control" id="direccion" rows="3" placeholder="Ingrese su dirección completa"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono de Contacto</label>
                    <input type="tel" class="form-control" id="telefono" placeholder="Ingrese su número de teléfono"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Método de Pago</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodoPago" id="pagoTarjeta" value="tarjeta"
                            required>
                        <label class="form-check-label" for="pagoTarjeta">Tarjeta</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodoPago" id="pagoEfectivo"
                            value="efectivo" required>
                        <label class="form-check-label" for="pagoEfectivo">Efectivo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodoPago" id="pagoSimpe" value="simpe"
                            required>
                        <label class="form-check-label" for="pagoSimpe">Sinpe/Transferencia</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Confirmar Envío</button>
            </form>
        </div>
    </section>

    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>