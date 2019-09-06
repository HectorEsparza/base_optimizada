<!DOCTYPE html>
<html>
<head>
	<title>Visualización de Muestras</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/cierre.js"></script>
  <script src="../js/cierresInactividad.js"></script>
	<script src="../js/paginator.min.js"></script>
	<script src="../js/funciones.js"></script>
  <script src="ajax/eventos/muestra.js"></script>
	<script src="ajax/eventos/registrosMuestras.js"></script>
</head>
<body>
	<?php session_start();
	$usuario = $_SESSION['user'];

	if(!isset($usuario))
	{
		header("location:../index.html");
	}

	?>
	<header class="row">
		<div class="container col-md-6">
			<h1 align='center'>
				Visualización de Muestras
			</h1>
			<input type='button' id="home" class="btn btn-primary" style='background:url("../imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
			<div align="center"><img src="../imagenes/apa.jpg" /></div>
		</div>
		<div class="container col-md-6">
      <input style="float: right;" type="button" id="cierres" value="Cierra Sesión" class="btn btn-danger" />
			<input style="float: right;" type="button" id="nuevaMuestra" value='Nueva Muestra'class="btn btn-success" />
		</div>
	</header>
	<section>
		<div class="container" align="center">
				<h3>Filtro de Búsqueda</h3>
						 <br />

						 <input type="hidden" id="gerente" value="<?= $usuario?>" />
						 <input type="text" id="idCobranza" class="idCobranza" placeholder="ID Cobranza"/>
						 <input type="text" id="fecha" class="fecha" placeholder="Fecha"/>
						 <br /><br />
						 <input type="button" class="btn btn-primary" id="buscar" value="Buscar" />
						 <!-- <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button> -->
						 <input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />

				<input type=hidden id="folio" value="<?= $folio?>"/>
		</div>
		<br /><br />

	<div class="container" id="principal">
	<!--<table class="table table-striped table-hover">-->
	<table  border=1 align='center' width="1200px" style="text-align: center;">
		<thead>
			<tr style="font-weight: bold;">
				<td>Folio</td>
				<td>Fecha</td>
				<td>ID Solicitante</td>
				<td>Solicitante</td>
				<td>Documentador</td>
				<td>Total</td>
        <td>Info</td>
			</tr>
		</thead>
		<tbody id="table">

		</tbody>
	</table>
	<div class="col-md-12 text-center">
		<ul class="pagination" id="paginador"></ul>
	</div>

	</div>

<script type="text/javascript">


			$(document).ready(function(){

									$('#tag').autocomplete({
											source: function(request, response){
													$.ajax({
															url:"colores.php",
															dataType:"json",
															data:{q:request.term},
															success: function(data){
																	response(data);
															}
													});
											},
											minLength:3,
											select: function(event, ui){
													//alert("Selecciono: "+ui.item.label);
											}
									});
									$("#home").click(function(){

										setTimeout("location.href='../home.php'", 500);
									});


				$('#fecha').datepicker();
				$("#cargar").click(function(){
					setTimeout("location.href='cargarFacturas.php'", 500);
				});

				var departamento = $("#departamento").val();
				var permiso = $("#permiso").val();
				if(departamento=="COBRANZA" || departamento=="COBRANZA_TECAMAC"){
					$("#factura").hide();
					$("#sinEntrada").hide();
					$("#cargarFacturas").hide();
				}
				else if(departamento=="CREDITO_Y_COBRANZA"){
					$("#nuevaCobranzaFacturas").hide();
					$("#nuevaCobranzaRemisiones").hide();
					if(permiso==1){
						$("#nuevaCobranza").hide();
					}
					else if(permiso==2){
						$("#nuevaCobranza").hide();
						$("#cargarFacturas").hide();
					}

				}
			});


      function nuevoFacturas(){
          setTimeout("location.href='nuevaCobranzaFacturas.php'",500);
      }
			function nuevoRemisiones(){
          setTimeout("location.href='nuevaCobranzaRemisiones.php'",500);
      }
			function visualizar(){
          setTimeout("location.href='visualizacion.php'",500);
      }
			function ver(folio){
					setTimeout("location.href='impresion.php?folio="+folio+"'");
			}
			function facturas(){
				setTimeout("location.href='facturas.php'",500);
			}
			function facturasSinEntrada(){
				setTimeout("location.href='facturasSinEntrada.php'",500);
			}


</script>
</body>
</html>
