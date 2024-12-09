<?php include 'layout/nav.php'; 
//print_r($_SESSION);?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            width: 60%;
            padding-right: $padding-x;
            padding-left: $padding-x;
            margin-right: auto;
            margin-left: auto;
           
        }
        section{
            width: 50%; 
            padding: 20px;
            justify-self: center;
        }
            
           
    </style>
</head>

<body>
<section>
<div class="container">
<form id="formularioeditarcitas">
<input type="hidden" id="idcitasE" name="idcitasE">                    
<div class="mb-3">
    <label for="cedulaE" class="form-label">Cédula</label>
    <input type="text" id="cedulaE" name="cedulaE" class="form-control" placeholder="Ingresa tu cédula">
    <span id="error-cedulaE">La cédula es obligatoria.</span>
</div>
<div class="mb-3">
    <label for="nombreE" class="form-label">Nombre Completo</label>
    <input type="text" id="nombreE" name="nombreE" class="form-control" placeholder="Ingresa tu nombre">
    <span id="error-nombreE">El nombre es obligatorio.</span>
</div>


<div class="mb-3">
    <label for="telefonoE" class="form-label">Teléfono</label>
    <input type="text" id="telefonoE" name="telefonoE" class="form-control" placeholder="Ingresa tu teléfono">
    <span id="error-telefonoE">El teléfono es obligatorio.</span>
</div>
<div class="mb-3">
    <label for="emailE" class="form-label">Correo electrónico</label>
    <input type="emailE" id="emailE" name="emailE" class="form-control" placeholder="Ingresa tu correo electrónico">
    <span id="error-emailE">El email es obligatorio.</span>
</div>
<div class="mb-3">
    <label for="fechaCitaE" class="form-label">Fecha de cita</label>
    <input type="date" id="fechaCitaE" name="fechaCitaE" class="form-control" placeholder="Selecciona la fecha de la cita">
    <span id="error-fechaCitaE">La fecha de la cita es obligatoria.</span>
</div>
<div class="mb-3">
    <label for="horaCitaE" class="form-label">Hora de la cita</label>
    <select id="horaCitaE" name="horaCitaE" class="form-control">
        <option value="08:00:00">08:00 AM</option>
        <option value="10:00:00">10:00 AM</option>
        <option value="11:00:00">11:00 AM</option>
        <option value="14:00:00">02:00 PM</option>
        <option value="16:00:00">04:00 PM</option>
    </select>
</div>
<div class="mb-3">
    <label for="doctorE" class="form-label">Doctor</label>
    <select id="doctorE" name="doctorE" class="form-control">
        <option value="1">Dr. Carlos Ramirez Mora</option></option>
        <option value="2">Dr. Manuel Jimenez Sanchez</option>
        <option value="3">Dr. Manuel Pereira Solis</option>
    </select>
  
</div>
<div class="text-center">
    <?php 
    if($_SESSION['rol'] == "admin"){
        echo"<a href='citas.php' class='btn btn-secondary'>Volver</a>";
    }else{
        echo"<a href='buscarCita.php' class='btn btn-secondary'>Volver</a>";
    }
    ?>
    
    <button type="submit" class="btn btn-success">Guardar Cambios</button>
</div>
</form>
</div>
</section>
</body>
<?php include 'layout/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</html>
