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

        var tableVehiculosEnPlaya = "<table class='table table-striped'>\
                                            <tr>\
                                                <th>PATENTE</th>\
                                                <th>COCHERA</th>\
                                            </tr>";

        for(var i=0; i<vehiculosEnPlayaArray.length; i++){

        tableVehiculosEnPlaya += "<tr data-valor="+vehiculosEnPlayaArray[i].id+" class='clickOnTable' >\
                                        <td>"+vehiculosEnPlayaArray[i].patente+"</td>\
                                        <td>"+vehiculosEnPlayaArray[i].numero+"</td>\
                                    </tr>";
        }

        tableVehiculosEnPlaya+="</table>";

        $('.vehicleDinamicTable').html(tableVehiculosEnPlaya);
    });
}



function traerDatosVehiculo(id){

    alert("Antes de entrar al AJAX "+id);

    $.ajax({
        url:'/TPProgramcion-laboratorioIII2017/server/apiDashboard.php/dashboard/infosalidavehiculo',
        type:'GET',
        data: {'id':id},
        dataType: "xml/html/script/json",
        contentType: "application/json"
    })
    .done(function(data){
        alert("PASo el AJAX");
        $('.datosVehiculo').html("<h1>hola</h1>");

    });
}

