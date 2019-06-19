<?php
    if (isset($_POST['ingresar'])){
      $usuario=$_POST['usuario'];
      $password=$_POST['password'];
      $data = json_decode( file_get_contents('http://127.0.0.1:8000/usuarios/'), true );
      foreach($data as $users){
        
        if ($users['user']==$usuario && $users['password']==$password) {
        $mensaje=$users['id'];  
        header("Location: Inicio.php?usuario=".urlencode($mensaje));
        
        }        
      }
      echo "<script type=''>
      alert('Usuario y contraseña no encontrados. Por favor registrate si todavia no tienes una cuenta con nosotros.');
      </script>"; 
     }
     if (isset($_POST['registrar'])){
        header('Location: registro.php');
     }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SAI - Inicio</title>
    <link href="Bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Bootstrap/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="Bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="Bootstrap/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="Estilos.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="col-lg-8">
          <div class="page-wrapper">
            <img class="imagen" src="Captura.png">
            <div class="panel-body">
              <form role="form" name="form-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                <fieldset>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese su usuario" name="usuario" autofocus>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese su contraseña" name="password" type="password">
                  </div>
                  <div class="checkbox">
                    <label>
                      <input name="remember" type="checkbox" value="Remember Me">Recordar contraseña
                    </label>
                  </div>
                    <input type="submit" name="ingresar" value="Ingresar" class="btn btn-lg btn-success btn-block inicio-boton">
                    <input type="submit" name="registrar" value="Registrar" class="btn btn-lg btn-success btn-block inicio-boton">
                </fieldset>
              </form>
            </div>
          </div>
        </div>
       
        <!-- jQuery -->
        <script src="Bootstrap/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="Bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="Bootstrap/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="Bootstrap/dist/js/sb-admin-2.js"></script>

    </body>

</html>
