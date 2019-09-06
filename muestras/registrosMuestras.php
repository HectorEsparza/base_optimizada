<?php
// obtiene los valores para realizar la paginacion
$limit = isset($_POST["limit"]) && intval($_POST["limit"]) > 0 ? intval($_POST["limit"])	: 20;
$offset = isset($_POST["offset"]) && intval($_POST["offset"])>=0	? intval($_POST["offset"])	: 0;
// realiza la conexion
//$con = new mysqli("50.62.209.84","hesparza","b29194303","aplicacion");
$con = new mysqli("localhost","root","","aplicacion_2.0");
$con->set_charset("utf8");
//$base = new PDO('mysql:host=localhost; dbname=aplicacion', 'root', '');
//$base = new PDO("mysql:host=50.62.209.117;dbname=aplicacion","hesparza","b29194303");
//$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//$base->exec("SET CHARACTER SET utf8");

// array para devolver la informacion
$json = array();
$data = array();
//consulta que deseamos realizar a la db
//$query = $con->prepare("select id_usuario,nombres,apellidos from  usuarios limit ? offset ?");

//El limite empieza con 10 y el Offset con 0

$query = $con->prepare("SELECT IDMUESTRAS, MUESTRAS.CLAVE, FECHA, MUESTRAS.IDCLIENTE, MUESTRAS.IDVENDEDOR, CLIENTES.NOMBRE,
												VENDEDOR.NOMBRE, USUARIOS.NOMBRE, USUARIOS.APELLIDO, TOTAL FROM MUESTRAS INNER JOIN CLIENTES
												ON MUESTRAS.IDCLIENTE=CLIENTES.IDCLIENTE INNER JOIN VENDEDOR
												ON MUESTRAS.IDVENDEDOR=VENDEDOR.IDVENDEDOR INNER JOIN USUARIOS
												ON MUESTRAS.IDUSUARIO=USUARIOS.IDUSUARIO ORDER BY IDMUESTRAS DESC LIMIT ? OFFSET ?");
$query->bind_param("ii",$limit,$offset);
$query->execute();

// vincular variables a la sentencia preparada
//$query->bind_result($id_usuario, $nombres,$apellidos);
$query->bind_result($id, $folio, $fecha, $idCliente, $idVendedor, $nombreCliente, $nombreVendedor, $nombreDocumentador, $apellidoDocumentador, $total);

// obtener valores
while ($query->fetch()) {
	$data_json = array();

	$data_json["id"] = $id;
	$data_json["folio"] = $folio;
	$data_json["fecha"] = $fecha;
	$data_json["idCliente"] = $idCliente;
	$data_json["idVendedor"] = $idVendedor;
	$data_json["nombreCliente"] = $nombreCliente;
	$data_json["nombreVendedor"] = $nombreVendedor;
	$data_json["nombreDocumentador"] = $nombreDocumentador;
	$data_json["apellidoDocumentador"] = $apellidoDocumentador;
	$data_json["total"] = $total;
	$data[]=$data_json;
}

// obtiene la cantidad de registros
$cantidad_consulta = $con->query("select count(*) as total from MUESTRAS");
$row = $cantidad_consulta->fetch_assoc();
$cantidad['cantidad']=$row['total'];


$json["lista"] = array_values($data);
$json["cantidad"] = array_values($cantidad);

// envia la respuesta en formato json
header("Content-type:application/json; charset = utf-8");
echo json_encode($json);
exit();
?>
