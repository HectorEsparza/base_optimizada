<?php
//Función para obtener el día de la semana dada una fecha
function saber_dia($nombredia){
  $nombredia = explode("/", $nombredia);
  $dia = $nombredia[0];
  $mes = $nombredia[1];
  $mes = intval($mes);
  $anio = $nombredia[2];
  $nombredia = $nombredia[2]."-".$nombredia[1]."-".$nombredia[0];
  $dias = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
  $meses = array('','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
  $fecha = $dias[date('N', strtotime($nombredia))];
  echo "Reporte de Cobranza ".$fecha." ".$dia." de ".$meses[$mes]." del ".$anio;
  //echo $nombredia;
}
//Funcion para realizar los calculos del reporte de precios
function reportePrecios($precioApa = array(), $precioVazlo = array(), $descuentoApa, $descuentoVazlo, $importancia = array(), $idApa = array(), $idVazlo = array()){
  $variacion = 0;
  $variacionPesos = 0;
  $caros = 0;
  $iguales = 0;
  $baratos = 0;
  $porcentajeCaro = 0;
  $porcentajeIgual = 0;
  $porcentajeBarato = 0;
  $contador = count($precioApa);
  $importanciaCaros = [0,0,0];
  $importanciaIguales = [0,0,0];
  $importanciaBaratos = [0,0,0];
  $indicador = array();
  $variacionCaro = 0;
  $variacionBarato = 0;
  $variacionPesosCaro = 0;
  $variacionPesosBarato = 0;

  for ($i=0; $i < $contador; $i++){
    //Tomamos los precios y le sacamos el descuento que le corresponde
    $precioApa[$i] = round((sub($descuentoApa, $precioApa[$i]))*100)/100;
    $precioVazlo[$i] = round((sub($descuentoVazlo, $precioVazlo[$i]))*100)/100;
    //Sacamos la variación por porcentaje
    $variacion = $variacion+(($precioVazlo[$i]/$precioApa[$i]-1)*100);
    //Sacamos la variación por dinero
    $variacionPesos = $variacionPesos+($precioVazlo[$i]-$precioApa[$i]);
    if($precioApa[$i]>$precioVazlo[$i]||$precioApa[$i]==$precioVazlo[$i]){

      if($importancia[$i]=="A"){
        $importanciaCaros[0] += 1;
      }
      else if($importancia[$i]=="B"){
        $importanciaCaros[1] += 1;
      }
      else if($importancia[$i]=="C"){
        $importanciaCaros[2] += 1;
      }
      $indicador[$i] = "Caro";
      //Variacion por porcentaje de los productos Caros
      $variacionCaro = $variacionCaro+(($precioVazlo[$i]/$precioApa[$i]-1)*100);
      //Variacion por pesos de los productos Caros
      $variacionPesosCaro = $variacionPesosCaro+($precioVazlo[$i]-$precioApa[$i]);
      $caros++;
    }
    elseif ($precioApa[$i]<$precioVazlo[$i]){

      if($importancia[$i]=="A"){
        $importanciaBaratos[0] += 1;
      }
      else if($importancia[$i]=="B"){
        $importanciaBaratos[1] += 1;
      }
      else if($importancia[$i]=="C"){
        $importanciaBaratos[2] += 1;
      }
      $indicador[$i] = "Barato";
      //Variacion por porcentaje de los productos Baratos
      $variacionBarato = $variacionBarato+(($precioVazlo[$i]/$precioApa[$i]-1)*100);
      //Variacion por pesos de los productos Caros
      $variacionPesosBarato = $variacionPesosBarato+($precioVazlo[$i]-$precioApa[$i]);
      $baratos++;
    }
    // else{
    //   $iguales++;
    //   if($importancia[$i]=="A"){
    //     $importanciaIguales[0] += 1;
    //   }
    //   else if($importancia[$i]=="B"){
    //     $importanciaIguales[1] += 1;
    //   }
    //   else if($importancia[$i]=="C"){
    //     $importanciaIguales[2] += 1;
    //   }
    //   $indicador[$i] = "Igual";
    // }

  }
  //Si se encontraron al menos 1 producto en la consulta
  if($contador>0){
    //Sacando el promedio de la variacion y redondeando
    $variacion = $variacion/$contador;
    $variacion = round($variacion * 100)/100;
    //Sacando el promedio de la variacion de Caros y redondeando
    $variacionCaro = $variacionCaro/$contador;
    $variacionCaro = round($variacionCaro * 100)/100;
    //Sacando el promedio de la variacion de Baratos y redondeando
    $variacionBarato = $variacionBarato/$contador;
    $variacionBarato = round($variacionBarato * 100)/100;
    //Dandole formato a la variacion por dinero
    $variacionPesos = $variacionPesos/$contador;
    $variacionPesos = round($variacionPesos * 100)/100;
    $variacionPesos = number_format($variacionPesos, 2, '.', ',');
    //Dandole formato a la variacion por dinero de productos Caros
    $variacionPesosCaro = $variacionPesosCaro/$contador;
    $variacionPesosCaro = round($variacionPesosCaro * 100)/100;
    $variacionPesosCaro = number_format($variacionPesosCaro, 2, '.', ',');
    //Dandole formato a la variacion por dinero de productos Baratos
    $variacionPesosBarato = $variacionPesosBarato/$contador;
    $variacionPesosBarato = round($variacionPesosBarato * 100)/100;
    $variacionPesosBarato = number_format($variacionPesosBarato, 2, '.', ',');
    //Sacando el porcentaje de Caros
    $porcentajeCaro = ($caros*100)/$contador;
    $porcentajeCaro = round($porcentajeCaro * 100)/100;
    //Sacando el porcentaje de Baratos
    $porcentajeBarato = ($baratos*100)/$contador;
    $porcentajeBarato =  round($porcentajeBarato * 100)/100;
    //Sacando el porcentaje de Iguales
    $porcentajeIgual = ($iguales*100)/$contador;
    $porcentajeIgual =  round($porcentajeIgual * 100)/100;
  }

  $arregloPrueba = ["Hola", "APA"];
  $resultados = array($contador, $variacion, $variacionPesos, $porcentajeCaro, $caros, $porcentajeIgual, $iguales,
                      $porcentajeBarato, $baratos, $importancia, $idApa, $precioApa, $idVazlo, $precioVazlo, $importanciaCaros,
                      $importanciaIguales, $importanciaBaratos, $indicador, $variacionCaro, $variacionBarato,
                      $variacionPesosCaro, $variacionPesosBarato);
  // $resultados[9][0] = "Hola";
  // $resultados[9][1] = "Amigos";

  return $resultados;
}
//Consecutivo pedidos
function folioRemision(){

  $base = conexion_local();
  $consulta = "SELECT FOLIOINTERNO FROM REMISION";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
      $consecutivo = $registro[0];
      // echo $consecutivo . "<br />";
  }
  if($consecutivo=="")
  {
    $folio = "F3-1";
  }
  else
  {
    $separador = explode("-", $consecutivo);
    $folio = "F3-" . ($separador[1]+1);
    //$folio = $separador[1]+1;

  }

  return $folio;
}
function folioPedidos(){

  $base = conexion_local();
  $consulta = "SELECT FOLIOINTERNO FROM PEDIDOS";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
      $consecutivo = $registro[0];
      // echo $consecutivo . "<br />";
  }
  if($consecutivo=="")
  {
    $folio = "PD-1";
  }
  else
  {
    $separador = explode("-", $consecutivo);
    $folio = "PD-" . ($separador[1]+1);
    //$folio = $separador[1]+1;

  }

  return $folio;
}
//Consecutivo cartas factura
function folioCartas($tipo_dev){

  $aux = 0;
  $base = conexion_local();
  $consulta = "SELECT FOLIOINTERNO FROM CARTAS WHERE TIPO=? ORDER BY TIPO";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($tipo_dev));
  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
      $consecutivo = $registro[0];
      // echo $consecutivo . "<br />";
  }

  // echo $consecutivo;
  $aux = explode('.', $tipo_dev);
  if($consecutivo=="")
  {
    if($aux[0]==1)
    {
      $folio = 'CF-1';
    }
    else{
      $folio = 'F3-1';
    }
    return $folio;
  }
  else
  {
    switch ($aux[0])
    {
      case '1':
      $x = explode('-', $consecutivo);
      $con = $x[1]+1;
      $folio = 'CF-' . $con;
      return $folio;
        break;
      case '2':
      $x = explode('-', $consecutivo);
      $con = $x[1]+1;
      $folio = 'F3-' . $con;
      return $folio;
        break;
      default:

        break;
    }
  }

  // $base = conexion_local();
  // $consulta = "SELECT FOLIOINTERNO FROM CARTAS";
  // $resultado = $base->prepare($consulta);
  // $resultado->execute(array());
  // while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
  //     $consecutivo = $registro[0];
  //     // echo $consecutivo . "<br />";
  // }
  // if($consecutivo=="")
  // {
  //   $folio = "CF-1";
  // }
  // else
  // {
  //   $separador = explode("-", $consecutivo);
  //   $folio = "CF-" . ($separador[1]+1);
  //   //$folio = $separador[1]+1;
  //
  // }
  //
  // return $folio;
}
//Devuelve el tamaño que tendrá la tabla, recibe un arreglo
function tamanoTabla($arreglo = array()){
  $tamano = count($arreglo);
  if($tamano<=10){
    $contador = 11;
  }
  else{
    $contador = $tamano+1;
  }

  return $contador;
}
//calcula el total de la penalizacion que se va a aplicar, recibe el total de la
//nota y el porcentaje que se le va a restar
function calculoPenalizacion($porcentaje, $total){

  $porcentaje = $porcentaje/100;
  $descuento = $total*$porcentaje;
  $descuento = round($descuento * 100) / 100;
  $resultado = $total-$descuento;
  return $resultado;
}

