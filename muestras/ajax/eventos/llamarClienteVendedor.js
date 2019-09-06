$(document).ready(function(){

  $(".checar").click(function(){
    $("#solicitante").val($(this).val());
    $("#idSolicitante").text("ID "+$(this).val());
    $("#nombreSolicitante").text("Nombre "+$(this).val());
    $(".opcion").prop("readonly", false);
    $("#resultadoFolio").text("");
    $(".opcion").val("");
    $("#resultadoNombre").text("");
  });

  $(".opcion").change(function(){
    if($(".opcion").val()==""){
      $(".opcion").prop("readonly", true);
      $("#idSolicitante").text("ID");
      $("#nombreSolicitante").text("Nombre");
      $("#resultadoNombre").text("");
      $(".checar").prop("checked", false);
      $("#cantidad-1").prop("readonly", true);
      $("#clave-1").prop("readonly", true);
    }
    else{
      enviar();
    }
  });

  function enviar(){

    var parametros =
    {
      solicitante: $("#solicitante").val(),
      id: $(".opcion").val(),
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/llamarClienteVendedor.php", //Sera el archivo que va a procesar la petición AJAX
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
    if(datos[0]==1){
      $("#resultadoNombre").text(datos[1]);
      $("#resultadoFolio").text(datos[4]);
      $("#cantidad-1").prop("readonly", false);
      $("#clave-1").prop("readonly", false);
    }
    else{
      alert("El "+datos[2]+" con el número "+datos[3]+" no existe en la base de datos, por favor verificalo");
      $("#cantidad-1").prop("readonly", true);
      $("#clave-1").prop("readonly", true);
      $("#resultadoFolio").text("");
      $("#resultadoNombre").text("");
    }
  }

  function problemas(){
     alert("Problemas en el servidor, intentalo más tarde");
  }
});
