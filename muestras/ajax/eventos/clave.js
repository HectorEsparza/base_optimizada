$(document).ready(function(){
  var clave = "";
  var indice = "";
  $(".clave").change(function(){
    indice = $(this).attr("id");
    indice = indice.split("-");
    indice = indice[1];
    //Desactivamos el boton de guardado
    if($("#clave-"+indice).val()!=""&&$("#cantidad-"+indice).val()!=""){
      $("#guardar").prop("disabled", false);
    }
    else if(indice>1&&($("#clave-"+indice).val()==""&&$("#cantidad-"+indice).val()=="")){
      $("#guardar").prop("disabled", false);
    }
    else{
      $("#guardar").prop("disabled", true);
    }
    //Llamada AJAX para obtener descripción e importe del producto
    if($(this).val()!=""){
      clave = $(this).val();
      enviar();
    }
    else{
      $("#descripcion-"+indice).text("");
      $("#costo-"+indice).text("");
      $("#importe-"+indice).text("");
      $("#cantidad-"+(parseInt(indice)+1)).prop("readonly", true);
      $("#clave-"+(parseInt(indice)+1)).prop("readonly", true);
      calculaSubtotalIVATotal();
    }

    //calculaSubtotalIVATotal();

  });

  function enviar(){

    var parametros =
    {
      clave: clave,
      indice: indice,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/clave.php", //Sera el archivo que va a procesar la petición AJAX
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
      var cantidad = 0;
      if($("#cantidad-"+datos[1]).val()==""){
        cantidad = 1;
      }
      else{
        cantidad = $("#cantidad-"+datos[1]).val();
      }
      //alert(datos[0] + " " + datos[1]+ " " + datos[2]);
      $("#descripcion-"+datos[1]).text(datos[3]);
      $("#costo-"+datos[1]).text(formatNumber.new(datos[4], "$"));
      $("#importe-"+datos[1]).text(formatNumber.new(redondeo(datos[4], cantidad), "$"));
      $("#cantidad-"+(parseInt(datos[1])+1)).prop("readonly", false);
      $("#clave-"+(parseInt(datos[1])+1)).prop("readonly", false);
      calculaSubtotalIVATotal();
    }
    else{
      alert("La clave "+datos[2]+" no existe dentro de la base de datos, por favor verificala");
      $("#descripcion-"+datos[1]).text("");
      $("#costo-"+datos[1]).text("");
      $("#importe-"+datos[1]).text("");
      $("#cantidad-"+(parseInt(datos[1])+1)).prop("readonly", true);
      $("#clave-"+(parseInt(datos[1])+1)).prop("readonly", true);
      $("#guardar").prop("disabled", true);
      calculaSubtotalIVATotal();
    }
  }

  function problemas(){
     alert("Problemas en el servidor, intentalo más tarde");
  }
});
