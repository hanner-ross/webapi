<?php
    if (isset($_GET['usuario'])){
        $data = json_decode( file_get_contents('http://127.0.0.1:8000/usuarios/'.urlencode($_GET['usuario'])), true );
        $name=$data['name'];
        $lastname=$data['last_name'];
        $idnumber=$data['id_number'];
        $photo=$data['picture'];     
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Hanner Ross - Aplicación Web</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <img src="assets/images/useit.png" alt="homepage" class="dark-logo" />                    
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search p-l-20">
                                <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            printf("<img src='%s' alt='' class='profile-pic m-r-5' />%s %s</a>", (string)$photo,$name,$lastname);
                            ?>
                              <!-- <img src="assets/images/users/1.jpg" alt="user" class="profile-pic m-r-5" />Markarn Doe</a> -->
                            <a href='Index.php'><i class="fa fa-sign-out fa-fw"></i>Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-6" id="thingstable">
                        <?php 
                            $tableros = json_decode( file_get_contents('http://127.0.0.1:8000/tableros/'), true );
                            $ideas = json_decode( file_get_contents('http://127.0.0.1:8000/ideas/'), true );
                            foreach($tableros as $tables){
                                if ($tables['table_owner']==$_GET['usuario'] || $tables['table_privacy']==0){
                                    printf("<div class='card'><div class='table-bordered card-block'><h3 class='card-title'>%s</h3>", $tables["table_name"]);
                                    foreach($ideas as $things){
                                        if ($tables['id']==$things['table_name']){
                                            printf("<div class='table-bordered card-block'><div class='text-right'><a data-toggle='modal' data-target='#modal_delidea' id='%s' value='%s' class='btn btn-danger fa fa-window-close' align='right' aria-hidden='true'></a></div><div><h6 class='card-subtitle'>%s</h6></div>", $things["id"], $things["thing"],$things["thing"]);
                                            $usuarios = json_decode( file_get_contents('http://127.0.0.1:8000/usuarios/'.urlencode($things['user_name'])), true );
                                            $tname=$usuarios['name'];
                                            $tlastname=$usuarios['last_name'];
                                            printf("<div class='text-left'><span class='text-muted'>%s %s</span></div></div>", $tname, $tlastname);
                                        }
                                    }
                                    printf("<div class='text-right'><a class='btn btn-success fa fa-plus-square' align='right' aria-hidden='true' data-toggle='modal' data-target='#modal_addidea' id='%s'></a></div></div>", $tables['id']);
                                }
                            } 
                        ?>
                        <input type="hidden" id=idea name=idea></input>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <div class="modal fade" id="modal_delidea" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Eliminar idea</h3>
                        </div>
                        <div class="modal-footer">
                            <script>
                            $(document).ready(function(){
                            $('body #thingstable').on('click', 'a', function(){
                                var ideaid=$(this).attr('id');
                                document.getElementById("idea").value=ideaid;
                                //alert(document.getElementById("idea").value);
                              })
                            })
                            function eraseidea(){
                                var url = ("http://127.0.0.1:8000/ideas/"+document.getElementById("idea").value);
                                var xhr = new XMLHttpRequest();
                                xhr.open("DELETE", url, true);
                                xhr.onload = function () {
                                    var users = JSON.parse(xhr.responseText);
                                    if (xhr.readyState == 4 && xhr.status == "200") {
                                        console.table(users);
                                    } else {
                                        console.error(users);
                                    }
                                }
                                xhr.send(null);
                            };
                            </script>
                            <button type="submit" class="btn btn-primary submitBtn" onclick="eraseidea()">Eliminar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="modal_addidea" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Añadir idea</h3>
                        </div>
                        <div class="modal-body">
                            <p class="statusMsg"></p>
                            <form role="form">
                                <div class="form-group">
                                    <label for="inputName">Idea</label>
                                    <input type="text" class="form-control" id="inputidea" placeholder="Ingrese la idea"/>
                                </div>                                
                            </form>
                        </div>

                        <div class="modal-footer">
                          <script>
                            $(document).ready(function(){
                            $('body #thingstable').on('click', 'a', function(){
                                var tableid=$(this).attr('id');
                                document.getElementById("idea").value=tableid;
                              })
                            })
                            function addidea(){
                                var idea = $('#inputidea').val();
                                var tableid = document.getElementById("idea").value;
                                var userid = <?php echo $_GET['usuario']; ?>;
                                if(idea.trim() == '' ){
                                    alert('Por favor ingrese la descripción de la idea.');
                                    $('#inputidea').focus();
                                    return false;
                                }
                                else{
                                    var data = { user_name:userid, table_name: tableid, thing:idea };
                                    var http = new XMLHttpRequest();
                                    var url = "http://127.0.0.1:8000/ideas/";
                                    http.open("POST", url, true);
                                    http.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                                    http.onreadystatechange = function() {
                                        if(http.readyState == 4 && http.status >= 200) {
                                            //aqui obtienes la respuesta de tu peticion
                                            //alert(http.responseText);
                                            $("#modal_addidea").modal('hide');//ocultamos el modal
                                            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                                            $('.modal-backdrop').remove();//eliminamos el backdrop del modal
                                        }
                                    }
                                    http.send(JSON.stringify({ user_name:userid, table_name: tableid, thing:idea }));
                                }

                            };
                            </script>
                            <button type="submit" class="btn btn-primary submitBtn" onclick="addidea()">Añadir</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='text-right'><a class='btn btn-success fa fa-plus-circle' align='right' aria-hidden='true' data-toggle="modal" data-target="#modal_newtable"> Crear un tablero</a></div>
            <div class="modal fade" id="modal_newtable" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Agregar nuevo tablero</h3>
                        </div>
                        <div class="modal-body">
                            <p class="statusMsg"></p>
                            <form role="form">
                                <div class="form-group">
                                    <label for="inputName">Nombre del tablero</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Ingrese el nombre del tablero"/>
                                </div>
                                <div class="form-group">
                                    <label for="inputPrivacy">Privacidad del tablero</label>
                                    <select id="privacy">
                                       <option value="0">Publico</option> 
                                       <option value="1">Privado</option> 
                                    </select>
                                </div>                    
                            </form>
                        </div>

                        <div class="modal-footer">
                          <script>
                            function submitContactForm(){
                                var name = $('#inputName').val();
                                var privacy = $('#privacy').val();
                                var userid = <?php echo $_GET['usuario']; ?>;
                                if(name.trim() == '' ){
                                    alert('Por favor ingrese el nombre del tablero.');
                                    $('#inputName').focus();
                                    return false;
                                }
                                else{
                                    var data = { table_owner:userid, table_name: name, table_privacy:privacy };
                                    var http = new XMLHttpRequest();
                                    var url = "http://127.0.0.1:8000/tableros/";
                                    http.open("POST", url, true);
                                    http.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                                    http.onreadystatechange = function() {
                                        if(http.readyState == 4 && http.status == 201) { 
                                            //aqui obtienes la respuesta de tu peticion
                                            //alert(http.responseText);
                                            $("#modal_newtable").modal('hide');//ocultamos el modal
                                            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                                            $('.modal-backdrop').remove();//eliminamos el backdrop del modal
                                            location.reload();
                                        }
                                    }
                                    http.send(JSON.stringify({table_owner:userid, table_name: name, table_privacy:privacy}));
                                    }
                            };
                        </script>
                            <button type="submit" class="btn btn-primary submitBtn" onclick="submitContactForm()">Crear</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>

                </div>
            </div>

            

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- Flot Charts JavaScript -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/flot-data.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
