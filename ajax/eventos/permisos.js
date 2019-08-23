$(document).ready(function(){
  var modulo = "";
  var usuario = $("#usuario").val();
  //Se activa al presionar un módulo
  $(".btn").click(function(){
    modulo = $(this).val();
    if(modulo!="Cierra Sesión"){
      //alert("Bienvenido "+usuario+", Activaste "+modulo);
      enviar();
    }
  });

  function enviar(){

    var parametros =
    {
      usuario: usuario,
      modulo: modulo,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/permisos.php", //Sera el archivo que va a procesar la petición AJAX
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
      setTimeout("location.href='"+datos[1]+"'",500);
    }
    else{
      alert("No cuenta con permisos");
    }
  }

  function problemas(){
     alert("Problemas en el servidor, intenta más tarde por favor");
  }
});
