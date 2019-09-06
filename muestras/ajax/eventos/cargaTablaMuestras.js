$(document).ready(function(){

  for (var i = 1; i <= 25; i++) {
    if(i<=10){
      $('<tr>'+
          '<td>'+
            '<input type="number" style="width: 100px; height: 20px;" class="cantidad" id="cantidad-'+i+'" readonly />'+
          '</td>'+
          '<td>'+
            '<input type="text" style="width: 100px; height: 20px;" class="clave" id="clave-'+i+'" readonly />'+
          '</td>'+
          '<td id="descripcion-'+i+'"></td>'+
          '<td id="costo-'+i+'"></td>'+
          '<td id="importe-'+i+'"></td>'+
        '</tr>').appendTo($("#cuerpo"));
    }
    else{
      $('<tr id="fila'+i+'" hidden>'+
          '<td>'+
            '<input type="number" style="width: 100px; height: 20px;" class="cantidad" id="cantidad-'+i+'" readonly />'+
          '</td>'+
          '<td>'+
            '<input type="text" style="width: 100px; height: 20px;" class="clave" id="clave-'+i+'" readonly />'+
          '</td>'+
          '<td id="descripcion-'+i+'"></td>'+
          '<td id="costo-'+i+'"></td>'+
          '<td id="importe-'+i+'"></td>'+
        '</tr>').appendTo($("#cuerpo"));
    }
  }
});
