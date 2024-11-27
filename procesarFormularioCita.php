<?php
include('DB.php');

if(!empty($_POST)){   
        print_r($_POST);

        $query = "INSERT INTO `citas` (`cedula`,`nombre`, `telefono`, `email`, `fechaCita`, `horaCita`, `doctor`) VALUES ('" . $_POST['cedula'] . "', '" . $_POST['nombre'] . "', '" . $_POST['telefono'] . "','" . $_POST['email'] . "','" . $_POST['fechaCita'] . "','" . $_POST['horaCita'] . "','" . $_POST['doctor'] . "')";
        
        if($conn->query($query) ==  TRUE){
            echo "<script>
                alert('Cita Agendada');
                window.location.href = 'index.php';
              </script>";
            
        } else {
            echo "<script>
                    alert('Error al agendar la cita');
                    window.location.href = 'index.php';
                </script>";
        }
    

}


