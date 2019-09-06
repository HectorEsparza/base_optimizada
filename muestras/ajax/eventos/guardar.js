$(document).ready(function(){

  $("#guardar").click(function(){
    if($("#resultadoFolio").text()!=""){
      enviar();
    }
    else{
      alert("Selecciona un cliente o un vendedor, por favor");
    }
  });

  function enviar(){
    var contador = 1;
    var cantidad = [];
    var clave = [];
    for (var i = 1; i <= 25; i++) {
      if($("#cantidad-"+i).val()!=""){
        cantidad[contador] = $("#cantidad-"+i).val();
        clave[contador] = $("#clave-"+i).val();
        contador++;
      }
    }

    var parametros =
    {
      solicitante: $("#solicitante").val(),
      idSolicitante: $(".opcion").val(),
      idUsuario: $("#usuario").val(),
      total: limpiarNumero($("#total").text()),
      cantidad: cantidad,
      clave: clave,
      contador: contador,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/guardar.php", //Sera el archivo que va a procesar la petición AJAX
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
    alert(datos[0]);
    setTimeout("location.href='visualizacion.php'");
  }

  function problemas(){
     alert("Problemas en el servidor, intentalo más tarde");
  }
});
