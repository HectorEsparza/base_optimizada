<?php
  require_once("../../funciones.php");
  $solicitante = $_POST['solicitante'];
  $idSolicitante = $_POST['id'];

  $resultados = array();
  $folio = 0;
  $base = conexion_local();
  if($solicitante=="vendedor"){
    $consulta = "SELECT Nombre FROM VENDEDOR WHERE IDVENDEDOR=?";
  }
  else{
    $consulta = "SELECT Nombre FROM CLIENTES WHERE IDCLIENTE=?";
  }
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($idSolicitante));
  $resgistro = $resultado->fetch(PDO::FETCH_ASSOC);
  $resultados[0] = $resultado->rowCount();
  $resultados[1] = $resgistro["Nombre"];
  $resultados[2] = $solicitante;
  $resultados[3] = $idSolicitante;
  $resultado->closeCursor();

  $consulta = "SELECT idMuestras FROM MUESTRAS ORDER BY IDMUESTRAS DESC";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  $registro = $resultado->fetch(PDO::FETCH_ASSOC);
  $folio = $registro["idMuestras"];
  $folio++;
  $folio = "M-" . $folio;
  $resultado->closeCursor();
  $base = null;
  $resultados[4] = $folio;
  echo json_encode($resultados);

?>
