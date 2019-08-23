<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/cierre.js"></script>
    <script src="js/cierreInactividad.js"></script>
    <script src="ajax/eventos/permisos.js"></script>
    <title>Home</title>
    <style>
      body{
        background: #F0EEF0;
      }
      .notasDeCredito{
        background: #FC6363;
        color: #000000;
        width: 150px;
      }
      .pedidos{
        background: #63FCF5;
        color: #000000;
        width: 150px;
      }
      .cartasFactura{
        background: #FCFA63;
        color: #000000;
        width: 150px;
      }
      .capturaSae{
        background: #8AFC63;
        color: #000000;
        width: 150px;
      }
      .listasDePrecios{
        background: #637EFC;
        color: #000000;
        width: 150px;
      }
      .caja{
        background: #9B63FC;
        color: #000000;
        width: 150px;
      }
      .altas{
        background: #CE63FC;
        color: #000000;
        width: 150px;
      }
      .muestras{
        background: #FC9D63;
        color: #000000;
        width: 150px;
      }
      .cotizaciones{
        background: #FC6363;
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
    ?>
    <input type="hidden" id="usuario" value="<?= $usuario?>" />
    <header style="margin-top: 0px;">
      <div class="container-fluid">
      <div class="container col-md-8">
        <img class="img-responsive img-rounded" id="imagen" src='imagenes/imagen.jpg' style="float: left;">
        <h1 align='center'>
          Bienvenidos!
        </h1>
      </div>
      <div class="container col-md-4">
        <input type="button" id="cierre" value="Cierra Sesión" class="btn btn-danger" />
      </div>
      </div>

    </header>
    <br /><br />
    <section>
      <div class="container">
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" value="Notas de Crédito" class="btn btn-secondary notasDeCredito" />
            </div>
            <div class="container col-md-4">
              <input type="button" value="Pedidos" class="btn btn-secondary pedidos" />
            </div>
            <div class="container col-md-4">
              <input type="button" value="Cartas Factura" class="btn btn-secondary cartasFactura" />
            </div>
          </div>
          <br />
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" value="Captura SAE" class="btn btn-secondary capturaSae" />
            </div>
            <div class="container col-md-4">
              <input type="button" value="Listas de Precios" class="btn btn-secondary listasDePrecios" />
            </div>
            <div class="container col-md-4">
              <input type="button" value="Caja" class="btn btn-secondary caja" />
            </div>
          </div>
          <br />
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" value="Altas" class="btn btn-secondary altas" />
            </div>
            <div class="container col-md-4">
              <input type="button" value="Muestras" class="btn btn-secondary muestras" />
            </div>
            <div class="container col-md-4">
              <input type="button" value="Cotizaciones" class="btn btn-secondary cotizaciones" />
            </div>
          </div>
     </div>
    </section>
  </body>
</html>