function convertidorDescuento($texto){

  //separa el string en dos cadenas
  $cadena = explode("%", $texto);

  return $cadena[0];
}
//funcion que recibe un string de la forma $1,243.76 y lo convierte a su parte numerica equivalente a 1243.76
function convertidorNumeros($texto){

  //separa el string en dos cadenas
  $cadena = explode("$", $texto);
  //remplaza las comas de la cadena por nada
  $numero = str_replace(",", "", $cadena[1]);
  //regresa un numero para que se pueda operar con el
  return $numero;
}
//Cambia fecha a formato standar
function fechaStandar($fecha){
           //echo $fecha;
           $nueva = explode("-", $fecha);
           echo $nueva[2] . "/" . $nueva[1] . "/" . $nueva[0];

}
//Cambia fecha a formato fechaJquery
function fechaJquery($fecha){
           //echo $fecha;
           $nueva = explode("-", $fecha);
           echo $nueva[2] . "/" . $nueva[1] . "/" . $nueva[0];

}

//Cambia formato fecha base de datos
function fechaConsulta($fecha){

  $particion = explode("/", $fecha);
  $nueva = $particion[2] . "-" . $particion[1] . "-" . $particion[0];
  return $nueva;

}
//conexion base de datos local y en producción

function conexion_local(){




  $base = new PDO("mysql:host=localhost;dbname=aplicacion_2.0","root","");
  //$base = new PDO("mysql:host=50.62.209.84;dbname=aplicacion","hesparza","b29194303");
  //$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $base->exec("SET CHARACTER SET utf8");
  return $base;
}
//Devuelve el mes para la nota de credito
function mes_sae($fecha){
  $division = explode("-", $fecha);

  if($division[1]=='01'){
    echo "Enero";
  }
  elseif($division[1]=='02'){
    echo "Febrero";
  }
  elseif($division[1]=='03'){
    echo "Marzo";
  }
  elseif($division[1]=='04'){
    echo "Abril";
  }
  elseif($division[1]=='05'){
    echo "Mayo";
  }
  elseif($division[1]=='06'){
    echo "Junio";
  }
  elseif($division[1]=='07'){
    echo "Julio";
  }
  elseif($division[1]=='08'){
    echo "Agosto";
  }
  elseif($division[1]=='09'){
    echo "Septiembre";
  }
  elseif($division[1]=='10'){
    echo "Octubre";
  }
  elseif($division[1]=='11'){
    echo "Noviembre";
  }
  else{
    echo "Diciembre";
  }

}

