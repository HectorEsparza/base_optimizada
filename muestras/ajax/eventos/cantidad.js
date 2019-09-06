$(document).ready(function(){

  $(".cantidad").change(function(){
    var indice = $(this).attr("id");
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
    //Obtenemos el valor del costo
    if($("#costo-"+indice).text()!=""){
      var costo = limpiarNumero($("#costo-"+indice).text());
    }
    else{
      var costo = "";
    }

    if($("#cantidad-"+indice).val()>0){
      var cantidad = $("#cantidad-"+indice).val();
      if(costo!=""){
        $("#importe-"+indice).text(formatNumber.new(redondeo(costo, cantidad), "$"));
      }
    }
    else{
      alert("Introduce un valor mayor a 0, por favor");
      $("#cantidad-"+indice).val("");
      if(costo!=""){
        $("#importe-"+indice).text(formatNumber.new(costo, "$"));
      }
    }
    calculaSubtotalIVATotal();
  });
});
