<!DOCTYPE html>
<html lang="en">

<head>

  <title>GameJap</title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="jquery/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="three/three2.js"></script>
	<script type="text/javascript" src="three/MTLLoader.js"></script>
  <script type="text/javascript" src="three/FBXLoader.js"></script>
	<script type="text/javascript" src="three/OBJLoader.js"></script>
  <script type="text/javascript" src="three/inflate.min.js"></script>
  <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
  
  
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

      <script type="text/javascript">
        var scene;
        var camera;
        var renderer;
        var controls;
        var objects = [];
        var clock;
        var deltaTime;	
        var keys = {};

        var persona;

        var raycaster;
        var objetosConColision = [];
                
        // TODO: Modelo con animacion.
        var mixers = [];
        var objsWithAnimation = [];
        var robotControl;
        // TODO: End Modelo Animacion.

        var isWorldReady = [ false, false, false, false, false, false, false, false, false, false,
                              false, false, false, false, false, false, false ];

        $(document).ready(function() {

          clock=new THREE.Clock();

          setupScene();

          //INICIALIZAMOS EL RAYCASTER
          raycaster= new THREE.Raycaster();
          camera.misRayos = [
            new THREE.Vector3(0,0,1),
            new THREE.Vector3(0,0,-1),
            new THREE.Vector3(1,0,0),
            new THREE.Vector3(-1,0,0)
          ];

          loadOBJWithMTL("assets/", "Terreno2.obj", "Terreno2.mtl", (objetoCargado) => {
            objetoCargado.position.z = -1;
              //var objetoCargado2= objetoCargado.clone();
              //objetoCargado2.position.z=50;              
              scene.add(objetoCargado);
              //scene.add(objetoCargado2);
              //objetosConColision.push(objetoCargado);
              //objetosConColision.push(objetoCargado2);
            
            isWorldReady[0] = true;
          });

          loadOBJWithMTL("assets/", "Templo2.obj", "Templo2.mtl", (templo) => {
            templo.position.z = -1;
            scene.add(templo);
            isWorldReady[1] = true;
          });

          //loadOBJWithMTL("assets/", "Personaje.obj", "Personaje.mtl", (personaje) => {
          //  personaje.position.z = -30;
          //  personaje.position.x = -23;
          //  personaje.rotation.y = THREE.Math.degToRad(180);
          //  //scene.add(personaje);
          //  persona.add(personaje);
          //  isWorldReady[2] = true;
          //});

          loadOBJWithMTL("assets/", "Arena2.obj", "Arena2.mtl", (arena) => {
            arena.position.z = -1;
            scene.add(arena);
            isWorldReady[3] = true;
          });

          loadOBJWithMTL("assets/", "Casa.obj", "Casa.mtl", (casa) => {
            casa.position.z = -1;
            scene.add(casa);
            isWorldReady[4] = true;
          });

          loadOBJWithMTL("assets/", "CasaMayor.obj", "CasaMayor.mtl", (casaMayor) => {
            casaMayor.position.z = -1;
            scene.add(casaMayor);
            isWorldReady[5] = true;
          });

          loadOBJWithMTL("assets/", "CasasMenores.obj", "CasasMenores.mtl", (casasMenores) => {
            casasMenores.position.z = -1;
            scene.add(casasMenores);
            isWorldReady[6] = true;
          });

          loadOBJWithMTL("assets/", "Farol.obj", "Farol.mtl", (farol) => {
            farol.position.z = -1;
            scene.add(farol);
            isWorldReady[7] = true;
          });

          loadOBJWithMTL("assets/", "Ficha.obj", "Ficha.mtl", (ficha) => {
            ficha.position.z = -1;
            scene.add(ficha);
            isWorldReady[8] = true;
          });

          loadOBJWithMTL("assets/", "Mascara1.obj", "Mascara1.mtl", (mask1) => {
            mask1.position.z = -1;
            scene.add(mask1);
            isWorldReady[9] = true;
          });

          loadOBJWithMTL("assets/", "Mascara2.obj", "Mascara2.mtl", (mask2) => {
            mask2.position.z = -1;
            scene.add(mask2);
            isWorldReady[10] = true;
          });

          loadOBJWithMTL("assets/", "Puente.obj", "Puente.mtl", (puente) => {
            puente.position.z = -1;
            scene.add(puente);
            isWorldReady[11] = true;
          });

          loadOBJWithMTL("assets/", "RegaMayor.obj", "RegaMayor.mtl", (rejaMayor) => {
            rejaMayor.position.z = -1;
            scene.add(rejaMayor);
            isWorldReady[12] = true;
          });

          loadOBJWithMTL("assets/", "Roca1.obj", "Roca1.mtl", (roca1) => {
            roca1.position.z = -1;
            scene.add(roca1);
            isWorldReady[13] = true;
          });

          loadOBJWithMTL("assets/", "Roca2.obj", "Roca2.mtl", (roca2) => {
            roca2.position.z = -1;
            scene.add(roca2);
            isWorldReady[14] = true;
          });

          loadOBJWithMTL("assets/", "Roca3.obj", "Roca3.mtl", (roca3) => {
            roca3.position.z = -1;
            scene.add(roca3);
            isWorldReady[15] = true;
          });

          loadOBJWithMTL("assets/", "Roca4.obj", "Roca4.mtl", (roca4) => {
            roca4.position.z = -1;
            scene.add(roca4);
            isWorldReady[16] = true;
          });

          var loader = new THREE.FBXLoader();
          loader.load('assets/PERSONAJE17.fbx', function (personaje) {
            personaje.mixer = new THREE.AnimationMixer(personaje);

            mixers.push(personaje.mixer);
            var action = personaje.mixer.clipAction(personaje.animations[0]);
            action.play();

            personaje.position.z = 0;
            personaje.position.x = 0;
            personaje.position.y = 8;
            personaje.scale.set(0.5, 0.5, 0.5);
            personaje.rotation.y = THREE.Math.degToRad(180);
            //scene.add(personaje);
            //persona.add(personaje);

            personaje.traverse(function (child) {
              if (child.isMesh) {
                child.castShadow = true;
                child.receiveShadow = true;
              }
            });

            camera.position.z = 8;
            camera.position.y = 14;
            //camera.rotation.y = THREE.Math.degToRad(180);


            scene.add(personaje);
            persona.add(personaje);
            persona.add(camera);
            scene.add(persona);
          });


          //scene.add(persona);
          //camera.position.z = 8;
          //camera.position.y = 14;
          //var grados = THREE.Math.degToRad(10);
          //camera.rotation.x = -grados;
          //persona.add(camera);

          render();

          document.addEventListener('keydown', onKeyDown);
          document.addEventListener('keyup', onKeyUp);		
        });

        function loadOBJWithMTL(path, objFile, mtlFile, onLoadCallback) {
          var mtlLoader = new THREE.MTLLoader();
          mtlLoader.setPath(path);
          mtlLoader.load(mtlFile, (materials) => {
            
            var objLoader = new THREE.OBJLoader();
            objLoader.setMaterials(materials);
            objLoader.setPath(path);
            objLoader.load(objFile, (objetoCargado) => {
              onLoadCallback(objetoCargado);
            });

          });
        }

        function onKeyDown(event) {
          keys[String.fromCharCode(event.keyCode)] = true;
        }
        function onKeyUp(event) {
          keys[String.fromCharCode(event.keyCode)] = false;
        }

        
        function render() {
          requestAnimationFrame(render);
          var bool=false;

          if (mixers.length > 0) {
            for (var i = 0; i < mixers.length; i++) {
              mixers[i].update(clock.getDelta());
            }
          }


          deltaTime = clock.getDelta();	

          var yaw = 0;
          var forward = 0;
          if (keys["A"]) {
            yaw = 60;
          } else if (keys["D"]) {
            yaw = -60;
          }
          if (keys["W"]) {
            forward = -1700;
          } else if (keys["S"]) {
            forward = 1700;
          }

          

          if (isWorldReady[0] && isWorldReady[1]) {

            persona.translateZ(forward * deltaTime);

            for(var i = 0; i < camera.misRayos.length; i++){
              var rayo = camera.misRayos[i];

              raycaster.set( camera.position, rayo );

              var colision = raycaster.intersectObjects(
                objetosConColision,
                true
              );

              if( colision.length > 0 ){
                if(colision[0].distance < 15){
                //Si hay colision
                  console.log("Estoy colisionando");
                  //bool = true;
                  //colision[0].object.parent.rotar = true
                  //raycast
                  //colision[0]
                }
              }
            }

            persona.rotation.y += yaw * deltaTime;
          }
          
          //if(bool == true)    for( i<objetosConColision.leght i++)
          //{				if(objectosconColision{i}.rotar === true)
          //	coli.rotation.z += THREE.Math.degToRad(50)*deltaTime;  .rotario.z += 0.001
          //}
        
          //personaje.rotation.y += yaw * deltaTime;
		      //personaje.translateZ( forward * deltaTime );
          //camera.lookAt( personaje.position );
          
          renderer.render(scene, camera);
        }

        function setupScene() {		
          //var visibleSize = { width: window.innerWidth, height: window.innerHeight};
          var visibleSize = { width: 1500, height: 800};
          clock = new THREE.Clock();		
          scene = new THREE.Scene();
          persona = new THREE.Object3D();
          camera = new THREE.PerspectiveCamera(75, visibleSize.width / visibleSize.height, 0.1, 1000);
          camera.position.z = 2;
          camera.position.y = 10;

          renderer = new THREE.WebGLRenderer( {precision: "mediump" } );
          renderer.setClearColor(new THREE.Color(0, 0, 0));
          renderer.setPixelRatio(visibleSize.width / visibleSize.height);
          renderer.setSize(visibleSize.width, visibleSize.height);

          var ambientLight = new THREE.AmbientLight(new THREE.Color(1, 1, 1), 1.0);
          scene.add(ambientLight);

          var directionalLight = new THREE.DirectionalLight(new THREE.Color(1, 1, 0), 0.4);
          directionalLight.position.set(0, 0, 1);
          scene.add(directionalLight);

          var grid = new THREE.GridHelper(50, 10, 0xffffff, 0xffffff);
          grid.position.y = -1;
          scene.add(grid);
          
          

          $('#can').append(renderer.domElement);
        }

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
          @auth
            <a class="nav-link js-scroll-trigger" href="#contact">{{ Auth::user()->name }}</a>
          @endauth
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
          <h1 class="text-uppercase text-white font-weight-bold" style="font-size: 150px">GameJap</h1>
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
              <br><br><br><br><br><br><br><br>
              <!--<a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Instrucciones</a><br><br>-->
              @guest
              <button id="btn_regi" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="25" height="25" src="img/regis.png"/> Registrarse</button><br><br>
              <button id="btn_login" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="25" height="25" src="img/login.png"/> Log in</button><br><br>
              @endguest
              <button id="btn_play"  class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="25" height="25" src="img/play.png"/> Play</button><br><br>
              <button id="btn_pausa" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="25" height="25" src="img/pause2.png"/> Pausa</button><br><br>
              <button id="btn_config" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="25" height="25" src="img/config.png"/> Configuraciones</button><br><br>
              <button id="btn_punt" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="25" height="25" src="img/punt.png"/> Puntuaciones</button><br><br>
              @auth
                <form action="/out" method="GET">
                @csrf
                  <button id="btn_logout" class="btn btn-primary btn-xl js-scroll-trigger"><img width="25" height="25" src="img/logout.png"/> Log out</button><br><br>
                </form>
              @endauth
              <br><br><br><br>
            </ul>       
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <br><br><h1 style="font-size: 50px">GameJap</h1>
                        <center>
                          <div id="can">
                            <!--<canvas id="micanvas" width="1550" height="800">
                                Tu navegador no soporta canvas.
                            </canvas>-->
                          </div>

                          <div id="registro" style="display: none">
                              <br><br><br>
                            <h1>Registro de Usuario</h1><br><br>
                            <form enctype="multipart/form-data" action="/registrar" method="POST">
                            @csrf
                                <input name="usu" type="text"  class="form-control col-md-5" placeholder="Usuario" data-toggle = "tooltip"  required="" ><br><br>
                                <input name="contra" type="password"  class="form-control col-md-5" placeholder="Password" data-toggle = "tooltip"  required=""><br><br>
                                <button type="submit"class="btn btn-primary btn-lg">Registrarse</button>
                            </form>
                          </div>

                          <div id="login" style="display: none">
                              <br><br><br>
                            <h1>Iniciar Secion</h1><br><br>
                            <form enctype="multipart/form-data" action="/logear" method="POST">
                            @csrf
                                <label class="sr-only">Usuario</label>
                                <input  name = "name" type="text" class="form-control col-md-5" placeholder="Usuario" required="" autofocus=""><br><br>
                                <label class="sr-only">Contraseña</label>
                                <input  name = "pas" type="password" class="form-control col-md-5" placeholder="Password" required=""><br><br>
                                <button class="btn btn-lg btn-primary btn-block col-md-5" type="submit">Entrar</button> 
                            </form>
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
                              <section>
                                <div class="container">
                                    <div class="row">
                                    @foreach($punto as $p)
                                        <div class="col-md-4">
                                            <div class="card mb-4 shadow-sm">
                                              <div class="card-body">
                                                <input type="hidden" name="idPunto" value= "{{ $p->id }}">
                                                <p class="card-text">{{ $usu->name }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                  <p class="card-text">{{ $p->puntos }}</p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    @endforeach
                                    </div>
                                  </div>
                              </section>
                                
                                <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about">
                                  Compartir tu puntaje en Facebook
                                </button><br><br>
                                <button class="btn btn-primary btn-xl js-scroll-trigger" href="#about">
                                  Compartir tu puntaje en Instagram
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

   @include('sweetalert::alert')

</body>

</html>