//calcula importe, recibe cantidad y precio
function imp($can , $pre)
{
 $imp2 = $can*$pre;
 $imp2 = round($imp2 * 100) / 100;
 if($imp2%1==0){
   return $imp2 . ".00";
 }
 else{
   return $imp2;
 }
}

//calcula subtotal de cada producto, recibe descuento e importe
function sub($desc, $imp)
{
 if($desc!=0)
 {
 $x = $desc / 100;
 $y = $imp * $x;
 $w = round($y * 100) / 100;
 $z = $imp-$w;
 return $z;
 }

 else
 {
   return $imp;
 }
}
//añade un porcentaje
function subAdicional($desc, $imp)
{
 if($desc!=0)
 {
 $x = $desc / 100;
 $y = $imp * $x;
 $w = round($y * 100) / 100;
 $z = $imp+$w;
 return $z;
 }

 else
 {
   return $imp;
 }
}

//calcula subtotal de toda la nota, recibe el arreglo de subtotales
function subtotal($x = array())
{
  $cont = 0;
  for ($i=1; $i <= count($x) ; $i++)
  {
    $cont = $cont + $x[$i];
  }
  return $cont;
}

//calcula el iva de la nota, recibe el subtotal de la nota
function iva($sub)
{
  $x = $sub*.16;
  $y = round($x * 100) / 100;
  if($y%1==0){
    return $y . ".00";
  }
  else{
    return $y;
  }
}

