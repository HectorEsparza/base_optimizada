//Calcula el interval
function iva(subtotal){

    var x = subtotal*.16;
    var y = Math.round(x * 100) / 100;
    if(y%1==0){
      return y += ".00";
    }
    else{
      return y;
    }
  }
//Calcula el Total
  function total(iva, subtotal){
    var resultado = Math.round((parseFloat(iva) + parseFloat(subtotal))*100) / 100;
    if(resultado%1==0){
      return resultado += ".00";
    }
    else{
      return resultado;
    }
  }
//Calcula el Subtotal, IVA y Total de la Muestra
function calculaSubtotalIVATotal(){
  //alert("se activa");
  var subtotal = 0;
  var importe;
  for (var i = 1; i <= 25; i++) {
    if($("#importe-"+i).text()!=""){
      importe = $("#importe-"+i).text();
      importe = limpiarNumero(importe);
      subtotal += parseFloat(importe);
    }
  }
  if(subtotal%1==0){
    subtotal += ".00";
    $("#subtotal").text(formatNumber.new(subtotal,"$"));
    $("#iva").text(formatNumber.new(iva(limpiarNumero($("#subtotal").text())),"$"));
    $("#total").text(formatNumber.new(total(limpiarNumero($("#iva").text()), limpiarNumero($("#subtotal").text())), "$"));
  }
  else{
    $("#subtotal").text(formatNumber.new(subtotal,"$"));
    $("#iva").text(formatNumber.new(iva(limpiarNumero($("#subtotal").text())),"$"));
    $("#total").text(formatNumber.new(total(limpiarNumero($("#iva").text()), limpiarNumero($("#subtotal").text())), "$"));
  }
}
//Limpiar un numero, quitarle comas y signo de pesos
function limpiarNumero(numero){
  numero = numero.split("$");
  numero = numero[1];
  numero = numero.replace(",", "");
  return numero;
}
//Redondeo a 2 cifras despues del punto decimal
function redondeo(numero, cantidad){
  if(numero%1==0){
    numero = numero*cantidad;
    numero += ".00";
  }
  else{
    numero = numero*cantidad;
    numero = Math.round(numero*100)/100;
  }
  return numero;
}

//Formato con coma a los números, separador de miles
var formatNumber = {
     separador: ",", // separador para los miles
     sepDecimal: '.', // separador para los decimales
     formatear:function (num){
     num +='';
     var splitStr = num.split('.');
     var splitLeft = splitStr[0];
     var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
     var regx = /(\d+)(\d{3})/;
     while (regx.test(splitLeft)) {
     splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
     }
     return this.simbol + splitLeft +splitRight;
     },
     new:function(num, simbol){
     this.simbol = simbol ||'';
     return this.formatear(num);
     }
  }
