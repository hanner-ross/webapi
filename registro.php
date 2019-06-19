<?php
    if (isset($_POST['registrar'])){
      if ($_POST['usuario']!="" && $_POST['password']!="" && $_POST['nombre']!="" && $_POST['lastname']!="" && $_POST['userid']!="") {

        $data = array(
          'user' => $_POST['usuario'],
          'password' => $_POST['password'],
          'name' => $_POST['nombre'],
          'last_name' => $_POST['lastname'],
          'id_number' => $_POST['userid']
        );
        //API URL
        $url = 'http://127.0.0.1:8000/usuarios/';
        //create a new cURL resource
        $ch = curl_init($url);
        $payload = json_encode($data);
        //attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        //set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute the POST request
        $result = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        echo $result;
      }
      else{
        echo "<script type=''>
        alert('Por favor diligencie todos los campos.');
        </script>"; 
      }
    }
  if (isset($_POST['cancelar'])){
      header('Location: Index.php');
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
            <!-- <img class="imagen" src="Captura.png"> -->
            <div class="panel-body">
              <form role="form" name="form-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                <fieldset>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese un nombre de usuario o correo electrónico" name="usuario" autofocus>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese una contraseña" name="password" type="password">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese su nombre" name="nombre" autofocus>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese su apellido" name="lastname" autofocus>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese su numero de identificacion" name="userid" autofocus>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Ingrese una foto de perfil" name="foto" type="file">
                  </div>
                    <input type="submit" name="registrar" value="Registrar" class="btn btn-lg btn-success btn-block inicio-boton">
                    <input type="submit" name="cancelar" value="Cancelar" class="btn btn-lg btn-success btn-block inicio-boton">
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
