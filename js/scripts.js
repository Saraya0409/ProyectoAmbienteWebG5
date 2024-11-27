$(function () {
    $('#error-cedula').hide();
    $('#error-nombre').hide();
    $('#error-telefono').hide();
    $('#error-email').hide();
    $('#error-fechaCita').hide();
    $('#error-horaCita').hide();
    $('#error-doctor').hide();
    $('#contactForm').on('submit', function (e) {
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
            
             $(this).unbind('submit').submit();
        }
    });
})