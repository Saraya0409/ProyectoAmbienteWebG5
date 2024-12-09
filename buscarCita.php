<?php include 'layout/nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>

    <!-- Contenido principal -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Buscar Cita</h2>
        <form id="buscarCedula">
        <div class="mb-3">
            <label for="cedulab" class="form-label">Cédula</label>
            <input type="text" id="cedulab" name="cedulab" class="form-control" placeholder="Ingresa tu cédula">
            <span id="error-cedulab">La cédula es obligatoria.</span>  
              
        </div>
             <!-- 
            <div class="mb-3">
                <label for="fechaCita" class="form-label">Fecha de la Cita</label>
                <input type="date" class="form-control" id="fechaCita" name="fechaCita">
            </div>-->
            <button type="submit" class="btn btn-primary w-100">Buscar Cita</button>
        </form>

        <h3 class="mt-1 mb-1 text-center">Lista de Citas</h3>
        <table class="table table-bordered text-center" id="listCitafiltro">
            <thead class="table-dark">
                <tr>
                    
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>                    
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Doctor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>
  

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
</body>

</html>