//Calcula el precio con iva incluido, recibe el precio
function impuesto($precio)
{
  $x = $precio*.16;
  $y = round($x * 100) / 100;
  $z = $precio+$y;
  return $z;
}

//calcula el total de la nota, recibe el subtotal e iva de la nota
function total($sub, $iva)
{
  $total = $sub+$iva;
  return $total;
}

/*!
  @function num2letras ()
  @abstract Dado un número lo devuelve escrito.
  @param $num number - Número a convertir.
  @param $fem bool - Forma femenina (true) o no (false).
  @param $dec bool - Con decimales (true) o no (false).
  @result string - Devuelve el número escrito en letra.

*/
function num2letras($num, $fem = false, $dec = true)
{
   $matuni[2]  = "DOS";
   $matuni[3]  = "TRES";
   $matuni[4]  = "CUATRO";
   $matuni[5]  = "CINCO";
   $matuni[6]  = "SEIS";
   $matuni[7]  = "SIETE";
   $matuni[8]  = "OCHO";
   $matuni[9]  = "NUEVE";
   $matuni[10] = "DIEZ";
   $matuni[11] = "ONCE";
   $matuni[12] = "DOCE";
   $matuni[13] = "TRECE";
   $matuni[14] = "CATORCE";
   $matuni[15] = "QUINCE";
   $matuni[16] = "DIECISEIS";
   $matuni[17] = "DIECISIETE";
   $matuni[18] = "DIECIOCHO";
   $matuni[19] = "DIECINUEVE";
   $matuni[20] = "VEINTE";
   $matunisub[2] = "DOS";
   $matunisub[3] = "TRES";
   $matunisub[4] = "CUATRO";
   $matunisub[5] = "QUIN";
   $matunisub[6] = "SEIS";
   $matunisub[7] = "SETE";
   $matunisub[8] = "OCHO";
   $matunisub[9] = "NOVE";

   $matdec[2] = "VEINT";
   $matdec[3] = "TREINTA";
   $matdec[4] = "CUARENTA";
   $matdec[5] = "CINCUENTA";
   $matdec[6] = "SESENTA";
   $matdec[7] = "SETENTA";
   $matdec[8] = "OCHENTA";
   $matdec[9] = "NOVENTA";
   $matsub[3]  = 'MILL';
   $matsub[5]  = 'BILL';
   $matsub[7]  = 'MILL';
   $matsub[9]  = 'TRILL';
   $matsub[11] = 'MILL';
   $matsub[13] = 'BILL';
   $matsub[15] = 'MILL';
   $matmil[4]  = 'MILLONES';
   $matmil[6]  = 'BILLONES';
   $matmil[7]  = 'DE BILLONES';
   $matmil[8]  = 'MILLONES DE BILLONES';
   $matmil[10] = 'TRILLONES';
   $matmil[11] = 'DE TRILLONES';
   $matmil[12] = 'MILLONES DE TRILLONES';
   $matmil[13] = 'DE TRILLONES';
   $matmil[14] = 'BILLONES DE TRILLONES';
   $matmil[15] = 'DE BILLONES DE TRILLONES';
   $matmil[16] = 'MILLONES DE BILLONES DE TRILLONES';

   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num);
   if ($num[0] == '-') {
      $neg = 'MENOS ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros) {
      $fin = ' COMA';
      for ($n = 0; $n < strlen($fra); $n++) {
         if (($s = $fra[$n]) == '0')
            $fin .= ' CERO';
         elseif ($s == '1')
            $fin .= $fem ? ' UNA' : ' UN';
         else
            $fin .= ' ' . $matuni[$s];
      }
   }else
      $fin = '';
   if ((int)$ent === 0) return 'CERO ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   while ( ($num = substr($ent, -3)) != '   ') {
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'UNA';
         $subcent = 'AS';
      }else{
         $matuni[1] = $neutro ? 'UNO' : 'UN';
         $subcent = 'OS';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'I' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' Y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1) {
         $t = ' CIENTO' . $t;
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'IENT' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'CIENT' . $subcent . $t;
      }
      if ($sub == 1) {
      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' MIL';
         }elseif ($num > 1){
            $t .= ' MIL';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . '?n';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ONES';
      }
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   //Zi hack --> return ucfirst($tex);
   $end_num=ucfirst($tex).' PESOS '.$float[1].'/100 M.N.';
   return $end_num;
}

