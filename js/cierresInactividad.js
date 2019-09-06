$(document).ready(function(){

  function cierre(){
    alert("Tu sesión ha expirado");
    setTimeout("location.href='../cierre.php'");
  }

    var inicioConteo = setInterval(cierre, 600000);


    $("body").mousemove(function(){

      clearInterval(inicioConteo);
      inicioConteo = setInterval(cierre, 600000);

    });

    $("body").keypress(function(){

      clearInterval(inicioConteo);
      inicioConteo = setInterval(cierre, 600000);
    });


});
