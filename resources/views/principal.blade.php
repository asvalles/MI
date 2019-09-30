<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script type="text/javascript" src="jquery.js"></script>

  <title>GameJap</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/stylish-portfolio.min.css" rel="stylesheet">

  <script type="text/javascript" src="js/libs/jquery/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/libs/three/three.js"></script>


  <script type="text/javascript">
      function cargaContextoCanvas(micanvas){
        var elemento = document.getElementById(micanvas);
        if(elemento && elemento.getContext){
            var contexto = elemento.getContext('2d');
            if(contexto){
              return contexto;
            }
        }
        return FALSE;
      }


      window.onload = function(){
        //Recibimos el elemento canvas
        var ctx = cargaContextoCanvas('micanvas');
        if(ctx){
            //Creo una imagen conun objeto Image de Javascript
            var img = new Image();
            //indico la URL de la imagen
            img.src = 'img/img1.png';
            //defino el evento onload del objeto imagen
            img.onload = function(){
              //incluyo la imagen en el canvas
              ctx.drawImage(img, 10, 10);
            }
        }
      }
  </script>

  <script type="text/javascript">
      $(document).ready(function() {

        $('#btn_play').click(function() {
          $("#can").toggle();
          $("#pausa").hide();
          $("#puntuacion").hide();
          $("#configuracion").hide();
          $("#login").hide();
          $("#registro").hide();
        });

        $('#btn_pausa').click(function() {
          $("#pausa").toggle();
          $("#can").hide();
          $("#puntuacion").hide();
          $("#configuracion").hide();
          $("#login").hide();
          $("#registro").hide();
        });

        $('#btn_config').click(function() {
          $("#configuracion").toggle();
          $("#pausa").hide();
          $("#puntuacion").hide();
          $("#can").hide();
          $("#login").hide();
          $("#registro").hide();
        });
        
        $('#btn_punt').click(function() {
          $("#puntuacion").toggle();
          $("#pausa").hide();
          $("#configuracion").hide();
          $("#can").hide();
          $("#login").hide();
          $("#registro").hide();
        });

         $('#btn_regi').click(function() {
          $("#registro").toggle();
          $("#pausa").hide();
          $("#configuracion").hide();
          $("#can").hide();
          $("#login").hide();
          $("#puntuacion").hide();
        });

         $('#btn_login').click(function() {
          $("#login").toggle();
          $("#pausa").hide();
          $("#configuracion").hide();
          $("#can").hide();
          $("#puntuacion").hide();
          $("#registro").hide();
        });
    });
  </script>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="principal.html">GameJap</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Nombre_de_usuario_en_sesion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> 

  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">GameJap</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">¡El mejor videojuego para aprender japonés!</p>
        </div>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <br><br><br><br><br><br><br><br><br>
              <!--<a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Instrucciones</a><br><br>-->
              <button id="btn_regi" class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Registrarse</button><br><br>
              <button id="btn_login" class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Log in</button><br><br>
              <button id="btn_play" onclick="ocultar()" class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Play</button><br><br>
              <button id="btn_pausa" class="btn btn-primary btn-xl js-scroll-trigger">Pausa</button><br><br>
              <button id="btn_config" class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Configuraciones</button><br><br>
              <button id="btn_punt" class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Puntuaciones</button><br><br>
              <button id="btn_logout" class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Log out</button><br><br>
              <br><br><br><br>
            </ul>       
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <br><br><h1>GameJap</h1>
                        <center>
                          <div id="can">
                            <canvas id="micanvas" width="1550" height="800">
                                Tu navegador no soporta canvas.
                            </canvas>
                          </div>
                    
                          <div id="registro" style="display: none">
                              <br><br><br>
                            <h1 class="h3 mb-3 font-weight-normal">Registro de Usuario</h1>
                                <input type="text"  class="form-control col-md-5" placeholder="Usuario" data-toggle = "tooltip"  required="" ><br><br>
                                <input type="password"  class="form-control col-md-5" placeholder="Password" data-toggle = "tooltip"  required=""><br><br>
                                <button type="submit"class="btn btn-primary btn-lg">Registrarse</button>
                          </div>

                          <div id="login" style="display: none">
                              <br><br><br>
                            <h1 class="h3 mb-3 font-weight-normal">Iniciar Secion</h1><br><br>
                            <label for="inputEmail" class="sr-only">Usuario</label>
                            <input type="email" id="inputEmail" class="form-control col-md-5" placeholder="Usuario" required="" autofocus=""><br><br>
                            <label for="inputPassword" class="sr-only">Contraseña</label>
                            <input type="password" id="inputPassword" class="form-control col-md-5" placeholder="Password" required=""><br><br>
                            <button class="btn btn-lg btn-primary btn-block col-md-5" type="submit">Entrar</button>
                          </div>


                          <div id="pausa" style="display: none">
                              <br><br><br>
                            <h1>PAUSA</h1><br><br>
                            <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Continuar</button><br><br>
                            <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Salir</button><br><br>
                          </div>

                          <div id="configuracion" style="display: none">
                              <br><br><br>
                          <h1>CONFIGURACIONES</h1><br><br>
                          <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="250" height="300" src="img/obj3.PNG"></img></button>
                          <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="250" height="300" src="img/obj4.PNG"></img></button>
                          <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="250" height="300" src="img/obj5.PNG"></img></button><br><br>
                          </div>

                          <div id="puntuacion" style="display: none">
                              <br><br><br>
                            <h1>PUNTUACIONES</h1>
                            <div class="container">
                            
                                <div class="row">
                                  
                                    <div class="col-md-4">
                                        <div class="card mb-4 shadow-sm">
                                          <div class="card-body">
                                            <p class="card-text">Jugador</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                              <p class="card-text">Puntacion</p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                  <div class="col-md-4">
                                      <div class="card mb-4 shadow-sm">
                                        <div class="card-body">
                                          <p class="card-text">Jugador</p>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-text">Puntacion</p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm">
                                      <div class="card-body">
                                        <p class="card-text">Jugador</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                          <p class="card-text">Puntacion</p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                          
                                </div>
                              </div>

                              
                              <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about">
                                Compartir tu puntuacion en Facebook
                              </button><br><br>
                              <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about">
                                Compartir tu puntuacion en Instagram
                              </button><br><br>

                          </div>
                         
                        </center>
                      <!--</div> -->
              <!--</div>-->
        </main>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

 
   <!-- Custom scripts for this template -->
   <script src="js/stylish-portfolio.min.js"></script>

</body>

</html>