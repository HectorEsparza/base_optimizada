<?php
  require_once("../../funciones.php");
  $folio = $_POST['folio'];
  $fecha = "";
  $idCliente = 0;
  $idVendedor = 0;
  $nombreCliente = "";
  $nombreVendedor = "";
  $cantidad = array();
  $clave = array();
  $descripcion = array();
  $costo = array();
  $importe = array();
  $subtotal = 0;
  $iva = 0;
  $total = 0;
  $resultados = array();
  $contador = 0;
  $documentador = "";
  $base = conexion_local();

  //Obtenemos la información de la Muestra
  $consulta = "SELECT Fecha, CLIENTES.idCliente, CLIENTES.Nombre AS NombreCliente, VENDEDOR.idVendedor, VENDEDOR.Nombre AS NombreVendedor,
               Cantidad, PRODUCTOS_APA.Clave, Descripcion, Importe, Total, USUARIOS.Nombre AS NombreUsuario, USUARIOS.Apellido AS ApellidoUsuario
               FROM MUESTRAS INNER JOIN CLIENTES ON MUESTRAS.idCliente=CLIENTES.idCliente INNER JOIN VENDEDOR ON MUESTRAS.idVendedor=VENDEDOR.idVendedor
               INNER JOIN MUESTRAS_PRODUCTOS ON MUESTRAS.idMuestras=MUESTRAS_PRODUCTOS.idMuestras INNER JOIN PRODUCTOS_APA_PRECIO ON
               MUESTRAS_PRODUCTOS.idProductosAPAPrecio=PRODUCTOS_APA_PRECIO.idProductosAPAPrecio INNER JOIN PRODUCTOS_APA ON
               PRODUCTOS_APA_PRECIO.idAPA=PRODUCTOS_APA.idAPA INNER JOIN PRECIO ON PRODUCTOS_APA_PRECIO.idPrecio=PRECIO.idPrecio
               INNER JOIN USUARIOS ON MUESTRAS.idUsuario=USUARIOS.idUsuario WHERE MUESTRAS.Clave=? ORDER BY ORDEN";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($folio));
  while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $fecha = $registro["Fecha"];
    $idCliente = $registro["idCliente"];
    $nombreCliente = $registro["NombreCliente"];
    $idVendedor = $registro["idVendedor"];
    $nombreVendedor = $registro["NombreVendedor"];
    $cantidad[$contador] = $registro["Cantidad"];
    $clave[$contador] = $registro["Clave"];
    $descripcion[$contador] = $registro["Descripcion"];
    $costo[$contador] = $registro["Importe"];
    $importe[$contador] = imp($cantidad[$contador], $costo[$contador]);
    $subtotal += floatval($importe[$contador]);
    $iva = iva($subtotal);
    $total = $registro["Total"];
    $documentador = $registro["NombreUsuario"] . " " . $registro["ApellidoUsuario"];
    $contador++;

  }
  $resultado->closeCursor();
  $base = null;

  if($idCliente==0 && $idVendedor>0){
    $resultados["idSolicitante"] = $idVendedor;
    $resultados["nombreSolicitante"] = $nombreVendedor;
    $resultados["contador"] = $contador;
    $resultados["cantidad"] = $cantidad;
    $resultados["clave"] = $clave;
    $resultados["descripcion"] = $descripcion;
    $resultados["costo"] = $costo;
    $resultados["importe"] = $importe;
    $resultados["subtotal"] = $subtotal;
    $resultados["iva"] = $iva;
    $resultados["total"] = $total;
    $resultados["fecha"] = $fecha;
    $resultados["documentador"] = $documentador;
  }
  else{
    $resultados["idSolicitante"] = $idCliente;
    $resultados["nombreSolicitante"] = $nombreCliente;
    $resultados["contador"] = $contador;
    $resultados["cantidad"] = $cantidad;
    $resultados["clave"] = $clave;
    $resultados["descripcion"] = $descripcion;
    $resultados["costo"] = $costo;
    $resultados["importe"] = $importe;
    $resultados["subtotal"] = $subtotal;
    $resultados["iva"] = $iva;
    $resultados["total"] = $total;
    $resultados["fecha"] = $fecha;
    $resultados["documentador"] = $documentador;
  }

  echo json_encode($resultados);

?>
