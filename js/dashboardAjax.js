/*
 * trae los datos del servidor y
 * arma la tabla en forma dinamica
*/
function traerVehiculosEnPlaya(){

    $.ajax({
        url:'/TPProgramcion-laboratorioIII2017/server/apiDashboard.php/dashboard/vehiculosenplaya',
        type:'GET'
    })
    .done(function(data){

        var vehiculosEnPlayaArray = JSON.parse(data);

        var tableVehiculosEnPlaya = "<table class='table'>\
                                            <tr>\
                                                <th>PATENTE</th>\
                                                <th>COCHERA</th>\
                                            </tr>";

        for(var i=0; i<vehiculosEnPlayaArray.length; i++){

        tableVehiculosEnPlaya += "<tr data-valor="+vehiculosEnPlayaArray[i].id+" class='clickOnTable trHover' >\
                                        <td>"+vehiculosEnPlayaArray[i].patente+"</td>\
                                        <td>"+vehiculosEnPlayaArray[i].numero+"</td>\
                                    </tr>";
        }

        tableVehiculosEnPlaya+="</table>";

        $('.vehicleDinamicTable').html(tableVehiculosEnPlaya);
    });
}


/*
 * trae los datos del servidor segun el id enviado y
 * arma la tabla con la informacion necesaria
*/
function traerDatosVehiculo(id){

    $.ajax({
        url:'/TPProgramcion-laboratorioIII2017/server/apiDashboard.php/dashboard/infosalidavehiculo',
        type:'GET',
        data: {'id':id},
        dataType: "xml/html/script/json",
        contentType: "application/json",
    })
    .fail(function(data){ //POR QUE CARAJO ME FUNCIONA CON EL FAIL Y NO CON EL DONE

        var infoVehiculoASalir = JSON.parse(data.responseText);
        
        var infAMostrar ="<table class='table table-striped tableInfoVehiculo' data-valor="+infoVehiculoASalir[0].id+">\
                                <tr>\
                                    <th>PATENTE</th>\
                                    <th>MARCA</th>\
                                    <th>COLOR</th>\
                                    <th>COCHERA</th>\
                                    <th>F.INGRESO</th>\
                                    <th>F.EGRESO</th>\
                                </tr>\
                                <tr>\
                                    <td>"+infoVehiculoASalir[0].patente+"</td>\
                                    <td>"+infoVehiculoASalir[0].marca+"</td>\
                                    <td>"+infoVehiculoASalir[0].color+"</td>\
                                    <td>"+infoVehiculoASalir[0].numero+"</td>\
                                    <td id='fechaIgresoVehiculo' data-valor="+infoVehiculoASalir[0].ingresofechahora+">"+formatearHoraDelServidor(infoVehiculoASalir[0].ingresofechahora)+"</td>\
                                    <td id='fechaEgresoACalcular'>CALCULAR</td>\
                                </tr>\
                            </table>";
        
        $('.datosVehiculo').html(infAMostrar);

    })
    .done(function(data){
 
        $('.datosVehiculo').html("<h4>No se pueden traer los datos</h4>");
        console.log(data);
        console.log(data.responseText);

    });
}


/*
 * Trae del servidor el calculo de la estadia a cobrar
*/
function calcularEstadia(fechaIngreso){

            /*3-Cobro por hora$10 o media estadía $90(12hs) o
            estadia$170(24hs)*/

        $('#fechaEgresoACalcular').html(formatearHoraDelServidor(fechaHoraServidor())); //"congela" la fecha de salida tentativa



        $('.importeAPagar').html("$50"); //Muestra el total a pagar
}


/*
 * trae del servidor año, mes, dia, hora, minutos
*/
function fechaHoraServidor(){
    var fechaHora;
    $.ajax({
        url:'/TPProgramcion-laboratorioIII2017/server/apiDashboard.php/dashboard/fechahoraactual',
        async:false,
        type:'GET'
    })
    .done(function(data){
        fechaHora = data;
    });
    return fechaHora;
}

/*
 * Da formato a los valores utilizados para Fecha y Hora
*/
function formatearHoraDelServidor(fechaHora){

        var year = fechaHora.substring(0,4);
        var mes = fechaHora.substring(4,6);
        var dia = fechaHora.substring(6,8);
        var hora = fechaHora.substring(8,10);
        var minutos = fechaHora.substring(10,12);

        return hora+":"+minutos+"Hs "+dia+"/"+mes+"/"+year;
}