$(function () {
    $('#error-cedula').hide();
    $('#error-nombre').hide();
    $('#error-telefono').hide();
    $('#error-email').hide();
    $('#error-fechaCita').hide();
    $('#error-horaCita').hide();
    $('#error-doctor').hide();
    $('#formularioCitas').on('submit', function (e) {
        e.preventDefault();
        
        let isValid = true;

        if ($('#cedula').val().trim() === '') {
            $('#cedula').addClass('error');
            $('#error-cedula').show();
            isValid = false;
        } else {
            $('#cedula').removeClass('error');
            $('#error-cedula').hide();
        }

        if ($('#email').val().trim() === '') {
            $('#email').addClass('error');
            $('#error-email').show();
            isValid = false;
        } else {
            $('#email').removeClass('error');
            $('#error-email').hide();
        }

        if ($('#nombre').val().trim() === '') {
            $('#nombre').addClass('error');
            $('#error-nombre').show();
            isValid = false;
        } else {
            $('#nombre').removeClass('error');
            $('#error-nombre').hide();
        }

        if ($('#telefono').val().trim() === '') {
            $('#telefono').addClass('error');
            $('#error-telefono').show();
            isValid = false;
        } else {
            $('#telefono').removeClass('error');
            $('#error-telefono').hide();
        }
        if ($('#fechaCita').val().trim() === '') {
            $('#fechaCita').addClass('error');
            $('#error-fechaCita').show();
            isValid = false;
        } else {
            $('#fechaCita').removeClass('error');
            $('#error-fechaCita').hide();
        }
       
        if (isValid) {
            try{
             $.post("procesarCitaBE.php",
                {
                    action: "add",
                    cedula: $('#cedula').val().trim(),                    
                    nombre: $('#nombre').val().trim(),
                    telefono: $('#telefono').val().trim(),
                    email: $('#email').val().trim(),
                    fechaCita: $('#fechaCita').val().trim(),
                    horaCita: $('#horaCita').val().trim(),
                    doctor: $('#doctor').val().trim()
                },
                function (data, status) {
                    let response = JSON.parse(data);
                    if(response.status == '00'){        
                        $('#formularioModal').modal('hide');               
                        getAllCitas();
                        
                    }
                    alert(response.message);
                });
             //$(this).unbind('submit').submit();
            } catch (error) { // Capturar errores inesperados en el bloque principal 
                console.error("Error inesperado:", error); 
                alert("Ocurrió un error inesperado al intentar procesar la solicitud."); }
             
        }
    });

    function getAllCitas() {
        $.post("procesarCitaBE.php",
            {
                action: "getAll"
            },
            function (data, status) {
                let response = JSON.parse(data);
                if(response.status == '00'){
                    response.citas.forEach(elemento => {
                        $('#listCita').append(
                            "<tr><td>" + 
                            elemento.idcitas + "</td><td>" +
                             elemento.cedula + "</td><td>" +
                             elemento.nombre + "</td><td>" +
                             elemento.telefono + "</td><td>" + 
                             elemento.email + "</td><td>" + 
                             elemento.fechaCita + "</td><td>" + 
                             elemento.horaCita + "</td><td>" + 
                             elemento.doctor + "</td><td>" +
                            "<button class='btn btn-warning btn-sm' data-id='" + elemento.idcitas + "' onclick='editarCita(" + elemento.idcitas + ")'>Editar</button>" +
                            " | " +
                            "<button class='btn btn-danger btn-sm' id='eliminarCita' data-id='" + elemento.idcitas + "' )'>Eliminar</button>" +
                         "</td>" +
                     "</tr>"
                        );
                    });
                }else {
                    
                    $('#listCita').append("<tr><td colspan='5'>No se encontraron citas.</td></tr>");
                }
            });
    
    }

    getAllCitas();

    
    $('#error-cedulab').hide();
    $('#buscarCedula').on('submit', function (e) {
              
        e.preventDefault();
        let isValid = true;
        let cedula = $('#cedulab').val().trim();  


        if ($('#cedulab').val().trim() === '') {
            $('#cedulab').addClass('error');
           $('#error-cedulab').show();
           isValid = false;
        } else {
            $('#cedulab').removeClass('error');
            $('#error-cedulab').hide();
        }
        if (isValid) {
            try{
            $.post("procesarCitaBE.php",
                {
                    action: "getByCedula", cedula: cedula
                },
                function (data, status) {
                    let response = JSON.parse(data);
                    $('#listCitafiltro tbody').empty();
                    if(response.status == '00'){
                        response.citas.forEach(elemento => {
                            $('#listCitafiltro').append(
                                "<tr><td>" + 
                                 elemento.cedula + "</td><td>" +
                                 elemento.nombre + "</td><td>" +
                                 elemento.telefono + "</td><td>" + 
                                 elemento.email + "</td><td>" + 
                                 elemento.fechaCita + "</td><td>" + 
                                 elemento.horaCita + "</td><td>" + 
                                 elemento.doctor + "</td><td>" +
                                "<button class='btn btn-warning btn-sm' data-id='" + elemento.idcitas + "' onclick='editarCita(" + elemento.idcitas + ")'>Editar</button>" +
                                "</td>" +
                         "</tr>"
                            );
                        });
                    }else {
                        
                        $('#listCita').append("<tr><td colspan='5'>No se encontraron citas.</td></tr>");
                    }
                }
            )
            } catch (error) { 
                console.error("Error inesperado:", error); 
                alert("Ocurrió un error inesperado al intentar procesar la solicitud."); }
        } 
   
            } )  


            
            $('#eliminarCita').on('click', function (e) {
                var id = $(this).data('id');
                alert(id);
            })


            function eliminarCita(id) {
             alert("entra a eliminar")
                if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {              
                    $.post("procesarCitaBE.php", {
                        action: "delete",
                        id: id 
                    }, function(data, status) {
                        let response = JSON.parse(data);
                        
                        if (response.status == "00") {  alert(response.message); $('#listCitafiltro').empty();  
                            buscarCitas(); 
                        } else {
                          
                            alert(response.message);
                        }
                    });
                }
            }
  
})

