<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Home</title>
    <style>
      body{
        background: #F0EEF0;
      }
      #nota{
        background: #FC6363;
        color: #000000;
        width: 150px;
      }
      #carta{
        background: #FCFA63;
        color: #000000;
        width: 150px;
      }
      #sae{
        background: #8AFC63;
        color: #000000;
        width: 150px;
      }
      #nomina{
        background: #FF69B4;
        color: #000000;
        width: 150px;
      }
      #pedido{
        background: #63FCF5;
        color: #000000;
        width: 150px;
      }
      #remision{
        background: #FF7F50;
        color: #000000;
        width: 150px;
      }
      #altas{
        background: #CE63FC;
        color: #000000;
        width: 150px;
      }
      #analisis{
        background: #637EFC;
        color: #000000;
        width: 150px;
      }
      #caja{
        background: #9B63FC;
        color: #000000;
        width: 150px;
      }
      #imagen{
        width: 150px;
        height: 75px;
      }
      #ciere{
        float: right;
      }

    </style>
  </head>
  <body>
    <?php session_start();
       $usuario = $_SESSION['user'];
       if(!isset($usuario)){
         header("location:index.html");
       }
       require_once("funciones.php");

       $base = conexion_local();
       $consulta = "SELECT DEPARTAMENTO, PERMISO FROM USUARIOS WHERE USUARIO=?";
       $resultado = $base->prepare($consulta);
       $resultado->execute(array($usuario));
       $registro = $resultado->fetch(PDO::FETCH_NUM);
       $departamento = $registro[0];
       $permiso = $registro[1];
    ?>
    <input type="hidden" id="departamento" value="<?= $departamento?>" />
    <input type="hidden" id="permiso" value="<?= $permiso?>" />
    <header style="margin-top: 0px;">
      <div class="container-fluid">
      <div class="container col-md-8">
        <img class="img-responsive img-rounded" id="imagen" src='imagenes/imagen.jpg' style="float: left;">
        <h1 align='center'>
          Bienvenidos!
        </h1>
      </div>
      <div class="container col-md-4">
        <input type="button" id="cierre" value="Cierra Sesión" class="btn btn-primary" />
      </div>
      </div>

    </header>
    <br /><br />
    <section>
      <div class="container">
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" id="nota" value="Notas de Crédito" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="pedido" value="Pedidos" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="carta" value="Cartas Factura" class="btn btn-primary" />
            </div>
          </div>
          <br />
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" id="remision" value="Remision" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="sae" value="Captura SAE" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="nomina" value="Pre-Nominas" class="btn btn-primary" />
            </div>
          </div>
          <br />
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" id="altas" value="Altas" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="analisis" value="Listas de Precios" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="caja" value="Caja" class="btn btn-primary" />
            </div>
          </div>
     </div>
    </section>
    <script src="notaCredito/ajax/eventos/cierreInactividad.js"></script>
    <script>
      $(document).ready(function(){

        var departamento = $("#departamento").val();
        var permiso = $("#permiso").val();

        if(permiso==0){
          $("#nota").show();
          $("#pedido").show();
          $("#carta").show();
          $("#remision").hide();
          $("#sae").show();
          $("#nomina").show();
          $("#altas").show();
          $("#analisis").show();
          $("#caja").show();
        }
        else if(permiso==1){
          $("#altas").show();
          $("#analisis").hide();
          $("#caja").hide();
          if(departamento=="VENTAS"){
            $("#nota").show();
            $("#pedido").show();
            $("#carta").show();
            $("#remision").hide();
            $("#sae").hide();
            $("#nomina").hide();
          }
          else if(departamento=="CREDITO_Y_COBRANZA"){
            $("#nota").hide();
            $("#pedido").hide();
            $("#carta").hide();
            $("#remision").hide();
            $("#sae").show();
            $("#nomina").hide();
            $("#altas").hide();
            $("#caja").show();
          }
          else if(departamento=="RECURSOS_HUMANOS"||departamento=="CONTABILIDAD"||departamento=="ADMINISTRADOR"){
            $("#nota").hide();
            $("#pedido").hide();
            $("#carta").hide();
            $("#remision").hide();
            $("#sae").hide();
            $("#nomina").show();
          }

          else if(departamento=="PRODUCCION_SOPORTE"||departamento=="PRODUCCION_MANGUERA"||departamento=="ALMACEN"){
            $("#nota").hide();
            $("#pedido").hide();
            $("#carta").hide();
            $("#remision").hide();
            $("#sae").hide();
            $("#nomina").hide();
          }
        }
        else {
          $("#analisis").hide();
          $("#altas").hide();
          $("#caja").hide();
          if(departamento=="VENTAS"){
            $("#nota").show();
            $("#pedido").show();
            $("#carta").show();
            $("#remision").hide();
            $("#sae").hide();
            $("#nomina").hide();
          }
          else if(departamento=="CREDITO_Y_COBRANZA"){
            $("#nota").hide();
            $("#pedido").hide();
            $("#carta").hide();
            $("#remision").hide();
            $("#sae").hide();
            $("#nomina").hide();
            $("#caja").show();
          }
          else if(departamento=="RECURSOS_HUMANOS"){
            $("#nota").hide();
            $("#pedido").hide();
            $("#carta").hide();
            $("#remision").hide();
            $("#sae").hide();
            $("#nomina").show();
            $("#altas").show();
          }
          else if(departamento=="COBRANZA" || departamento=="COBRANZA_TECAMAC"){
            $("#nota").hide();
            $("#pedido").hide();
            $("#carta").hide();
            $("#remision").hide();
            $("#sae").hide();
            $("#nomina").hide();
            $("#caja").show();
          }
        }

        $("#nota").click(function(){
          setTimeout("location.href='notaCredito/visualizacion.php'",500);
        });
        $("#carta").click(function(){
          setTimeout("location.href='cartaFactura/visualizarCartas.php'",500);
        });
        $("#sae").click(function(){
          setTimeout("location.href='notaCredito/sae.php'",500);
        });
        $("#nomina").click(function(){
          alert("Programa en Proceso...");
          // setTimeout("location.href='cierre.php'",500);
        });
        $("#pedido").click(function(){
          setTimeout("location.href='pedido/visualizarPedidos.php'",500);
        });
        $("#remision").click(function(){
          setTimeout("location.href='remision/visualizarPedidos.php'",500);
        });

        $("#cierre").click(function(){
          setTimeout("location.href='cierre.php'",500);
        });

        $("#altas").click(function(){
          setTimeout("location.href='altaTrabajador/visualizacion.php'",500);
        });

        $("#analisis").click(function(){
          setTimeout("location.href='analisis/analisis.php'",500);
        });

        $("#caja").click(function(){
          setTimeout("location.href='caja/visualizacion.php'",500);
        });
        // $("body").hide().fadeIn(2000);



      });
    </script>
  </body>
</html>
