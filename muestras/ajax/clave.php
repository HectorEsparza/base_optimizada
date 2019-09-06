<?php
  require_once("../../funciones.php");
  $clave = $_POST['clave'];
  $indice = $_POST['indice'];
  $resultados = array();

  $base = conexion_local();
  $consulta = "SELECT * FROM PRODUCTOS_APA INNER JOIN PRODUCTOS_APA_PRECIO ON PRODUCTOS_APA.idAPA=PRODUCTOS_APA_PRECIO.idAPA
               INNER JOIN PRECIO ON PRODUCTOS_APA_PRECIO.idPrecio=PRECIO.idPrecio WHERE CLAVE=? AND IDLISTASPRECIO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($clave, 1));
  $registro = $resultado->fetch(PDO::FETCH_ASSOC);
  $resultados[0] = $resultado->rowCount();
  $resultados[1] = $indice;
  $resultados[2] = $clave;
  $resultados[3] = $registro["Descripcion"];
  $resultados[4] = $registro["Importe"];
  $resultado->closeCursor();
  $base = null;
  echo json_encode($resultados);
?>
