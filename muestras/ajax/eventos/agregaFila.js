$(document).ready(function(){

  // $("#agregar").click(function(){
  //   var cuerpo = $("#cuerpo");
  //   var fila = $("#filas").val();
  //   fila = parseInt(fila, 10);
  //   fila+=1;
  //   console.log("Agregando la fila número "+fila);
  //   $("#filas").val(fila);
  //   $("#fila"+fila).show();
  // });

  $("#agregarFila").click(function(){
    var cuerpo = $("#cuerpo");
    var fila = $("#filas").val();
    fila = parseInt(fila, 10);
    fila+=1;
    console.log("Agregando la fila número "+fila);
    $("#filas").val(fila);
    $("#fila"+fila).show();
  });

});