function fecha()
{
  date_default_timezone_set('America/Mexico_City');
  $fecha = date('Y-m-d');
  return $fecha;
}
function mes()
{
  date_default_timezone_set('America/Mexico_City');
  $x = date('m');
  if($x==1)
  {
    $mes = "Enero";
  }
  elseif ($x==2)
  {
    $mes = "Febrero";
  }
  elseif ($x==3)
  {
    $mes ="Marzo";
  }
  elseif ($x==4)
  {
    $mes = "Abril";
  }
  elseif ($x==5)
  {
    $mes = "Mayo";
  }
  elseif ($x==6)
  {
    $mes = "Junio";
  }
  elseif ($x==7)
  {
    $mes = "Julio";
  }
  elseif ($x==8)
  {
    $mes = "Agosto";
  }
  elseif ($x==9)
  {
    $mes = "Septiembre";
  }
  elseif ($x==10)
  {
    $mes = "Octubre";
  }
  elseif ($x==11)
  {
    $mes = "Noviembre";
  }
  else
  {
    $mes = "Diciembre";
  }

  return $mes;
}

function usuario($user)
{
  try
  {
    $base = conexion_local();
    $consulta = "SELECT NOMBRE, APELLIDO FROM USUARIOS WHERE USUARIO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($user));
    $registro = $resultado->fetch(PDO::FETCH_NUM);
    $usuario = $registro[0] . " " . $registro[1];
    $resultado->closeCursor();

    return $usuario;
  } catch (Exception $e)
  {
    die("<h1>ERROR: " . $e->GetMessage());
  }
  finally
  {
    $base = null;
  }
}

function usuarioNombre($user)
{
  try
  {
    $base = conexion_local();
    $consulta = "SELECT NOMBRE FROM USUARIOS WHERE USUARIO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($user));
    $registro = $resultado->fetch(PDO::FETCH_NUM);
    $usuario = $registro[0];
    $resultado->closeCursor();

    return $usuario;
  } catch (Exception $e)
  {
    die("<h1>ERROR: " . $e->GetMessage());
  }
  finally
  {
    $base = null;
  }
}

function usuarioApellido($user)
{
  try
  {
    $base = conexion_local();
    $consulta = "SELECT APELLIDO FROM USUARIOS WHERE USUARIO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($user));
    $registro = $resultado->fetch(PDO::FETCH_NUM);
    $usuario = $registro[0];
    $resultado->closeCursor();

    return $usuario;
  } catch (Exception $e)
  {
    die("<h1>ERROR: " . $e->GetMessage());
  }
  finally
  {
    $base = null;
  }
}

  //folio consecutivo, recibe el tipo de devolución

  function folio($tipo_dev)
  {


    $consecutivo = "";
    $aux = 0;
  	$base = conexion_local();
  	$consulta = "SELECT FOLIOINTERNO FROM NOTAS WHERE TIPO=? ORDER BY TIPO";
  	$resultado = $base->prepare($consulta);
  	$resultado->execute(array($tipo_dev));
  	while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
        if($consecutivo!=$registro[0]){
          $aux++;
        }
  			$consecutivo = $registro[0];

  			// echo $consecutivo . "<br />";
  	}
    $aux++;

  	switch ($tipo_dev){
  			case 'Devolución Parcial':
  			$folio = 'DP-' . $aux;
  			return $folio;
  				break;
  			case 'Factura Completa':
  			$folio = 'FC-' . $aux;
  			return $folio;
  				break;
  			case 'Entrada Caja':
  			$folio = 'EC-' . $aux;
  			return $folio;
  				break;
  			case 'Factor 3':
  			$folio = 'F3-' . $aux;
  			return $folio;
  				break;
  			case 'Cambio Físico':
  			$folio = 'CF-' . $aux;
  			return $folio;
  				break;
        case 'Entrada Caja Factor 3':
    		$folio = 'ECF3-' . $aux;
    		return $folio;
    				break;
        case 'Muestra':
        		$folio = 'M-' . $aux;
        		return $folio;
        				break;
  			default:

  				break;
  		}

    return $folio;
  }








?>
