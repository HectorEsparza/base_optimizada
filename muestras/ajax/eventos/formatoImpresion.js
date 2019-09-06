$(document).ready(function(){
  enviar();

  function enviar(){

    var parametros =
    {
      folio: $("#resultadoFolio").text(),
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/formatoImpresion.php", //Sera el archivo que va a procesar la petición AJAX
        data: parametros, //Datos que le vamos a enviar
        // data: "total="+total+"&penalizacion="+penalizacion,
        beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
        success: llegada, //Función que se ejecuta en caso de tener exito
        timeout: 4000,
        error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
    });
    return false;
  }
  function inicioEnvio(){
      console.log("Cargando...");
  }

  function llegada(datos){
      $("#cuerpo").empty();
      $("#resultadoFecha").text(datos.fecha);
      $("#idSolicitante").text(datos.idSolicitante);
      $("#nombreSolicitante").text(datos.nombreSolicitante);
      for (var i = 0; i < 25; i++) {
        if(i<datos.contador){
          $('<tr>'+
              '<td>'+datos.cantidad[i]+'</td>'+
              '<td>'+datos.clave[i]+'</td>'+
              '<td>'+datos.descripcion[i]+'</td>'+
              '<td>'+formatNumber.new(datos.costo[i], "$")+'</td>'+
              '<td>'+formatNumber.new(datos.importe[i], "$")+'</td>'+
            '</tr>').appendTo($("#cuerpo"));
        }
        else{
          $('<tr>'+
              '<td>&nbsp;</td>'+
              '<td>&nbsp;</td>'+
              '<td>&nbsp;</td>'+
              '<td>&nbsp;</td>'+
              '<td>&nbsp;</td>'+
            '</tr>').appendTo($("#cuerpo"));
        }
      }
      $("#subtotal").text(formatNumber.new(datos.subtotal, "$"));
      $("#iva").text(formatNumber.new(datos.iva, "$"));
      $("#total").text(formatNumber.new(datos.total, "$"));
      $("#documentador").text(datos.documentador);

  }

  function problemas(){
     alert("Problemas en el servidor, intentalo más tarde");
  }
});
