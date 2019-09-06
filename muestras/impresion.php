<!DOCTYPE html>
<html>
  <head>
  	<title>Impresión</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/cierre.js"></script>
    <script src="../js/cierresInactividad.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="ajax/eventos/formatoImpresion.js"></script>
    <script src="ajax/eventos/formatoImpresion.js"></script>
    <script src="ajax/eventos/visualizacion.js"></script>
    <script src="ajax/eventos/imprimir.js"></script>
  </head>
  <body>
        <?php
          session_start();
          $usuario = $_SESSION['user'];
          if(!isset($usuario))
          {
            header("location:../index.html");
          }
          $folio = $_GET['folio'];
        ?>
        <div class="col-md-8">
          <p style="font-weight: bold;"><img src="../imagenes/apa.jpg" />
            <input type="button" class="btn btn-primary btn-sm" value="Imprimir" id="impresion" style="margin-left: 30px;"/>
            <input type="button" class="btn btn-info btn-sm" value="Regresar" id="visualizacion" style="margin-left: 30px;"/>
      			<input class="btn btn-danger btn-sm" type='button' value='Cierra Sesión' id="cierres" style="margin-left: 30px;"/>
          </p>
          <table width='850px' border="1" style="text-align: center;">
            <tr>
              <td colspan="5" style="background-color: gray; font-weight:bold;">ABASTECEDORA DE PRODUCTOS AUTOMOTRICES, SOLICITUD DE MUESTRAS</td>
            </tr>
            <tr>
              <td><strong>Folio<strong></td>
              <td colspan="4" id="resultadoFolio"><?= $folio ?></td>
            </tr>
            <tr>
              <td><strong>Fecha<strong></td>
              <td colspan="4" id="resultadoFecha"></td>
            </tr>
            <tr>
              <td><strong>ID Solicitante</strong></td>
              <td id="idSolicitante" colspan="4"></td>
            </tr>
            <tr>
              <td><strong>Nombre Solicitante</strong></td>
              <td id="nombreSolicitante" colspan="4"></td>
            </tr>
            <tr>
              <td colspan="5"><strong>Partidas</strong></td>
            </tr>
            <tr style="font-weight: bold;">
              <td>Cantidad</td>
              <td>Clave</td>
              <td>Descripción</td>
              <td>Costo</td>
              <td>Importe</td>
            </tr>
            <tbody id="cuerpo">

            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"><strong>Elaboro, Departamento de Ventas</strong></td>
                <td><strong>Subtotal</strong></td>
                <td id="subtotal"></td>
              </tr>
              <tr>
                <td id="documentador" colspan="3" rowspan="2">&nbsp;</td>
                <td><strong>IVA</strong></td>
                <td id="iva"></td>
              </tr>
    					<tr>
    						<td><strong>Total</strong></td>
    						<td id="total"></td>
              </tr>
            </tfoot>
          </table>
          <br />
        </div>
  </body>
</html>
