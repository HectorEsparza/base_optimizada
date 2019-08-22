<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Comprueba</title>
  </head>
  <body>
    <?php
    require_once("funciones.php");
    //Programación PDO para inicio de sesión(LOGIN)
    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];
    $cont = 0;


    try
    {
    $base = conexion_local();
    $consulta = "SELECT * FROM USUARIOS WHERE USUARIO=?";
    $resultado = $base->prepare($consulta);
    $login = htmlentities(addslashes($usuario));
    $password = htmlentities(addslashes($contra));
    $resultado->execute(array($login));



    //$registro = $resultado->fetch(PDO::FETCH_NUM);
    //echo $registro[0];

    while ($registro = $resultado->fetch(PDO::FETCH_NUM))
    {

      if($password==$registro[0])
      {
         //echo "Hola<br />";
        header("location:cambio.php?user=" . $usuario);
      }
      if(password_verify($password, $registro[0]))
      {

        $cont++;
      }


    }

    if($cont==0){

      echo "<div class='container'>
              <h3>Usuario o Contraseña Incorrectos</h3>
                <a href='index.html'><input class='btn btn-primary' type='button' value='Volver'/></a>
            </div>";


    }


    else{
      session_start();
      $_SESSION['user'] = $usuario;
      header("location:home.php");
      // $consulta1="SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
      // $resultado1 = $base->prepare($consulta1);
      // $resultado1-> execute(array($usuario));
      // $registro1 = $resultado1->fetch(PDO::FETCH_NUM);
      //
      //
      //
      //
      //
      // if($registro1[0]=="VENTAS")
      // {
      //       header("location:nota.php");
      //       //echo "Bienvenid@ " . $_SESSION['user'];
      // }
      // elseif ($registro1[0]=="CREDITO Y COBRANZA")
      // {
      //       header("location:sae.php");
      //       //echo "<h1>Credito y Cobranza</h1>";
      // }
      // elseif ($registro1[0]=="SISTEMAS")
      // {
      //       //header("location:nota.php");
      //       echo "<h1>El padrino Esparza</h1>";
      // }
    }


    }
    catch (Exception $e)
    {
      die("<h1>ERROR: " . $e->GetMessage() . "</h1>");
    }
    finally
    {
      $base = null;
    }

    ?>
    <script src="ajax/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </body>
</html>
