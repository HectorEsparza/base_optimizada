$(document).ready(function(){

  $("#impresion").click(function(){
      $("#impresion").hide();
      $("#visualizacion").hide();
      $("#cierres").hide();
      print();
      $("#impresion").show();
      $("#visualizacion").show();
      $("#cierres").show();
  });
});
