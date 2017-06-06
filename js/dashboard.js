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
            alert("btnVehicleCalc");
            $('#btnVehicleOut').attr("disabled", false);
        });

        //EGRESO VEHICULO
        $('#btnVehicleOut').click(function(){
            alert("btnVehicleOut");
            $('#btnVehicleOut').attr("disabled", true);
        });

        
        //CONSIGO EL ID AL CLICKEAR EN TABLA VEHICULOS EN PLAYA
        $(".clickOnTable").click(function(e) {
            e.preventDefault();
            var id = $(this).attr("data-valor");
            traerDatosVehiculo(id);
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