<?php
  require_once("../../funciones.php");
  $solicitante = $_POST['solicitante'];
  $idSolicitante = $_POST['idSolicitante'];
  $idUsuario = $_POST['idUsuario'];
  $total = $_POST['total'];
  $cantidad = $_POST['cantidad'];
  $clave = $_POST['clave'];
  $contador = $_POST['contador'];
  $resultados = array();

  //Obtenemos la clave de la Muestra
  $base = conexion_local();
  $consulta = "SELECT idMuestras FROM MUESTRAS ORDER BY IDMUESTRAS DESC";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  $registro = $resultado->fetch(PDO::FETCH_ASSOC);
  $idMuestra = $registro["idMuestras"];
  $folio = $idMuestra;
  $folio++;
  $folio = "M-" . $folio;
  $resultado->closeCursor();

  //Obtenemos la fecha de la Muestra
  $fecha = date("d/m/Y");

  //Obtenemos el idUsuario
  $consulta = "SELECT idUsuario FROM USUARIOS WHERE USUARIO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($idUsuario));
  $resgistro = $resultado->fetch(PDO::FETCH_ASSOC);
  $idUsuario = $resgistro["idUsuario"];
  $resultado->closeCursor();

  //Insertamos en la tabla Muestras, dependiendo del solicitante se selecciona la consulta
  $consulta = "INSERT INTO MUESTRAS (IDMUESTRAS, CLAVE, FECHA, IDCLIENTE, IDVENDEDOR, IDUSUARIO, TOTAL) VALUES(?,?,?,?,?,?,?)";
  $resultado = $base->prepare($consulta);
  if($solicitante=="vendedor"){
    $resultado->execute(array(NULL, $folio, $fecha, 0, $idSolicitante, $idUsuario, $total));
    $resultados[0] = $resultado->rowCount();
  }
  else{
    $resultado->execute(array(NULL, $folio, $fecha, $idSolicitante, 0, $idUsuario, $total));
    $resultados[0] = $resultado->rowCount();
  }
  $resultado->closeCursor();

  //Obtenemos el id de la Muestra
  $idMuestra++;
  //Obtenemos idProductosAPAPrecio de cada producto
  for ($i=1; $i < $contador; $i++) {
    $consulta = "SELECT idProductosAPAPrecio FROM PRODUCTOS_APA_PRECIO INNER JOIN PRODUCTOS_APA
                 ON PRODUCTOS_APA_PRECIO.IDAPA=PRODUCTOS_APA.IDAPA WHERE CLAVE=? AND IDLISTASPRECIO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($clave[$i], 1));
    $resgistro = $resultado->fetch(PDO::FETCH_ASSOC);
    $clave[$i] = $resgistro["idProductosAPAPrecio"];
  }
  $resultado->closeCursor();
  //Insertamos en la tabla Muestras_Productos
  for ($i=1; $i < $contador ; $i++){
    $consulta = "INSERT INTO MUESTRAS_PRODUCTOS(IDMUESTRAS,IDPRODUCTOSAPAPRECIO,CANTIDAD, ORDEN) VALUES(?,?,?,?)";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($idMuestra, $clave[$i], $cantidad[$i], $i));
    $resultados[0] = "Carga Exitosa";
  }
  $resultado->closeCursor();
  $base = null;
  echo json_encode($resultados);
?>
