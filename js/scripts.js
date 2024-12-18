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
                        $('#formularioModal form')[0].reset();   
                        var selectedValue = $('#horaCita').val();  
                        $('#horaCita option').show();  
                       $('#horaCita option').each(function () {
                        if ($(this).val() === selectedValue) {
                            $(this).hide();  
                        } else {
                            $(this).show();  
                        }
                    });
                               
                        getAllCitas();
                        
                    }
                    alert(response.message);
                });
            } catch (error) { 
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
                try {
                    let response = JSON.parse(data);
                    $('#listCita tbody').empty();
                    if (response.status === '00') {
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
                                "<a href='editarCita.php?id=" + elemento.idcitas + "' class='btn btn-warning btn-sm'>Editar</a>" +
                                " | " +
                                "<button class='btn btn-danger btn-sm' id='eliminarCita' data-id='" + elemento.idcitas + "'>Eliminar</button>" +
                                "</td></tr>"
                            );
                        });
                    } else {
                        $('#listCita').append("<tr><td colspan='9'>No se encontraron citas.</td></tr>");
                    }
                } catch (error) {
                    console.error("Error al analizar el JSON:", error);
                    console.log("Respuesta no válida del servidor:", data);
                }
            }
        );
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
                                 elemento.doctor + "</td>"+
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


            
            $(document).on('click', '#eliminarCita', function (e) {
                e.preventDefault(); 
                var id = $(this).data('id');                
                
                if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {              
                    $.post("procesarCitaBE.php", {
                        action: "delete",
                        id: id 
                    }, function(data, status) {
                        $('#listCita tbody').empty();
                        let response = JSON.parse(data);
                        
                        if (response.status == "00") {  alert(response.message);
                           
                             getAllCitas();
                        } else {
                          
                            alert(response.message);
                        }
                    });
                }
                 else {
                    alert('La eliminación fue cancelada.');
                }
            });
    
       const paginaActual = window.location.pathname;
            
   
       if (paginaActual.includes("editarCita.php")) {
               $('#error-cedulaE').hide();
               $('#error-nombreE').hide();
               $('#error-telefonoE').hide();
               $('#error-emailE').hide();
               $('#error-fechaCitaE').hide();
               $('#error-horaCitaE').hide();
               $('#error-doctorE').hide();
                 getById();
                }
       
            
       function getById() {
        const id = new URLSearchParams(window.location.search).get("id"); 
       
        if (!id) {
            alert("ID no válido o no proporcionado.");
            return;
        }        
        try{
            $.post("procesarCitaBE.php",
                {
                    action: "getById", id: id
                },
                function (data, status) {
                    let response = JSON.parse(data);
                    if(response.status == '00'){
                        response.citas.forEach(elemento => {
                            
                            $('#idcitasE').val(elemento.idcitas );
                            $('#cedulaE').val(elemento.cedula );                           
                            $('#nombreE').val(elemento.nombre );
                            $('#telefonoE').val(elemento.telefono );
                            $('#emailE').val(elemento.email );
                            $('#fechaCitaE').val(elemento.fechaCita );
                            $('#horaCitaE').val(elemento.horaCita );
                            $('#doctorE').val(elemento.doctor );
                                                 
                        });
                    }else {
                        alert("no se encontro nada")
                    }
                }
            )
            } catch (error) { 
                console.error("Error inesperado:", error); 
                alert("Ocurrió un error inesperado al intentar procesar la solicitud."); }
       }


       $('#formularioeditarcitas').on('submit', function (e) {
        e.preventDefault();
        
        let isValid = true;

        if ($('#cedulaE').val().trim() === '') {
            $('#cedulaE').addClass('error');
            $('#error-cedulaE').show();
            isValid = false;
        } else {
            $('#cedulaE').removeClass('error');
            $('#error-cedulaE').hide();
        }

        if ($('#emailE').val().trim() === '') {
            $('#emailE').addClass('error');
            $('#error-emailE').show();
            isValid = false;
        } else {
            $('#emailE').removeClass('error');
            $('#error-emailE').hide();
        }

        if ($('#nombreE').val().trim() === '') {
            $('#nombreE').addClass('error');
            $('#error-nombreE').show();
            isValid = false;
        } else {
            $('#nombreE').removeClass('error');
            $('#error-nombreE').hide();
        }

        if ($('#telefonoE').val().trim() === '') {
            $('#telefonoE').addClass('error');
            $('#error-telefonoE').show();
            isValid = false;
        } else {
            $('#telefonoE').removeClass('error');
            $('#error-telefonoE').hide();
        }
        if ($('#fechaCitaE').val().trim() === '') {
            $('#fechaCitaE').addClass('error');
            $('#error-fechaCitaE').show();
            isValid = false;
        } else {
            $('#fechaCitaE').removeClass('error');
            $('#error-fechaCitaE').hide();
        }
       console.log($('#idcitasE').val().trim());
        if (isValid) {
            try{
             $.post("procesarCitaBE.php",
                {
                    action: "update",
                    idcitas:$('#idcitasE').val().trim(),                    
                    cedula: $('#cedulaE').val().trim(),                    
                    nombre: $('#nombreE').val().trim(),
                    telefono: $('#telefonoE').val().trim(),
                    email: $('#emailE').val().trim(),
                    fechaCita: $('#fechaCitaE').val().trim(),
                    horaCita: $('#horaCitaE').val().trim(),
                    doctor: $('#doctorE').val().trim()
                   
                },
                function (data, status) {
                  
                    let response = JSON.parse(data);                    
                    if(response.status == '00'){                          
                        window.location.href = "citas.php";                                 
                        getAllCitas();                       
                        
                    }
                    
                   
                    alert(response.message);
                });
            } catch (error) { 
                console.error("Error inesperado:", error); 
                alert("Ocurrió un error inesperado al intentar procesar la solicitud."); }
             
        }})


        $('#fechaCita').on('change', function() {
            var fechaCita = $(this).val(); 
            $.post("procesarCitaBE.php", {  
                action: "horariodisponible",  
                fechaCita: fechaCita
            }, function(data) {               
                let response = JSON.parse(data);
                
                if(response.status == '00'){  
                    var horasReservadas = response.horaCita;
                    
                $('#horaCita option').each(function() {
                    
                    var option = $(this);
                    var hora = option.val();
                    if (horasReservadas.includes(hora)) {
                        option.hide();
                    } else {
                        option.show();
                    }
                });}else{
                    alert(response.message); 
                }
            });
        });

})

