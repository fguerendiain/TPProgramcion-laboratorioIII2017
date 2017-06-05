/*
 * trae los datos del servidor y
 * arma la tabla en forma dinamica
*/

function traerVehiculosEnPlaya(){

  $.ajax({
      url:'/dashboard/vehiculosenplaya',
      type:'GET'
  })
  .done(function(data){
    var vehiculosEnPlayaArray = JSON.parse(data)

    var tableVehiculosEnPlaya = "<table class='table table-striped'>\
                                        <tr>\
                                            <th>PATENTE</th>\
                                            <th>COCHERA</th>\
                                        </tr>"

    for(vehiculo in vehiculosEnPlayaArray){

        tableVehiculosEnPlaya += "<tr data-valor='"+vehiculo.id+"' class='clickOnTable' >\
                                        <td>'"+vehiculo.patente+"'</td>\
                                        <td>'"+vehiculo.cochera+"'</td>\
                                    </tr>"
    }

    tableVehiculosEnPlaya+="</table>"

    return tableVehiculosEnPlaya;

  });

}



function traerDatosVehiculo(id){

}

