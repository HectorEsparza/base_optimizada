<?php
  require_once("../funciones.php");
  $usuario = $_POST['usuario'];
  $modulo = $_POST['modulo'];
  $datos = array();

  $base = conexion_local();
  $consulta = "SELECT * FROM USUARIOS INNER JOIN USUARIOS_MODULOS ON USUARIOS.IDUSUARIO=USUARIOS_MODULOS.IDUSUARIO
               INNER JOIN MODULOS ON USUARIOS_MODULOS.IDMODULO=MODULOS.IDMODULO WHERE USUARIO=? AND MODULOS.NOMBRE=?";

  $resultado = $base->prepare($consulta);
  $resultado->execute(array($usuario, $modulo));
  $registro = $resultado->fetch(PDO::FETCH_ASSOC);
  $datos[0] = $resultado->rowCount();
  $datos[1] = $registro["Enlace"];
  $resultado->closeCursor();
  $base = null;

  echo json_encode($datos);
?>
