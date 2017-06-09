$(document).ready(function(){

    traerVehiculosEnPlaya();
    $(document).ready(function(){

        //botones ------------------

        //ELEGIR TIPO DE PATENTE (activa el cuadro de texto)
        $('input[id="patenteselectorNac"]').on('change', function() {
            $('input[name="txtPatenteNacVehicleIn"]').attr('disabled', false).focus();
            $('input[name="txtPatenteExtVehicleIn"]').attr('disabled', true).focus();
            $('input[name="txtPatenteExtVehicleIn"]').val('');
        });
        $('input[id="patenteselectorExt"]').on('change', function() {
            $('input[name="txtPatenteExtVehicleIn"]').attr('disabled', false).focus();
            $('input[name="txtPatenteNacVehicleIn"]').attr('disabled', true).focus();
            $('input[name="txtPatenteNacVehicleIn"]').val('');
        });


        //PANEL DE CONTROL
        $('#btnControlPanel').click(function(){
            alert("btnControlPanel");
        });

        //LOG OUT
        $('#btnLogout').click(function(){
            alert("btnLogout");
        });

        //INGRESO VEHICULO
        $('#btnVehicleIn').click(function(){ 
            alert("btnVehicleIn");
        });

        //CALCULAR ESTADIA
        $('#btnVehicleCalc').click(function(){
            var id = $('.tableInfoVehiculo').attr("data-valor");
            var fechaIngreso = $('#fechaIgresoVehiculo').html();

            fechaIngreso = "1234"; //Dato cualquiera hasta definir la forma de manejar las fechas

            calcularEstadia(fechaIngreso);

            $('#btnVehicleCalc').attr("disabled", true); //oculto
            $('#btnVehicleOut').attr("disabled", false); //visible
        });

        //EGRESO VEHICULO
        $('#btnVehicleOut').click(function(){

            $('.datosVehiculo').html(""); //reseteo los campos 
            $('.importeAPagar').html(""); //reseteo los campos

            $('#btnVehicleOut').attr("disabled", true); //oculto
        });

        
        //CONSIGO EL ID AL CLICKEAR EN TABLA VEHICULOS EN PLAYA
        $(".clickOnTable").click(function(e) {
            e.preventDefault();
            var id = $(this).attr("data-valor");
            traerDatosVehiculo(id);
            $('#btnVehicleCalc').attr("disabled", false); //visible
            $('#btnVehicleOut').attr("disabled", true); //oculto
        });


        //BOOTSTRAP VALIDATOR btnVehicleIn
        $('#formVehicleIn').bootstrapValidator({

            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },

            fields: {
                txtColorVehicleIn: {
                    validators: {
                            stringLength: {
                            min: 3,
                            max: 12,
                            message: 'Ingrese un color valido'
                        },
                            notEmpty: {
                            message: 'Debe ingresar un color'
                        }
                    }
                },
                txtMarcaVehicleIn: {
                    validators: {
                            stringLength: {
                            min: 2,
                            max: 25,
                            message: 'Ingrese una marca valida'
                        },
                            notEmpty: {
                            message: 'Debe ingresar una marca'
                        }
                    }
                },
                onSuccess: function(e, data) {
                    $('#btnVehicleIn').attr("disabled", false);
                }
            }
        //------------$('#formVehicleIn').bootstrapValidator
        });


    //-----------$(document).ready
    });
});