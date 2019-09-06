<!DOCTYPE html>
<html>
<head>
	<title>Nueva Muestra</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/cierre.js"></script>
  <script src="../js/cierresInactividad.js"></script>
	<script src="../js/funciones.js"></script>
  <script src="ajax/eventos/visualizacion.js"></script>
  <script src="ajax/eventos/cargaTablaMuestras.js"></script>
  <script src="ajax/eventos/agregaFila.js"></script>
  <script src="ajax/eventos/llamarClienteVendedor.js"></script>
  <script src="ajax/eventos/cantidad.js"></script>
	<script src="ajax/eventos/clave.js"></script>
	<script src="ajax/eventos/guardar.js"></script>
</head>
<body>
	<?php
		session_start();
    $usuario = $_SESSION['user'];
		if(!isset($usuario))
		{
			header("location:../index.html");
		}
	?>
  <div class="row">
    <div class="container col-md-4" style="margin-left: 500px">
      <h1>Captura Nueva Muestra</h1>
    </div>
    <div class="container col-md-2">
      <input style="margin-top: 25px" type="button" id="visualizacion" class="btn btn-primary" value="Visualizar Muestras" />
    </div>
    <div class="container col-md-2">
      <input style="margin-top: 25px" type="button" id="cierres" class="btn btn-danger" value="Cierra Sesión"  />
    </div>
  </div>
  <br /><br />
  <div class="row">
    <div class="container col-md-12" style="margin-left: 400px">
      <table border="1" width="800px" style="text-align: center">
        <tr>
          <td colspan="5">
            <label>Cliente</label>
            <input type="radio" name="opcion" class="checar" value="cliente" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Vendedor</label>
            <input type="radio" name="opcion" class="checar" value="vendedor" />
          </td>
        </tr>
        <tr>
          <td>Folio</td>
          <td colspan="4" id="resultadoFolio"></td>
        </tr>
        <tr>
          <td id="idSolicitante">ID</td>
          <td colspan="4"><input type="number" min=1 class="opcion" readonly /></td>
        </tr>
        <tr>
          <td id="nombreSolicitante">Nombre</td>
          <td colspan="4" id="resultadoNombre"></td>
        </tr>
        <tr>
          <td colspan="5"><strong>Partidas</strong></td>
        </tr>
        <tr>
          <td><strong>Cantidad</strong></td>
          <td><strong>Clave</strong></td>
          <td><strong>Descripción</strong></td>
          <td><strong>Costo</strong></td>
          <td><strong>Importe</strong></td>
        </tr>
				<tbody id="cuerpo">

				</tbody>
				<tfoot>
          <tr>
            <td colspan="3">&nbsp;</td>
            <td><strong>Subtotal</strong></td>
            <td id="subtotal">$0</td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
            <td><strong>IVA</strong></td>
            <td id="iva">$0</td>
          </tr>
					<tr>
						<td colspan="2"><input type="button" value="Agregar" id="agregarFila" class="btn btn-info btn-sm" /></<td>
            <td><input type="button" value="Guardar" id="guardar" class="btn btn-success btn-sm" disabled/></td>
						<td><strong>Total</strong></td>
						<td id="total">$0</td>
            <input type="hidden" id="solicitante" value="">
            <input type="hidden" id="filas" value="10" />
						<input type="hidden" id="usuario" value="<?= $usuario ?>" />
          </tr>
				</tfoot>
      </table>
    </div>
  </div>
</body>
</html>
