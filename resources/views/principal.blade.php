<!DOCTYPE html>
<html lang="en">

<head> 

</head>
  <title>GameJap</title>
  <link rel="icon" href="bambu.ico" />
  <!-- <meta property="og:image" content="img/img1.png" /> -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- <script type="text/javascript" src="jquery.js"></script> -->
  <script type="text/javascript" src="jquery/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="three/three2.js"></script>
	<script type="text/javascript" src="three/MTLLoader.js"></script>
  <script type="text/javascript" src="three/FBXLoader.js"></script>
	<script type="text/javascript" src="three/OBJLoader.js"></script>
  <script type="text/javascript" src="three/inflate.min.js"></script>
  <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
  <script type="text/javascript" src="three/mifacebook.js"></script>
  
  
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

        //$('#btn_pausa').click(function() {
        //  $("#pausa").toggle();
        //  $("#NIVELES").hide();
        //  $("#can").hide();
        //  $("#puntuacion").hide();
        //  $("#configuracion").hide();
        //  $("#login").hide();
        //  $("#registro").hide();
        //  $("#NivelUno_Texto").hide();
        //  $("#NivelDos_Texto").hide();
        //  $("#NivelTres_Texto").hide();
        //});

        $('#btn_niveles').click(function() {
          $("#NIVELES").toggle();
          $("#can").hide();
          $("#puntuacion").hide();
          $("#configuracion").hide();
          $("#login").hide();
          $("#registro").hide();
          $("#NivelUno_Texto").hide();
          $("#NivelDos_Texto").hide();
          $("#NivelTres_Texto").hide();
        });

        $('#btn_config').click(function() {
          $("#configuracion").toggle();
          $("#NIVELES").hide();
          $("#puntuacion").hide();
          $("#can").hide();
          $("#login").hide();
          $("#registro").hide();
          $("#NivelUno_Texto").hide();
          $("#NivelDos_Texto").hide();
          $("#NivelTres_Texto").hide();
        });
        
        $('#btn_punt').click(function() {
          $("#puntuacion").toggle();
          $("#NIVELES").hide();
          $("#configuracion").hide();
          $("#can").hide();
          $("#login").hide();
          $("#registro").hide();
          $("#NivelUno_Texto").hide();
          $("#NivelDos_Texto").hide();
          $("#NivelTres_Texto").hide();
        });

         $('#btn_regi').click(function() {
          $("#registro").toggle();
          $("#NIVELES").hide();
          $("#configuracion").hide();
          $("#can").hide();
          $("#login").hide();
          $("#puntuacion").hide();
          $("#NivelUno_Texto").hide();
          $("#NivelDos_Texto").hide();
          $("#NivelTres_Texto").hide();
        });

         $('#btn_login').click(function() {
          $("#login").toggle();
          $("#NIVELES").hide();
          $("#configuracion").hide();
          $("#can").hide();
          $("#puntuacion").hide();
          $("#registro").hide();
          $("#NivelUno_Texto").hide();
          $("#NivelDos_Texto").hide();
          $("#NivelTres_Texto").hide();
        });
        
        $('#btn_1').click(function() {
          $("#NIVELES").hide();
          $("#can").toggle();
          $("#NivelUno_Texto").toggle();
          $("#NivelDos_Texto").hide();
          $("#NivelTres_Texto").hide();
        });

        $('#btn_2').click(function() {
          $("#NIVELES").hide();
          $("#can").toggle();
          $("#NivelDos_Texto").toggle();
          $("#NivelUno_Texto").hide();
          $("#NivelTres_Texto").hide();
        });

        $('#btn_3').click(function() {
          $("#NIVELES").hide();
          $("#can").toggle();
          $("#NivelTres_Texto").toggle();
          $("#NivelDos_Texto").hide();
          $("#NivelUno_Texto").hide();
          
        });
    });
  </script>

    <!-- REMPLAZO LAS VARIABLES DE WEBGL POR LAS DE THREE JS 
        con el vUv comparto las coordenadas -->
  <div id="shader-vs" type="x-shader/x-vertex" style="display: none">
        varying vec2 vUv;
	    void main(void) {
        vUv = uv;
        vec4 modelViewPosition = modelViewMatrix * vec4(position,1.0);
        gl_Position = projectionMatrix * modelViewPosition;
	    }
	</div>
  <!-- con ayuda del texture2D obtengo el color de la imagen que le envio 
        para que cambie la posicion, le envio un timer y en ves de texture2d se enviara ese timer-->
	<div id="shader-fs" type="x-shader/x-fragment" style="display: none">
          varying vec2 vUv;
          uniform sampler2D arcoTexture;
          uniform float time;
	    void main(void) {
          vec2 T2 = vUv + vec2( -1, 4.0 ) * time;
          vec4 colores = texture2D( arcoTexture, T2 );
	        gl_FragColor = colores;
	    }
	</div>

  <script type="text/javascript">
        var scene;

        var camera;
        var camera_2;

        var renderer;
        var renderer_2;

        var controls;
        var objects = [];
        var clock;
        var deltaTime;	
        var keys = {};

        var persona;
        var persona_2;

        var raycaster;
        var raycaster_2;
        var objetosConColision = [];
        var objetosConColision_2 = [];

        //NIVEL UNO
        var colisionficha = [];
        var colisionficha2 = [];
        var colisionficha3 = [];
        var colisionficha4 = [];
        var colisionficha5 = [];

        var cantidadfichas_1 = 0;
        var cantidadfichas_2 = 0;
        var Usuario1Gano = false;
        var Usuario2Gano = false;
        var puntos_per1 = 0;
        var puntos_per2 = 0;
        var ficha1_i = false;
        var ficha2_i = false;
        var ficha3_e = false;
        var ficha1_i_2 = false;
        var ficha2_i_2 = false;
        var ficha3_e_2 = false;
        var estaEnNivelUno = false;
        var strDownloadMime = "image/octet-stream";

        var NIVELUNO=[];

        //NIVEL DOS
        var NIVELDOS = [];

        var estaEnNivelDos = false;
        var colisionficha1_2 = [];
        var colisionficha2_2 = [];
        var colisionficha3_2 = [];
        var colisionFarol_1 = [];

        var volumen = 0;
        var Usuario1Gano_2 = false;
        var Usuario2Gano_2 = false;
        var puntos_per1_2 = 0;
        var puntos_per2_2 = 0;

        var ficha1_ka = false;
        var ficha1_zo = false;
        var ficha1_ku = false;
        var ficha2_ka = false;
        var ficha2_zo = false;
        var ficha2_ku = false;
        var fichaKUtoggle;
        var sevefichaKUtoogle = false;
        var timer = 120;
        var inicioNivelDos = false;
        var seAcaboElTiempo = false;
        
        var fichita = [];
        var fichita2 = [];
        var fichita3 = [];

        var fichita_2 = [];
        var fichita2_2 = [];
        var fichita3_2 = [];

        var fichaKAColisionada = false;
        var fichaZOColisionada = false;
        var fichaKUColisionada = false;

        var fichaKAColisionada_2 = false;
        var fichaZOColisionada_2 = false;
        var fichaKUColisionada_2 = false;
        var inter;
        var inter_2;

        var colisionoDeNuevo = false;
        var colisionoDeNuevo_2 = false;

        var colisionoDeNuevo1 = false;
        var colisionoDeNuevo1_2 = false;

        var obtuvofichaKA = false;
        var obtuvofichaZO = false;
        var obtuvofichaKU = false;
        var obtuvofichaKA_2 = false;
        var obtuvofichaZO_2 = false;
        var obtuvofichaKU_2 = false;
        var unaVez = false;
        var unaVez_2 = false;
        var unaVezguardarpuntuacion = false;
        var unaVezguardarpuntuacion_2 = false;

        var inter = setInterval(function(){ 
          if(pause == false){
            if(seAcaboElTiempo == false && inicioNivelDos == true && timer >= 0){
              document.getElementById("tiempo").innerHTML = timer--; 
            }
          }
        }, 1000, "JavaScript");

        //NIVEL TRES
        var NIVELTRES = [];
        var colisionficha3_1 = [];
        var colisionficha3_1_2 = [];
        var colisionficha3_1_3 = [];
        var estaEnNivelTres = false;
        var inicioNivelTres = false;

        var ficha1_tomo = false;
        var ficha1_dachi = false;
        var ficha1_comodin = false;

        var ficha2_tomo = false;
        var ficha2_dachi = false;
        var ficha2_comodin = false;

        var obtuvofichaTOMO = false;
        var obtuvofichaDACHI = false;
        var obtuvofichaCOMODIN = false;
        var obtuvofichaTOMO_2 = false;
        var obtuvofichaDACHI_2 = false;
        var obtuvofichaCOMODIN_2 = false;

        var ptsUsuario = 0;
        var ptsJugador2 = 0;

        var colisionofichaTOMO = false;
        var colisionofichaDACHI = false;
        var colisionofichaCOMODIN = false;
        var colisionofichaTOMO_2 = false;
        var colisionofichaDACHI_2 = false;
        var colisionofichaCOMODIN_2 = false;

        var fichitaTOMO = [];
        var fichitaDACHI = [];

        var segundaColision = false;
        var segundaColision_2 = false;
        var segundaColision2 = false;
        var segundaColision2_2 = false;

        var Usuario1Gano_3 = false;
        var Usuario2Gano_3 = false;

        var timer_3 = 80;
        var seAcaboElTiempo_2 = false;
        var intermedio_1;
        var intermedio_2;
        var unaVez3 = false;
        var unaVez3_2 = false;
        var unaVezguardarpuntuacion_3 = false;
        var unaVezguardarpuntuacion2_3 = false;

        var arcoiris;    /// shaders
        var gamepad_2;   ///control gamepad
        var materials = []; //particulas
        var pause = false;   ///boton pausa


        var intermedio = setInterval(function(){ 
          if(pause == false){
            if(seAcaboElTiempo_2 == false && inicioNivelTres == true && timer_3 >= 0){
              document.getElementById("tiempo_2").innerHTML = timer_3--; 
            }
          }
        }, 1000, "JavaScript");


        var sliderPos = window.innerWidth / 2;
                
        // TODO: Modelo con animacion.
        var mixers = [];
        var mixers_2 = [];
        var objsWithAnimation = [];
        var robotControl;
        // TODO: End Modelo Animacion.

        var isWorldReady = [ false, false, false, false, false, false, false, false, false, false,
                              false, false, false, false, false, false, false, false, false ];

        $(document).ready(function() {
          persona_2 = new THREE.Object3D();
          fichaKUtoggle = new THREE.Object3D();
          clock=new THREE.Clock();

          setupScene();

          arcoiris = {
            arcoTexture: { value: new THREE.TextureLoader().load("img/arcoiris3.jpg") },
            time: { type: 'float', value: 0.0 }
          };

          var arcoirisMaterial = new THREE.ShaderMaterial({
            uniforms : arcoiris,
			      fragmentShader: document.getElementById('shader-fs').textContent,
            vertexShader: document.getElementById('shader-vs').textContent
          });

          //CON ESTO REPITO LAS TEXTURAS, LAS "ANIMO"
          arcoiris.arcoTexture.value.wrapS = THREE.RepeatWrapping;
          arcoiris.arcoTexture.value.wrapT = THREE.RepeatWrapping;

          //////////////////////////////////////////////////////// COLOR DEL FONDO  ///////////////////////////////////////////////////
          var fondo = localStorage.getItem('colorFondo');
          document.body.style.backgroundColor = fondo;
          //////////////////////////////////////////////////////// COLOR DEL FONDO  ///////////////////////////////////////////////////

          window.addEventListener("gamepadconnected", function(e) {
            console.log('gamepad conectado',
                        e.gamepad.index, e.gamepad.id,
                        e.gamepad.buttons.length, e.gamepad.axes.length);
                        gamepad_2 = e.gamepad;
                        //if(gamepad_2){
                        //  console.log('entro addEventListener');
                        //}
                        //else{
                        //  console.log('entro else');
                        //}
          });

          //window.addEventListener("gamepaddisconnected", function(e) { console.log("desconectado")}, false);

          //var material = new THREE.MeshBasicMaterial( { color: 0xffff00 } );
          //var geomCube = new THREE.BoxGeometry(1.0,1.0,1.0);
          //var cube = new THREE.Mesh(geomCube, arcoirisMaterial);
          //cube.position.set(10, 5, -10);
          //cube.scale.set(3,3,3);
          //scene.add(cube);

          //SKYDOME
          var skyGeo = new THREE.SphereGeometry(900,25,25);
          var loader = new THREE.TextureLoader(),
              texture = loader.load("img/cielo6.jpg");
          var material = new THREE.MeshPhongMaterial({
            map: texture,
          });
          var sky = new THREE.Mesh(skyGeo, material);
          sky.position.set(0,0,0);
          sky.material.side = THREE.BackSide;
          scene.add(sky);

          //INICIALIZAMOS EL RAYCASTER
          raycaster= new THREE.Raycaster();
          raycaster_2= new THREE.Raycaster();

          persona.misRayos = [
            new THREE.Vector3(0,0,1),
            new THREE.Vector3(0,0,-1),
            new THREE.Vector3(1,0,0),
            new THREE.Vector3(-1,0,0)
          ];

          persona_2.misRayos = [
            new THREE.Vector3(0,0,1),
            new THREE.Vector3(0,0,-1),
            new THREE.Vector3(1,0,0),
            new THREE.Vector3(-1,0,0)
          ];

          loadOBJWithMTL("assets/", "TERRENO.obj", "TERRENO.mtl", (objetoCargado) => {
            objetoCargado.position.z = -1;
            objetoCargado.scale.set(0.5, 0.5, 0.5); 
              scene.add(objetoCargado);
            
            isWorldReady[0] = true;
          });

          loadOBJWithMTL("assets/", "Templo2.obj", "Templo2.mtl", (templo) => {
            templo.position.z = -1;
            templo.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(templo);
            objetosConColision_2.push(templo);
            scene.add(templo);
            isWorldReady[1] = true;
          });

          loadOBJWithMTL("assets/", "Arena2.obj", "Arena2.mtl", (arena) => {
            arena.position.z = -1;
            arena.scale.set(0.5, 0.5, 0.5);
            scene.add(arena);
            isWorldReady[3] = true;
          });

          loadOBJWithMTL("assets/", "Casa.obj", "Casa.mtl", (casa) => {
            casa.position.z = -1;
            casa.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(casa);
            objetosConColision_2.push(casa);
            scene.add(casa);
            isWorldReady[4] = true;
          });

          loadOBJWithMTL("assets/", "CasaMayor.obj", "CasaMayor.mtl", (casaMayor) => {
            casaMayor.position.z = -1;
            casaMayor.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(casaMayor);
            objetosConColision_2.push(casaMayor);
            scene.add(casaMayor);
            isWorldReady[5] = true;
          });

          loadOBJWithMTL("assets/", "CasasMenores.obj", "CasasMenores.mtl", (casasMenores) => {
            casasMenores.position.z = -1;
            casasMenores.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(casasMenores);
            objetosConColision_2.push(casasMenores);
            scene.add(casasMenores);
            isWorldReady[6] = true;
          });

          loadOBJWithMTL("assets/", "Farol.obj", "Farol.mtl", (farol) => {
            farol.position.z = -1;
            farol.scale.set(0.5, 0.5, 0.5);
            //objetosConColision.push(farol);
            colisionFarol_1.push(farol);
            scene.add(farol);
            isWorldReady[7] = true;
          });

          
            loadOBJWithMTL("assets/", "Ficha2.obj", "Ficha2.mtl", (ficha) => {
              //if(estaEnNivelUno == true){
                ficha.position.z = -90;
                ficha.position.x = 25;
                ficha.position.y = -1;
                ficha.rotation.y = THREE.Math.degToRad(-45);
                ficha.scale.set(0.5, 0.5, 0.5);
                //objetosConColision.push(ficha);
                //objetosConColision_2.push(ficha);
                colisionficha.push(ficha);
                scene.add(ficha);
                isWorldReady[8] = true;
                NIVELUNO.push(ficha);
              //}
            });

            loadOBJWithMTL("assets/", "I.obj", "I.mtl", (ficha3) => {
              //if(estaEnNivelUno == true){
                ficha3.position.z = -20;
                ficha3.position.x = 80;
                ficha3.position.y = -1;
                ficha3.rotation.y = THREE.Math.degToRad(-90);
                ficha3.scale.set(0.5, 0.5, 0.5);
                colisionficha3.push(ficha3);
                NIVELUNO.push(ficha3);
                scene.add(ficha3);
                
                var ficha2 = ficha3.clone();
                ficha2.position.z = 60;
                ficha2.position.x = -50;
                ficha2.position.y = -1;
                ficha2.rotation.y = THREE.Math.degToRad(90);
                ficha2.scale.set(0.5, 0.5, 0.5);
                colisionficha2.push(ficha2);
                NIVELUNO.push(ficha2);
                scene.add(ficha2);

                var ficha4 = ficha3.clone();
                //ficha4.rotation.y = THREE.Math.degToRad(90);
                ficha4.position.z = -30;
                ficha4.position.x = -80;
                ficha4.position.y = -1;
                ficha4.scale.set(0.5, 0.5, 0.5);
                colisionficha4.push(ficha4);
                NIVELUNO.push(ficha4);
                scene.add(ficha4);

                var ficha5 = ficha3.clone();
                ficha5.position.z = -90;
                ficha5.position.x = 40;
                ficha5.position.y = -1;
                ficha5.rotation.y = THREE.Math.degToRad(-45);
                ficha5.scale.set(0.5, 0.5, 0.5);
                colisionficha5.push(ficha5);
                NIVELUNO.push(ficha5);
                scene.add(ficha5);
              //}
            });

            loadOBJWithMTL("assets/", "KA.obj", "KA.mtl", (ficha6) => {
              //if(estaEnNivelDos == true && estaEnNivelUno == false){
                ficha6.position.z = -65;
                ficha6.position.x = -7;
                ficha6.position.y = -1;
                //ficha6.rotation.y = THREE.Math.degToRad(-90);
                ficha6.scale.set(0.5, 0.5, 0.5);
                colisionficha1_2.push(ficha6);
                scene.add(ficha6);
                isWorldReady[17] = true;
                NIVELDOS.push(ficha6);
              //}
            });

            loadOBJWithMTL("assets/", "ZO.obj", "ZO.mtl", (ficha7) => {
              //if(estaEnNivelDos == true && estaEnNivelUno == false){
                ficha7.position.z = -130;
                ficha7.position.x = -65;
                ficha7.position.y = -1;
                //ficha7.rotation.y = THREE.Math.degToRad(-45);
                ficha7.scale.set(0.5, 0.5, 0.5);
                colisionficha2_2.push(ficha7);
                scene.add(ficha7);
                NIVELDOS.push(ficha7);
              //}
            });

            loadOBJWithMTL("assets/", "KU.obj", "KU.mtl", (ficha8) => {
              //if(estaEnNivelDos == true && estaEnNivelUno == false){
                  ficha8.position.z = -27;
                  ficha8.position.x = 80;
                  ficha8.position.y = -1;
                  ficha8.rotation.y = THREE.Math.degToRad(-90);
                  //ficha8.scale.set(0, 0, 0);
                  colisionficha3_2.push(ficha8);
                  //scene.add(ficha8);
                  fichaKUtoggle.add(ficha8);
                  scene.add(fichaKUtoggle);
                  //scene.add(ficha8);    
                  NIVELDOS.push(ficha8);
              //}
            });

          loadOBJWithMTL("assets/", "TOMO.obj", "TOMO.mtl", (ficha9) => {
            ficha9.position.z = -160;
            ficha9.position.x = -75;
            ficha9.position.y = -1;
            //ficha7.rotation.y = THREE.Math.degToRad(-45);
            ficha9.scale.set(0.5, 0.5, 0.5);
            colisionficha3_1.push(ficha9);
            scene.add(ficha9);
            NIVELTRES.push(ficha9);
            isWorldReady[18] = true;
          });

          loadOBJWithMTL("assets/", "DACHI.obj", "DACHI.mtl", (ficha10) => {
            ficha10.position.z = 55;
            ficha10.position.x = -85;
            ficha10.position.y = -1;
            ficha10.rotation.y = THREE.Math.degToRad(90);
            ficha10.scale.set(0.5, 0.5, 0.5);
            colisionficha3_1_2.push(ficha10);
            scene.add(ficha10);
            NIVELTRES.push(ficha10);
          });

          loadOBJWithMTL("assets/", "COMODIN.obj", "COMODIN.mtl", (ficha11) => {
            ficha11.position.z = -190;
            ficha11.position.x = 65;
            ficha11.position.y = -1;
            //ficha11.rotation.y = THREE.Math.degToRad(-90);
            ficha11.scale.set(0.5, 0.5, 0.5);
            ficha11.traverse( function ( child ) {
              if ( child.isMesh ) {
                child.material = arcoirisMaterial;
              }
            });
            colisionficha3_1_3.push(ficha11);
            scene.add(ficha11);
            NIVELTRES.push(ficha11);
          });

          

          loadOBJWithMTL("assets/", "Puente4.obj", "Puente4.mtl", (puente) => {
            puente.position.z = -1;
            puente.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(puente);
            objetosConColision_2.push(puente);
            scene.add(puente);
            isWorldReady[11] = true;
          });

          loadOBJWithMTL("assets/", "RegaMayor.obj", "RegaMayor.mtl", (rejaMayor) => {
            rejaMayor.position.z = -1;
            rejaMayor.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(rejaMayor);
            objetosConColision_2.push(rejaMayor);
            scene.add(rejaMayor);
            isWorldReady[12] = true;
          });

          loadOBJWithMTL("assets/", "Roca1.obj", "Roca1.mtl", (roca1) => {
            roca1.position.z = -1;
            roca1.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(roca1);
            objetosConColision_2.push(roca1);
            scene.add(roca1);
            isWorldReady[13] = true;
          });

          loadOBJWithMTL("assets/", "Roca2.obj", "Roca2.mtl", (roca2) => {
            roca2.position.z = -1;
            roca2.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(roca2);
            objetosConColision_2.push(roca2);
            scene.add(roca2);
            isWorldReady[14] = true;
          });

          loadOBJWithMTL("assets/", "Roca3.obj", "Roca3.mtl", (roca3) => {
            roca3.position.z = -1;
            roca3.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(roca3);
            objetosConColision_2.push(roca3);
            scene.add(roca3);
            isWorldReady[15] = true;
          });

          loadOBJWithMTL("assets/", "Roca4.obj", "Roca4.mtl", (roca4) => {
            roca4.position.z = -1;
            roca4.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(roca4);
            objetosConColision_2.push(roca4);
            scene.add(roca4);
            isWorldReady[16] = true;
          });

          var loader = new THREE.FBXLoader();
          loader.load('assets/PERSONAJE17.fbx', function (personaje) {
            //objetosConColision.push(personaje);
            personaje.mixer = new THREE.AnimationMixer(personaje);

            mixers.push(personaje.mixer);
            var action = personaje.mixer.clipAction(personaje.animations[0]);
            action.play();

            personaje.position.z = 0;
            personaje.position.x = -1;
            personaje.position.y = 1.5;
            personaje.scale.set(0.5, 0.5, 0.5);
            personaje.rotation.y = THREE.Math.degToRad(180);

            persona.position.set(personaje.position.x,2,personaje.position.z);

            personaje.traverse(function (child) {
              if (child.isMesh) {
                child.castShadow = true;
                child.receiveShadow = true;
              }
            });

            camera.position.z = 8;
            camera.position.y = 7.5;

            scene.add(personaje);
            persona.add(personaje);
            persona.add(camera);
            scene.add(persona);

          });

           var loader_2 = new THREE.FBXLoader();
          loader_2.load('assets/PERSONAJE21.fbx', function (personaje) {
            //objetosConColision.push(personaje);
            personaje.mixer = new THREE.AnimationMixer(personaje);

            mixers_2.push(personaje.mixer);
            var action = personaje.mixer.clipAction(personaje.animations[0]);
            //action.timeScale = 175;
            action.play();

            personaje.position.z = 0;
            personaje.position.x = 1;
            personaje.position.y = 1.5;
            personaje.scale.set(0.5, 0.5, 0.5);
            personaje.rotation.y = THREE.Math.degToRad(180);

            persona_2.position.set(personaje.position.x,2,personaje.position.z);
            //scene.add(personaje);
            //persona.add(personaje);

            //personaje.traverse(function (child) {
            //  if (child.isMesh) {
            //    child.castShadow = true;
            //    child.receiveShadow = true;
            //  }
            //});

            camera_2.position.z = 8;
            camera_2.position.y = 7.5;
            //camera.rotation.y = THREE.Math.degToRad(180);
            
            scene.add(personaje);
            persona_2.add(personaje);
            persona_2.add(camera_2);
            scene.add(persona_2);

          });
          
          for(var i = 0; i < NIVELUNO.length; i++){
            scene.add(NIVELUNO[i]);
          }

          for(var i = 0; i < NIVELDOS.length; i++){
            scene.add(NIVELDOS[i]);
          }

          for(var i = 0; i < NIVELTRES.length; i++){
            scene.add(NIVELTRES[i]);
          }

          $("#btn_pausa").on({		
            mouseenter: function(){
              pause=true;
              //console.log(pause);
            },
            mouseleave: function(){
              pause=false;
              //console.log(pause);
            },
            click: function(){
              pause=true;
              //console.log(pause);
            }
          });
        
          $("#gris").click( function(){
              document.body.style.backgroundColor = "LightSteelBlue";

              var color_gris = document.body.style.backgroundColor; 
              localStorage.setItem("colorFondo", color_gris);
            }
          );

          $("#celeste").click( function(){
              document.body.style.backgroundColor = "LightSkyBlue";

              var color_celeste = document.body.style.backgroundColor; 
              localStorage.setItem("colorFondo", color_celeste);
            }
          );

          $("#aqua").click( function(){
              document.body.style.backgroundColor = "LightSeaGreen";

              var color_aqua = document.body.style.backgroundColor; 
              localStorage.setItem("colorFondo", color_aqua);
            }
          );

           $("#blanco").click( function(){
              document.body.style.backgroundColor = "White";

              var color_blanco = document.body.style.backgroundColor; 
              localStorage.setItem("colorFondo", color_blanco);
            }
          );
         
          render();
          render_2();
          render_3();

          document.addEventListener('keydown', onKeyDown);
          document.addEventListener('keyup', onKeyUp);	
        
          //$("#ptsUsuario").val(puntos_per1.html());
          
        });

        function setTimer(){
          if(inicioNivelDos == false){
            inicioNivelDos = true;
            timer = 120;
          }
        }

        function setTimer_2(){
          if(inicioNivelTres == false){
            inicioNivelTres = true;
            timer_3 = 80;
          }
        }

        function setNivelUno(){
          if(estaEnNivelUno == false){
            estaEnNivelUno = true;
            estaEnNivelDos = false;
          }
        }

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

        function Niveluno(){
          estaEnNivelUno = true;
          estaEnNivelDos = false;
          estaEnNivelTres = false;
        }

        function Niveldos(){
          estaEnNivelDos = true;
          estaEnNivelUno = false;
          estaEnNivelTres = false;
        }

        function Niveltres(){
          estaEnNivelTres = true;
          estaEnNivelDos = false;
          estaEnNivelUno = false;
        }
        
        function render() {
          requestAnimationFrame(render);
          if(pause == false){
            var bool=false;
            deltaTime = clock.getDelta();
            
          
            for(var i = 0; i < NIVELUNO.length; i++){
              if(estaEnNivelUno == true){
                NIVELUNO[i].scale.set(0.5, 0.5, 0.5);
              }
              else{
                NIVELUNO[i].scale.set(0, 0, 0);
              }
            }
          

            if (mixers.length > 0) {
              for (var i = 0; i < mixers.length; i++) {
                mixers[i].update(deltaTime);
              }
            }

            if (mixers_2.length > 0) {
              for (var i = 0; i < mixers_2.length; i++) {
                mixers_2[i].update(deltaTime);
              }
            }

            var yaw = 0;
            var forward = 0;
            if (keys["A"]) {
              yaw = 2;
            } else if (keys["D"]) {
              yaw = -2;
            }
            if (keys["W"]) {
              forward = -20;
            } else if (keys["S"]) {
              forward = 20;
            }

            var yaw_2 = 0;
            var forward_2 = 0;
            gamepad_2 = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads : []);
            if (gamepad_2.length>0){
                gamepad_2 = gamepad_2[0];
            }

            if(gamepad_2){
              //console.log('entro gamepad_2');
              if(gamepad_2.connected){
                if(gamepad_2.axes[0]>.5){
                  //console.log('entro button pressed');
                  yaw_2 = -2;
                }
                if(gamepad_2.axes[1]>.5){
                  //console.log('entro axes 1 >');
                  forward_2 = 20;
                }
                if(gamepad_2.axes[0]<-.5){
                  //console.log('entro axes 0 < ');
                  yaw_2 = 2;
                }
                if(gamepad_2.axes[1]<-.5){
                  //console.log('entro axes 1 < ');
                  forward_2 = -20;
                }
              }
              
            }

            //var yaw_2 = 0;
            //var forward_2 = 0;
            //if (keys["J"]) {
            //  yaw_2 = 2;
            //} else if (keys["L"]) {
            //  yaw_2 = -2;
            //}
            //if (keys["I"]) {
            //  forward_2 = -20;
            //} else if (keys["K"]) {
            //  forward_2 = 20;
            //}

            // PARTICULASSSSSSSSSSSSSSSSSSSSSSSSS

            var time = Date.now() * 0.00005;

            for ( var i = 0; i < scene.children.length; i ++ ) {

              var object = scene.children[ i ];

              if ( object instanceof THREE.Points ) {

                object.rotation.y = time * ( i < 4 ? i + 1 : - ( i + 1 ) );

              }

            }

            for ( var i = 0; i < materials.length; i ++ ) {

              var color = parameters[ i ][ 0 ];

              var h = ( 360 * ( color[ 0 ] + time ) % 360 ) / 360;
              materials[ i ].color.setHSL( h, color[ 1 ], color[ 2 ] );

            }
            
            // EENNNNNDDDDDDDD PARTICULASSSSSSSSSSSSSSSSSSSS

            if (isWorldReady[0] && isWorldReady[1]) {

              persona.translateZ(forward * deltaTime);
              persona_2.translateZ(forward_2 * deltaTime);

              for(var i = 0; i < persona.misRayos.length; i++){
                var rayo = persona.misRayos[i];

                raycaster.set( persona.position, rayo );

                var colision = raycaster.intersectObjects(
                  objetosConColision,
                  true
                );

                if( colision.length > 0 ){
                  if(colision[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                  }
                }
              }

              for(var i = 0; i < persona_2.misRayos.length; i++){
                var rayo_2 = persona_2.misRayos[i];

                raycaster_2.set( persona_2.position, rayo_2 );

                var colision_2 = raycaster_2.intersectObjects(
                  objetosConColision,
                  true
                );

                if( colision_2.length > 0 ){
                  if(colision_2[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                  }
                }
              }
              persona.rotation.y += yaw * deltaTime;
              persona_2.rotation.y += yaw_2 * deltaTime;
            }

            if (isWorldReady[8]) {

              for(var i = 0; i < persona.misRayos.length; i++){
                var rayo = persona.misRayos[i];

                raycaster.set( persona.position, rayo );

                var colision = raycaster.intersectObjects(
                  colisionficha,
                  true
                );

                var colision2 = raycaster.intersectObjects(
                  colisionficha2,
                  true
                );

                var colision3 = raycaster.intersectObjects(
                  colisionficha3,
                  true
                );

                var colision4 = raycaster.intersectObjects(
                  colisionficha4,
                  true
                );

                var colision5 = raycaster.intersectObjects(
                  colisionficha5,
                  true
                );

                if( colision.length > 0 ){
                  if(colision[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                    if(ficha3_e == false){
                      $("#3").toggle();
                      ficha3_e = true;
                    }

                    puntos_per1 = puntos_per1 + 10;
                    cantidadfichas_1 = cantidadfichas_1 + 1;
                    scene.remove(colision[0].object.parent);
                    colisionficha.pop(colision[0].object.parent);

                    //debugger;
                  }
                }

                if( colision2.length > 0 ){
                  if(colision2[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                    if(ficha1_i == false && ficha2_i == false){
                      $("#1").toggle();
                      ficha1_i = true;
                      ficha2_i = false;
                    }
                    else if(ficha1_i == true &&  ficha2_i == false){
                      $("#2").toggle();
                      ficha2_i = true;
                      ficha1_i = true;
                    }

                    puntos_per1 = puntos_per1 + 10;
                    cantidadfichas_1 = cantidadfichas_1 + 1;

                    scene.remove(colision2[0].object.parent);
                    colisionficha2.pop(colision2[0].object.parent);


                    //debugger;
                  }
                }

                if( colision3.length > 0 ){
                  if(colision3[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                    if(ficha1_i == false && ficha2_i == false){
                      $("#1").toggle();
                      ficha1_i = true;
                      ficha2_i = false;
                    }
                    else if(ficha1_i == true &&  ficha2_i == false){
                      $("#2").toggle();
                      ficha2_i = true;
                      ficha1_i = true;
                    }

                    puntos_per1 = puntos_per1 + 10;
                    cantidadfichas_1 = cantidadfichas_1 + 1;

                    scene.remove(colision3[0].object.parent);
                    colisionficha3.pop(colision3[0].object.parent);


                    //debugger;
                  }
                }

                if( colision4.length > 0 ){
                  if(colision4[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                    if(ficha1_i == false && ficha2_i == false){
                      $("#1").toggle();
                      ficha1_i = true;
                      ficha2_i = false;
                    }
                    else if(ficha1_i == true &&  ficha2_i == false){
                      $("#2").toggle();
                      ficha2_i = true;
                      ficha1_i = true;
                    }

                    puntos_per1 = puntos_per1 + 10;
                    cantidadfichas_1 = cantidadfichas_1 + 1;

                    scene.remove(colision4[0].object.parent);
                    colisionficha4.pop(colision4[0].object.parent);


                    //debugger;
                  }
                }

                if( colision5.length > 0 ){
                  if(colision5[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                    if(ficha1_i == false && ficha2_i == false){
                      $("#1").toggle();
                      ficha1_i = true;
                      ficha2_i = false;
                    }
                    else if(ficha1_i == true &&  ficha2_i == false){
                      $("#2").toggle();
                      ficha2_i = true;
                      ficha1_i = true;
                    }

                    puntos_per1 = puntos_per1 + 10;
                    cantidadfichas_1 = cantidadfichas_1 + 1;

                    scene.remove(colision5[0].object.parent);
                    colisionficha5.pop(colision5[0].object.parent);

                  }
                }            
              }

              for(var i = 0; i < persona_2.misRayos.length; i++){
                var rayo_2 = persona_2.misRayos[i];

                raycaster_2.set( persona_2.position, rayo_2 );

                var colision = raycaster_2.intersectObjects(
                  colisionficha,
                  true
                );

                var colision2 = raycaster_2.intersectObjects(
                  colisionficha2,
                  true
                );

                var colision3 = raycaster_2.intersectObjects(
                  colisionficha3,
                  true
                );

                var colision4 = raycaster_2.intersectObjects(
                  colisionficha4,
                  true
                );

                var colision5 = raycaster_2.intersectObjects(
                  colisionficha5,
                  true
                );

                if( colision.length > 0 ){
                  if(colision[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                    if(ficha3_e_2 == false){
                      $("#6").toggle();
                      ficha3_e = true;
                    }

                    puntos_per2 = puntos_per2 + 10;
                    cantidadfichas_2 = cantidadfichas_2 + 1;
                    scene.remove(colision[0].object.parent);
                    colisionficha.pop(colision[0].object.parent);

                    //debugger;
                  }
                }

                if( colision2.length > 0 ){
                  if(colision2[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                    if(ficha1_i_2 == false && ficha2_i_2 == false){
                      $("#4").toggle();
                      ficha1_i_2 = true;
                      ficha2_i_2 = false;
                    }
                    else if(ficha1_i_2 == true &&  ficha2_i_2 == false){
                      $("#5").toggle();
                      ficha2_i_2 = true;
                      ficha1_i_2 = true;
                    }

                    puntos_per2 = puntos_per2 + 10;
                    cantidadfichas_2 = cantidadfichas_2 + 1;

                    scene.remove(colision2[0].object.parent);
                    colisionficha2.pop(colision2[0].object.parent);

                    //debugger;
                  }
                }

                if( colision3.length > 0 ){
                  if(colision3[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                    if(ficha1_i_2 == false && ficha2_i_2 == false){
                      $("#4").toggle();
                      ficha1_i_2 = true;
                      ficha2_i_2 = false;
                    }
                    else if(ficha1_i_2 == true &&  ficha2_i_2 == false){
                      $("#5").toggle();
                      ficha2_i_2 = true;
                      ficha1_i_2 = true;
                    }

                    puntos_per2 = puntos_per2 + 10;
                    cantidadfichas_2 = cantidadfichas_2 + 1;

                    scene.remove(colision3[0].object.parent);
                    colisionficha3.pop(colision3[0].object.parent);

                    //debugger;
                  }
                }

                if( colision4.length > 0 ){
                  if(colision4[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                    if(ficha1_i_2 == false && ficha2_i_2 == false){
                      $("#4").toggle();
                      ficha1_i_2 = true;
                      ficha2_i_2 = false;
                    }
                    else if(ficha1_i_2 == true &&  ficha2_i_2 == false){
                      $("#5").toggle();
                      ficha2_i_2 = true;
                      ficha1_i_2 = true;
                    }

                    puntos_per2 = puntos_per2 + 10;
                    cantidadfichas_2 = cantidadfichas_2 + 1;

                    scene.remove(colision4[0].object.parent);
                    colisionficha4.pop(colision4[0].object.parent);

                    //debugger;
                  }
                }

                if( colision5.length > 0 ){
                  if(colision5[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                    if(ficha1_i_2 == false && ficha2_i_2 == false){
                      $("#4").toggle();
                      ficha1_i_2 = true;
                      ficha2_i_2 = false;
                    }
                    else if(ficha1_i_2 == true &&  ficha2_i_2 == false){
                      $("#5").toggle();
                      ficha2_i_2 = true;
                      ficha1_i_2 = true;
                    }

                    puntos_per2 = puntos_per2 + 10;
                    cantidadfichas_2 = cantidadfichas_2 + 1;

                    scene.remove(colision5[0].object.parent);
                    colisionficha5.pop(colision5[0].object.parent);

                    //debugger;
                  }
                }

              }
              //var puntuacion = puntos_per1;

              //document.getElementsByName("ptsUsuario").value = puntuacion;
              //document.getElementById("ptsUsuario").setAttribute("value",puntuacion);
              
            }
            
            if(cantidadfichas_1 >= 3 && Usuario1Gano == false && cantidadfichas_2 < 3){
              //alert("GANASTE JUGADOR 1, PERDISTE JUGADOR 2");
              Usuario1Gano = true;
              Usuario2Gano = false;

              $('#JuegoTerminado1').css('display', 'block');
              var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 5.5); //1.0
              scene.add(ambientLight);

              $('#puntos').append("Puntos del Usuario : " + puntos_per1);
              $('#puntuacionUsuario').val(puntos_per1);
              //debugger;

              //$('#salir').onclick(function(){
              //  $(location).attr('href', '/');
              //});

              $('body').on('click', '#guardar', function(){

                //var score = $("#puntos").val();
                var idUsu = $("#usuid").val();
                var score = puntos_per1;

                var dataToSend = { action: "/puntuaciones", puntos: score, user_id: idUsu, activo: 1 };
                //debugger;
                $.ajax({
                  url: '/puntuaciones',
                  async: true,
                  method: 'POST',
                  data: dataToSend,
                  dataType: 'json',
                  success: function(respuestaDelServer){

                    alert(respuestaDelServer.score);
                  },

                  error: function(x, h, r) {
                    alert("Error: " + x + h + r);
                  }
                });
              });

              $('body').on('click', '#salir', function(){
                $(location).attr('href', '/');
              });

            }
            
            if(cantidadfichas_2 >= 3 && Usuario2Gano == false && cantidadfichas_1 < 3){
              //alert("GANASTE JUGADOR 2, PERDISTE JUGADOR 1");
              Usuario1Gano = false;
              Usuario2Gano = true;

              $('#JuegoTerminado2').css('display', 'block');
              var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 5.5); //1.0
              scene.add(ambientLight);

              $('#puntos2').append("Puntos del Usuario : " + puntos_per1);
              $('#puntuacionUsuario_2').val(puntos_per1);

              $('body').on('click', '#guardar_2', function(){

                //var score = $("#puntos").val();
                var idUsu = $("#usuid2").val();
                var score = puntos_per1;

                var dataToSend = { action: "/puntuaciones", puntos: score, user_id: idUsu, activo: 1 };
                //debugger;
                $.ajax({
                  url: '/puntuaciones',
                  async: true,
                  method: 'POST',
                  data: dataToSend,
                  dataType: 'json',
                  success: function(respuestaDelServer){

                    alert(respuestaDelServer.score);
                  },

                  error: function(x, h, r) {
                    alert("Error: " + x + h + r);
                  }
                });
              });

              $('body').on('click', '#salir2', function(){
                $(location).attr('href', '/');
              });
            }

            
            renderer.render(scene, camera);
            renderer_2.render(scene, camera_2);      
          } 
            
        }

        function render_2(){
          requestAnimationFrame(render_2); 
          if(pause == false){
            var bool=false;
            deltaTime = clock.getDelta();	
            Usuario1Gano_2 = false;
            

            for(var i = 0; i < NIVELDOS.length; i++){
              if(estaEnNivelDos == true){
                if(i != 2){
                  NIVELDOS[i].scale.set(0.5, 0.5, 0.5);
                }
                if(sevefichaKUtoogle == false && i==2){
                  NIVELDOS[i].scale.set(1, 1, 1);
                }
              }
              else{
                NIVELDOS[i].scale.set(0, 0, 0);
              }
            }

            if (mixers.length > 0) {
              for (var i = 0; i < mixers.length; i++) {
                mixers[i].update(deltaTime);
              }
            }

            if (mixers_2.length > 0) {
              for (var i = 0; i < mixers_2.length; i++) {
                mixers_2[i].update(deltaTime);
              }
            }

            var yaw = 0;
            var forward = 0;
            if (keys["A"]) {
              yaw = 2;
            } else if (keys["D"]) {
              yaw = -2;
            }
            if (keys["W"]) {
              forward = -20;
            } else if (keys["S"]) {
              forward = 20;
            }

            var yaw_2 = 0;
            var forward_2 = 0;
            gamepad_2 = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads : []);
            if (gamepad_2.length>0){
                gamepad_2 = gamepad_2[0];
            }

            if(gamepad_2){
              //console.log('entro gamepad_2');
              if(gamepad_2.connected){
                if(gamepad_2.axes[0]>.5){
                  //console.log('entro button pressed');
                  yaw_2 = -2;
                }
                if(gamepad_2.axes[1]>.5){
                  //console.log('entro axes 1 >');
                  forward_2 = 20;
                }
                if(gamepad_2.axes[0]<-.5){
                  //console.log('entro axes 0 < ');
                  yaw_2 = 2;
                }
                if(gamepad_2.axes[1]<-.5){
                  //console.log('entro axes 1 < ');
                  forward_2 = -20;
                }
              }
              
            }

            //var yaw_2 = 0;
            //var forward_2 = 0;
            //if (keys["J"]) {
            //  yaw_2 = 2;
            //} else if (keys["L"]) {
            //  yaw_2 = -2;
            //}
            //if (keys["I"]) {
            //  forward_2 = -20;
            //} else if (keys["K"]) {
            //  forward_2 = 20;
            //}

            if (isWorldReady[0] && isWorldReady[1]) {

              persona.translateZ(forward * deltaTime);
              persona_2.translateZ(forward_2 * deltaTime);

              for(var i = 0; i < persona.misRayos.length; i++){
                var rayo = persona.misRayos[i];

                raycaster.set( persona.position, rayo );

                var colision = raycaster.intersectObjects(
                  objetosConColision,
                  true
                );

                if( colision.length > 0 ){
                  if(colision[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                  }
                }
              }

              for(var i = 0; i < persona_2.misRayos.length; i++){
                var rayo_2 = persona_2.misRayos[i];

                raycaster_2.set( persona_2.position, rayo_2 );

                var colision_2 = raycaster_2.intersectObjects(
                  objetosConColision,
                  true
                );

                if( colision_2.length > 0 ){
                  if(colision_2[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                  }
                }
              }
              persona.rotation.y += yaw * deltaTime;
              persona_2.rotation.y += yaw_2 * deltaTime;
            }

            if (isWorldReady[17]) {
                for(var i = 0; i < persona.misRayos.length; i++){
                    var rayo = persona.misRayos[i];

                    raycaster.set( persona.position, rayo );

                    var colision = raycaster.intersectObjects(
                      colisionficha1_2,
                      true
                    );

                    var colision2 = raycaster.intersectObjects(
                      colisionficha2_2,
                      true
                    );

                    var colision3 = raycaster.intersectObjects(
                      colisionficha3_2,
                      true
                    );

                    var colision4 = raycaster.intersectObjects(
                      colisionFarol_1,
                      true
                    );

                    if( colision.length > 0 ){
                      if(colision[0].distance < 3){
                        persona.translateZ(-(forward * deltaTime));
                        if(ficha1_ka == false){
                          $("#7").toggle();
                          ficha1_ka = true;
                        }

                        obtuvofichaKA = true;
                                            
                        puntos_per1_2 = puntos_per1_2 + 15;

                        colision[0].object.scale.set(0,0,0);
                        
                        if(fichita.length == 0){
                          fichita.push(colision[0].object.parent);
                        }

                        for(var i=0; i<fichita.length; i++){
                          fichita[i].scale.set(0,0,0);
                        }
                        fichaKAColisionada = true;
                      }
                    }

                    if(fichaKAColisionada_2 == true){
                      inter = setInterval(function(){
                        for(var i=0; i<fichita.length; i++){
                          fichita[i].scale.set(0.5, 0.5, 0.5);
                          fichita[i].children[0].scale.set(1, 1, 1);
                        } 
                        fichaKAColisionada_2 = false;
                        //clearInterval(inter);
                      }, 5000, "JavaScript");
                      colisionoDeNuevo_2 = true;
                    }

                    if(colisionoDeNuevo_2 == true){
                      if( colision.length > 0 ){
                        if(colision[0].distance < 3){
                          scene.remove(colision[0].object.parent);
                          colisionficha1_2.pop(colision[0].object.parent);
                        }
                      }
                      colisionoDeNuevo_2 = false;
                      fichaKAColisionada_2 = false;
                    }

                    if( colision2.length > 0 ){
                      if(colision2[0].distance < 3){
                        persona.translateZ(-(forward * deltaTime));
                        if(ficha1_zo == false){
                          $("#8").toggle();
                          ficha1_zo = true;
                        }

                        //puntos_per1_2 = puntos_per1_2 + 15;
                        obtuvofichaZO = true;

                        colision2[0].object.scale.set(0,0,0);
                        
                        if(fichita2.length == 0){
                          fichita2.push(colision2[0].object.parent);
                        }

                        for(var i=0; i<fichita2.length; i++){
                          fichita2[i].scale.set(0,0,0);
                        }
                        fichaZOColisionada = true;

                        //fichita2.push(colision2[0].object.parent);
                        //fichita2[0].scale.set(0,0,0);
                        //fichaZOColisionada = true;
                        //scene.remove(colision2[0].object.parent);
                        //colisionficha2_2.pop(colision2[0].object.parent);
                      }
                    }

                    if(fichaZOColisionada_2 == true){
                      inter_2 = setInterval(function(){
                        for(var i=0; i<fichita2.length; i++){
                          fichita2[i].children[0].scale.set(0.5, 0.5, 0.5);
                          //fichita2[i].children[0].scale.set(1, 1, 1);
                        } 
                        fichaZOColisionada_2 = false;
                        //clearInterval(inter);
                      }, 5000, "JavaScript");
                      colisionoDeNuevo1_2 = true;
                    }

                    if(colisionoDeNuevo1_2 == true){
                      if( colision2.length > 0 ){
                        if(colision2[0].distance < 3){
                          scene.remove(colision2[0].object.parent);
                          colisionficha2_2.pop(colision2[0].object.parent);
                        }
                      }
                      colisionoDeNuevo1_2 = false;
                      fichaZOColisionada_2 = false;
                    } 

                    if( colision3.length > 0 ){
                      if(colision3[0].distance < 3){
                        persona.translateZ(-(forward * deltaTime));
                        if(ficha1_ku == false){
                          $("#9").toggle();
                          ficha1_ku = true;
                        }

                        sevefichaKUtoogle = false;
                        //puntos_per1_2 = puntos_per1_2 + 15;
                        obtuvofichaKU = true;
                        
                        fichita3.push(colision3[0].object.parent);
                        fichita3[0].scale.set(0,0,0);
                        fichaKUColisionada = true;
                        //scene.remove(colision3[0].object.parent);
                        //colisionficha3_2.pop(colision3[0].object.parent);
                      }
                    }
                    if(fichaKUColisionada == true){
                      var inter4 = setInterval(function(){ 
                        fichita3[0].scale.set(1, 1, 1);
                        fichita3[0].children[0].scale.set(1, 1, 1);
                      }, 5000, "JavaScript");
                    }  

                    if( colision4.length > 0 ){
                      if(colision4[0].distance < 3){
                        persona.translateZ(-(forward * deltaTime));
                        sevefichaKUtoogle = true;
                      }
                    }

                    if(sevefichaKUtoogle == true){
                      fichaKUtoggle.scale.set(0.5, 0.5, 0.5);
                    }
                    else{
                      fichaKUtoggle.scale.set(0, 0, 0);
                    }
              }

              for(var i = 0; i < persona_2.misRayos.length; i++){
                var rayo_2 = persona_2.misRayos[i];

                raycaster_2.set( persona_2.position, rayo_2 );

                var colision = raycaster_2.intersectObjects(
                      colisionficha1_2,
                      true
                    );

                    var colision2 = raycaster_2.intersectObjects(
                      colisionficha2_2,
                      true
                    );

                    var colision3 = raycaster_2.intersectObjects(
                      colisionficha3_2,
                      true
                    );

                    var colision4 = raycaster_2.intersectObjects(
                      colisionFarol_1,
                      true
                    );

                if( colision.length > 0 ){
                      if(colision[0].distance < 3){
                        persona_2.translateZ(-(forward_2 * deltaTime));
                        if(ficha2_ka == false){
                          $("#10").toggle();
                          ficha2_ka = true;
                        }
                        
                        obtuvofichaKA_2 = true;
                        puntos_per2_2 = puntos_per2_2 + 15;
                        //cantidadfichas_2_2 = cantidadfichas_2_2 + 1;

                        colision[0].object.scale.set(0,0,0);
                        
                        if(fichita.length == 0){
                          fichita.push(colision[0].object.parent);
                        }
                        for(var i=0; i<fichita.length; i++){
                          fichita[i].scale.set(0,0,0);
                        }
                        fichaKAColisionada_2 = true;
                      }
                    }

                    if(fichaKAColisionada == true){
                      inter = setInterval(function(){
                        for(var i=0; i<fichita.length; i++){
                          fichita[i].scale.set(0.5, 0.5, 0.5);
                          fichita[i].children[0].scale.set(1, 1, 1);
                        } 
                        fichaKAColisionada = false;
                        //clearInterval(inter);
                      }, 5000, "JavaScript");
                      colisionoDeNuevo = true;
                    }

                    if(colisionoDeNuevo == true){
                      if( colision.length > 0 ){
                        if(colision[0].distance < 3){
                          scene.remove(colision[0].object.parent);
                          colisionficha1_2.pop(colision[0].object.parent);
                        }
                      }
                      colisionoDeNuevo = false;
                      fichaKAColisionada = false;
                    }




                    if( colision2.length > 0 ){
                      if(colision2[0].distance < 3){
                        persona_2.translateZ(-(forward_2 * deltaTime));
                        if(ficha2_zo == false){
                          $("#11").toggle();
                          ficha2_zo = true;
                        }
                        
                        obtuvofichaZO_2 = true; 
                        //puntos_per2_2 = puntos_per2_2 + 15;
                        //cantidadfichas_2_2 = cantidadfichas_2_2 + 1;

                        colision2[0].object.scale.set(0,0,0);
                        
                        if(fichita2.length == 0){
                          fichita2.push(colision2[0].object.parent);
                        }

                        for(var i=0; i<fichita2.length; i++){
                          fichita2[i].scale.set(0,0,0);
                        }
                        fichaZOColisionada_2 = true;

                        //fichita2.push(colision2[0].object.parent);
                        //fichita2[0].scale.set(0,0,0);
                        //fichaZOColisionada = true;
                        //scene.remove(colision2[0].object.parent);
                        //colisionficha2_2.pop(colision2[0].object.parent);
                      }
                    }

                    if(fichaZOColisionada == true){
                      inter_2 = setInterval(function(){
                        for(var i=0; i<fichita2.length; i++){
                          fichita2[i].children[0].scale.set(0.5, 0.5, 0.5);
                          //fichita2[i].children[0].scale.set(1, 1, 1);
                        } 
                        fichaZOColisionada = false;
                        //clearInterval(inter);
                      }, 5000, "JavaScript");
                      colisionoDeNuevo1 = true;
                    }

                    if(colisionoDeNuevo1 == true){
                      if( colision2.length > 0 ){
                        if(colision2[0].distance < 3){
                          scene.remove(colision2[0].object.parent);
                          colisionficha2_2.pop(colision2[0].object.parent);
                        }
                      }
                      colisionoDeNuevo1 = false;
                      fichaZOColisionada = false;
                    } 



                    if( colision3.length > 0 ){
                      if(colision3[0].distance < 3){
                        persona_2.translateZ(-(forward_2 * deltaTime));
                        if(ficha2_ku == false){
                          $("#12").toggle();
                          ficha2_ku = true;
                        }

                        obtuvofichaKU_2 = true;
                        sevefichaKUtoogle = false;
                        //puntos_per2_2 = puntos_per2_2 + 15;
                        //cantidadfichas_2_2 = cantidadfichas_2_2 + 1;
                        
                        fichita3_2.push(colision3[0].object.parent);
                        fichita3_2[0].scale.set(0,0,0);
                        fichaKUColisionada_2 = true;
                        //scene.remove(colision3[0].object.parent);
                        //colisionficha3_2.pop(colision3[0].object.parent);
                      }
                    }
                    if(fichaKUColisionada_2 == true){
                      var inter3 = setInterval(function(){ 
                        fichita3_2[0].scale.set(1, 1, 1);
                        fichita3_2[0].children[0].scale.set(1, 1, 1);
                      }, 5000, "JavaScript");
                    }  

                    if( colision4.length > 0 ){
                      if(colision4[0].distance < 3){
                        persona_2.translateZ(-(forward_2 * deltaTime));
                        sevefichaKUtoogle = true;
                      }
                    }

                    if(sevefichaKUtoogle == true){
                      fichaKUtoggle.scale.set(0.5, 0.5, 0.5);
                    }
                    else{
                      fichaKUtoggle.scale.set(0, 0, 0);
                    }

              }
            }
            
            if(timer <= 0 && !seAcaboElTiempo){
              //GAMEOVER
              $('#LOSER').css('display', 'block');
              var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 5.5); //1.0
              scene.add(ambientLight);
              $('body').on('click', '#salir3', function(){
                $(location).attr('href', '/');
              });
              seAcaboElTiempo = true;
              Usuario1Gano_2 = false;

            } 
            if(obtuvofichaKA == true && obtuvofichaZO == true && obtuvofichaKU == true && Usuario1Gano_2 == false){
              seAcaboElTiempo = true;
              Usuario1Gano_2 = true;
              Usuario2Gano_2 = false;

              $('#Prueba').css('display', 'block');
              var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 4.5); //1.0
              scene.add(ambientLight);

              if(unaVez == false){
                $('#score_puntos').append("Puntos del Usuario : " + puntos_per1_2);
                unaVez = true;
              }
              $('#puntuacionUsuario_3').val(puntos_per1_2);

              $('body').on('click', '#guardarNivelDos', function(){
                //var score = $("#puntos").val();
                var idUsu = $("#usuid3").val();
                var score = puntos_per1_2;
                var dataToSend = { action: "/puntuaciones", puntos: score, user_id: idUsu, activo: 1 };
                if(unaVezguardarpuntuacion == false){
                  //debugger;
                    $.ajax({
                      url: '/puntuaciones',
                      async: true,
                      method: 'POST',
                      data: dataToSend,
                      dataType: 'json',
                      success: function(respuestaDelServer){
                        alert(respuestaDelServer.score);
                      },
                      error: function(x, h, r) {
                        alert("Error: " + x + h + r);
                      }
                    });
                  unaVezguardarpuntuacion = true;
                }
              });

              $('body').on('click', '#salir4', function(){
                $(location).attr('href', '/');
              });
            }

            if(obtuvofichaKA_2 == true && obtuvofichaZO_2 == true && obtuvofichaKU_2 == true && Usuario2Gano_2 == false){
              seAcaboElTiempo = true;
              Usuario1Gano_2 = false;
              Usuario2Gano_2 = true;

              $('#Prueba_2').css('display', 'block');
              var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 4.5); //1.0
              scene.add(ambientLight);

              if(unaVez_2 == false){
                $('#score_puntos_2').append("Puntos del Usuario : " + puntos_per1_2);
                unaVez_2 = true;
              }

              $('#puntuacionUsuario_4').val(puntos_per1_2);

              $('body').on('click', '#guardarNivelDos_2', function(){
                //var score = $("#puntos").val();
                var idUsu = $("#usuid3_2").val();
                var score = puntos_per1_2;
                var dataToSend = { action: "/puntuaciones", puntos: score, user_id: idUsu, activo: 1 };
                if(unaVezguardarpuntuacion_2 == false){
                  //debugger;
                    $.ajax({
                      url: '/puntuaciones',
                      async: true,
                      method: 'POST',
                      data: dataToSend,
                      dataType: 'json',
                      success: function(respuestaDelServer){
                        alert(respuestaDelServer.score);
                      },
                      error: function(x, h, r) {
                        alert("Error: " + x + h + r);
                      }
                    });
                  unaVezguardarpuntuacion_2 = true;
                }
              });

              $('body').on('click', '#salir4_2', function(){
                $(location).attr('href', '/');
              });
            }
          }
          //if(pause == true ){
          //  seAcaboElTiempo = true;
          //}
          //if(pause == false){
          //  seAcaboElTiempo = false;
          //}
        }

        function render_3(){
          requestAnimationFrame(render_3);
          if(pause == false){
            var bool=false;
            deltaTime = clock.getDelta();

            arcoiris.time.value += 0.5*deltaTime;
          
            for(var i = 0; i < NIVELTRES.length; i++){
              if(estaEnNivelTres == true){
                NIVELTRES[i].scale.set(0.5, 0.5, 0.5);
              }
              else{
                NIVELTRES[i].scale.set(0, 0, 0);
              }
            }

            if (mixers.length > 0) {
              for (var i = 0; i < mixers.length; i++) {
                mixers[i].update(deltaTime);
              }
            }

            if (mixers_2.length > 0) {
              for (var i = 0; i < mixers_2.length; i++) {
                mixers_2[i].update(deltaTime);
              }
            }

            var yaw = 0;
            var forward = 0;
            if (keys["A"]) {
              yaw = 2;
            } else if (keys["D"]) {
              yaw = -2;
            }
            if (keys["W"]) {
              forward = -20;
            } else if (keys["S"]) {
              forward = 20;
            }

            var yaw_2 = 0;
            var forward_2 = 0;
            gamepad_2 = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads : []);
            if (gamepad_2.length>0){
                gamepad_2 = gamepad_2[0];
            }
            
            if(gamepad_2){
              //console.log('entro gamepad_2');
              if(gamepad_2.connected){
                if(gamepad_2.axes[0]>.5){
                  //console.log('entro button pressed');
                  yaw_2 = -2;
                }
                if(gamepad_2.axes[1]>.5){
                  //console.log('entro axes 1 >');
                  forward_2 = 20;
                }
                if(gamepad_2.axes[0]<-.5){
                  //console.log('entro axes 0 < ');
                  yaw_2 = 2;
                }
                if(gamepad_2.axes[1]<-.5){
                  //console.log('entro axes 1 < ');
                  forward_2 = -20;
                }
              }
              
            }

            //if (keys["J"]) {
            //  yaw_2 = 2;
            //} else if (keys["L"]) {
            //  yaw_2 = -2;
            //}
            //if (keys["I"]) {
            //  forward_2 = -20;
            //} else if (keys["K"]) {
            //  forward_2 = 20;
            //}

            if (isWorldReady[0] && isWorldReady[1]) {
              persona.translateZ(forward * deltaTime);
              persona_2.translateZ(forward_2 * deltaTime);

              for(var i = 0; i < persona.misRayos.length; i++){
                var rayo = persona.misRayos[i];

                raycaster.set( persona.position, rayo );

                var colision = raycaster.intersectObjects(
                  objetosConColision,
                  true
                );

                if( colision.length > 0 ){
                  if(colision[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                  }
                }
              }

              for(var i = 0; i < persona_2.misRayos.length; i++){
                var rayo_2 = persona_2.misRayos[i];

                raycaster_2.set( persona_2.position, rayo_2 );

                var colision_2 = raycaster_2.intersectObjects(
                  objetosConColision,
                  true
                );

                if( colision_2.length > 0 ){
                  if(colision_2[0].distance < 3){
                    persona_2.translateZ(-(forward_2 * deltaTime));
                  }
                }
              }
              persona.rotation.y += yaw * deltaTime;
              persona_2.rotation.y += yaw_2 * deltaTime;
            }

            if (isWorldReady[18]) {
              for(var i = 0; i < persona.misRayos.length; i++){
                    var rayo = persona.misRayos[i];

                    raycaster.set( persona.position, rayo );

                    var colision = raycaster.intersectObjects(
                      colisionficha3_1,
                      true
                    );

                    var colision2 = raycaster.intersectObjects(
                      colisionficha3_1_2,
                      true
                    );

                    var colision3 = raycaster.intersectObjects(
                      colisionficha3_1_3,
                      true
                    );

                    if( colision.length > 0 ){
                      if(colision[0].distance < 3){
                        persona.translateZ(-(forward * deltaTime));
                        if(ficha1_tomo == false){
                          $("#13").toggle();
                          ficha1_tomo = true;
                        }
                        obtuvofichaTOMO = true;
                                            
                        ptsUsuario = ptsUsuario + 20;
                        colision[0].object.scale.set(0,0,0);
                        
                        if(fichitaTOMO.length == 0){
                          fichitaTOMO.push(colision[0].object.parent);
                        }

                        for(var i=0; i<fichitaTOMO.length; i++){
                          fichitaTOMO[i].scale.set(0,0,0);
                        }
                        colisionofichaTOMO = true;
                      }
                    }

                    if(colisionofichaTOMO_2 == true){
                      intermedio_1 = setInterval(function(){
                        for(var i=0; i<fichitaTOMO.length; i++){
                          fichitaTOMO[i].scale.set(0.5, 0.5, 0.5);
                          fichitaTOMO[i].children[0].scale.set(1, 1, 1);
                        } 
                        colisionofichaTOMO_2 = false;
                      }, 5000, "JavaScript");
                      segundaColision_2 = true;
                    }

                    if(segundaColision_2 == true){
                      if( colision.length > 0 ){
                        if(colision[0].distance < 3){
                          scene.remove(colision[0].object.parent);
                          colisionficha3_1.pop(colision[0].object.parent);
                        }
                      }
                      segundaColision_2 = false;
                      colisionofichaTOMO_2 = false;
                    }

                  if( colision2.length > 0 ){
                      if(colision2[0].distance < 3){
                        persona.translateZ(-(forward * deltaTime));
                        if(ficha1_dachi == false){
                          $("#14").toggle();
                          ficha1_dachi = true;
                        }
                        obtuvofichaDACHI = true;
                                            
                        ptsUsuario = ptsUsuario + 20;
                        colision2[0].object.scale.set(0,0,0);
                        
                        if(fichitaDACHI.length == 0){
                          fichitaDACHI.push(colision2[0].object.parent);
                        }

                        for(var i=0; i<fichitaDACHI.length; i++){
                          fichitaDACHI[i].scale.set(0,0,0);
                        }
                        colisionofichaDACHI = true;
                      }
                  }

                  if(colisionofichaDACHI_2 == true){
                    intermedio_2 = setInterval(function(){
                      for(var i=0; i<fichitaDACHI.length; i++){
                        fichitaDACHI[i].scale.set(0.5, 0.5, 0.5);
                        fichitaDACHI[i].children[0].scale.set(1, 1, 1);
                      } 
                      colisionofichaDACHI_2 = false;
                    }, 5000, "JavaScript");
                    segundaColision2_2 = true;
                  }

                  if(segundaColision2_2 == true){
                    if( colision2.length > 0 ){
                      if(colision2[0].distance < 3){
                        scene.remove(colision2[0].object.parent);
                        colisionficha3_1_2.pop(colision2[0].object.parent);
                      }
                    }
                    segundaColision2_2 = false;
                    colisionofichaDACHI_2 = false;
                  }
                    
                if( colision3.length > 0 ){
                  if(colision3[0].distance < 3){
                    persona.translateZ(-(forward * deltaTime));
                    if(ficha1_comodin == false){
                      $("#15").toggle();
                      ficha1_comodin = true;
                    }
                    obtuvofichaCOMODIN = true;
                    ptsUsuario = ptsUsuario + 40;
                    scene.remove(colision3[0].object.parent);
                    colisionficha3_1_3.pop(colision3[0].object.parent);
                  }
                }

              }

              for(var i = 0; i < persona_2.misRayos.length; i++){
                var rayo_2 = persona_2.misRayos[i];

                raycaster_2.set( persona_2.position, rayo_2 );

                var colision = raycaster_2.intersectObjects(
                      colisionficha3_1,
                      true
                    );

                    var colision2 = raycaster_2.intersectObjects(
                      colisionficha3_1_2,
                      true
                    );     

                    var colision3 = raycaster_2.intersectObjects(
                      colisionficha3_1_3,
                      true
                    );       

                    if( colision.length > 0 ){
                      if(colision[0].distance < 3){
                        persona_2.translateZ(-(forward_2 * deltaTime));
                        if(ficha2_tomo == false){
                          $("#16").toggle();
                          ficha2_tomo = true;
                        }
                        obtuvofichaTOMO_2 = true;
                        ptsJugador2 = ptsJugador2 + 20;
                        colision[0].object.scale.set(0,0,0);
                        
                        if(fichitaTOMO.length == 0){
                          fichitaTOMO.push(colision[0].object.parent);
                        }

                        for(var i=0; i<fichitaTOMO.length; i++){
                          fichitaTOMO[i].scale.set(0,0,0);
                        }
                        colisionofichaTOMO_2 = true;
                      }
                    }  

                    if(colisionofichaTOMO == true){
                      intermedio_1 = setInterval(function(){
                        for(var i=0; i<fichitaTOMO.length; i++){
                          fichitaTOMO[i].scale.set(0.5, 0.5, 0.5);
                          fichitaTOMO[i].children[0].scale.set(1, 1, 1);
                        } 
                      colisionofichaTOMO = false;
                      }, 5000, "JavaScript");
                      segundaColision = true;
                    }

                    if(segundaColision == true){
                      if( colision.length > 0 ){
                        if(colision[0].distance < 3){
                          scene.remove(colision[0].object.parent);
                          colisionficha3_1.pop(colision[0].object.parent);
                        }
                      }
                      segundaColision = false;
                      colisionofichaTOMO = false;
                    }

                    if( colision2.length > 0 ){
                      if(colision2[0].distance < 3){
                        persona_2.translateZ(-(forward_2 * deltaTime));
                        if(ficha2_dachi == false){
                          $("#17").toggle();
                          ficha2_dachi = true;
                        }
                        obtuvofichaDACHI_2 = true;
                                            
                        ptsJugador2 = ptsJugador2 + 20;
                        colision2[0].object.scale.set(0,0,0);
                        
                        if(fichitaDACHI.length == 0){
                          fichitaDACHI.push(colision2[0].object.parent);
                        }

                        for(var i=0; i<fichitaDACHI.length; i++){
                          fichitaDACHI[i].scale.set(0,0,0);
                        }
                        colisionofichaDACHI_2 = true;
                      }
                    }

                  if(colisionofichaDACHI == true){
                    intermedio_2 = setInterval(function(){
                      for(var i=0; i<fichitaDACHI.length; i++){
                        fichitaDACHI[i].scale.set(0.5, 0.5, 0.5);
                        fichitaDACHI[i].children[0].scale.set(1, 1, 1);
                      } 
                      colisionofichaDACHI = false;
                    }, 5000, "JavaScript");
                    segundaColision2 = true;
                  }
                  if(segundaColision2 == true){
                    if( colision2.length > 0 ){
                      if(colision2[0].distance < 3){
                        scene.remove(colision2[0].object.parent);
                        colisionficha3_1_2.pop(colision2[0].object.parent);
                      }
                    }
                    segundaColision2 = false;
                    colisionofichaDACHI = false;
                  }

                  if( colision3.length > 0 ){
                    if(colision3[0].distance < 3){
                      persona_2.translateZ(-(forward_2 * deltaTime));
                      if(ficha2_comodin == false){
                        $("#18").toggle();
                        ficha2_comodin = true;
                      }
                      obtuvofichaCOMODIN_2 = true;
                      ptsJugador2 = ptsJugador2 + 40;
                      scene.remove(colision3[0].object.parent);
                      colisionficha3_1_3.pop(colision3[0].object.parent);
                    }
                  }
              }
            }

            if(timer_3 <= 0 && !seAcaboElTiempo_2){
              //GAMEOVER
              $('#LOSER').css('display', 'block');
              var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 2.0); //1.0
              scene.add(ambientLight);
              $('body').on('click', '#salir3', function(){
                $(location).attr('href', '/');
              });
              seAcaboElTiempo_2 = true;
            }

            if((obtuvofichaTOMO == true && obtuvofichaCOMODIN == true) || 
                  (obtuvofichaDACHI == true && obtuvofichaCOMODIN == true) || 
                  (obtuvofichaTOMO == true && obtuvofichaDACHI == true)  && Usuario1Gano_3 == false   ){

                    seAcaboElTiempo_2 = true;
                    Usuario1Gano_3 = true;
                    Usuario2Gano_3 = false;

                    $('#TercerNivel').css('display', 'block');
                    var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 4.5); //1.0
                    scene.add(ambientLight);

                    if(unaVez3 == false){
                      $('#score_tercer').append("Puntos del Usuario : " + ptsUsuario);
                      unaVez3 = true;
                    }

                    $('#puntuacionUsuario_5').val(ptsUsuario);

                    $('body').on('click', '#guardarNivelTres', function(){
                      //var score = $("#puntos").val();
                      var idUsu = $("#usuid_tercer").val();
                      var score = ptsUsuario;
                      var dataToSend = { action: "/puntuaciones", puntos: score, user_id: idUsu, activo: 1 };
                      if(unaVezguardarpuntuacion_3 == false){
                        //debugger;
                          $.ajax({
                            url: '/puntuaciones',
                            async: true,
                            method: 'POST',
                            data: dataToSend,
                            dataType: 'json',
                            success: function(respuestaDelServer){
                              alert(respuestaDelServer.score);
                            },
                            error: function(x, h, r) {
                              alert("Error: " + x + h + r);
                            }
                          });
                          unaVezguardarpuntuacion_3 = true;
                      }
                    });

                    $('body').on('click', '#salir5', function(){
                      $(location).attr('href', '/');
                    });
            }

            if((obtuvofichaTOMO_2 == true && obtuvofichaCOMODIN_2 == true) || 
                  (obtuvofichaDACHI_2 == true && obtuvofichaCOMODIN_2 == true) || 
                  (obtuvofichaTOMO_2 == true && obtuvofichaDACHI_2 == true)  && Usuario2Gano_3 == false   ){

                    seAcaboElTiempo_2 = true;
                    Usuario1Gano_3 = false;
                    Usuario2Gano_3 = true;

                    $('#TercerNivel_2').css('display', 'block');
                    var ambientLight = new THREE.AmbientLight(new THREE.Color(0, 0, 1), 4.5); //1.0
                    scene.add(ambientLight);

                    if(unaVez3_2 == false){
                      $('#score_tercer_2').append("Puntos del Usuario : " + ptsUsuario);
                      unaVez3_2 = true;
                    }
                    $('#puntuacionUsuario_6').val(ptsUsuario);

                    $('body').on('click', '#guardarNivelTres_2', function(){
                      //var score = $("#puntos").val();
                      var idUsu = $("#usuid_tercer_2").val();
                      var score = ptsUsuario;
                      var dataToSend = { action: "/puntuaciones", puntos: score, user_id: idUsu, activo: 1 };
                      if(unaVezguardarpuntuacion2_3 == false){
                        //debugger;
                          $.ajax({
                            url: '/puntuaciones',
                            async: true,
                            method: 'POST',
                            data: dataToSend,
                            dataType: 'json',
                            success: function(respuestaDelServer){
                              alert(respuestaDelServer.score);
                            },
                            error: function(x, h, r) {
                              alert("Error: " + x + h + r);
                            }
                          });
                          unaVezguardarpuntuacion2_3 = true;
                      }
                    });

                    $('body').on('click', '#salir5_2', function(){
                      $(location).attr('href', '/');
                    });
            }
          }
        
        }

        function setupScene() {		
          //var visibleSize = { width: window.innerWidth, height: window.innerHeight};
          var visibleSize = { width: $('#can').width(), height: 800};
          clock = new THREE.Clock();		
          scene = new THREE.Scene();
          persona = new THREE.Object3D();
          
          camera = new THREE.PerspectiveCamera(75, visibleSize.width / (visibleSize.height/2), 0.1, 1000);
          camera.position.z = 2;
          camera.position.y = 10;

          camera_2 = new THREE.PerspectiveCamera(75, visibleSize.width / (visibleSize.height/2), 0.1, 1000);
          camera_2.position.z = 2;
          camera_2.position.y = 10;
          
          //document.getElementById("face").addEventListener('click', saveAsImage);     ////////////////////aqui obtengo el button compartir facebook
          //document.getElementById("face2").addEventListener('click', saveAsImage2);
          //document.getElementById("book").addEventListener('click', saveAsImage);
          //document.getElementById("book_2").addEventListener('click', saveAsImage2);
          //document.getElementById("book_tercer").addEventListener('click', saveAsImage);
          //document.getElementById("book_tercer_2").addEventListener('click', saveAsImage2);

          //
          scene.fog = new THREE.FogExp2( 0x000000, 0.0008 );

            var geometry = new THREE.BufferGeometry();
            var vertices = [];

            var textureLoader = new THREE.TextureLoader();

            var sprite1 = textureLoader.load( 'img/sakura.png' );

            for ( var i = 0; i < 10000; i ++ ) {

              var x = Math.random() * 2000 - 1000;
              var y = Math.random() * 2000 - 1000;
              var z = Math.random() * 2000 - 1000;

              vertices.push( x, y, z );

            }

            geometry.addAttribute( 'position', new THREE.Float32BufferAttribute( vertices, 3 ) );

            parameters = [
              [[ 0.90, 0.05, 0.5 ], sprite1, 11 ]
            ];

            for ( var i = 0; i < parameters.length; i ++ ) {

              var color = parameters[ i ][ 0 ];
              var sprite = parameters[ i ][ 1 ];
              var size = parameters[ i ][ 2 ];

              materials[ i ] = new THREE.PointsMaterial( { size: size, map: sprite, blending: THREE.AdditiveBlending, depthTest: false, transparent: true } );
              materials[ i ].color.setHSL( color[ 0 ], color[ 1 ], color[ 2 ] );

              var particles = new THREE.Points( geometry, materials[ i ] );

              particles.rotation.x = Math.random() * 6;
              particles.rotation.y = Math.random() * 6;
              particles.rotation.z = Math.random() * 6;

              scene.add( particles );
            }
          //

          renderer = new THREE.WebGLRenderer({
            precision: "mediump",
            preserveDrawingBuffer: true
          });
          renderer.setClearColor(new THREE.Color(0, 0, 0));
          //renderer.setPixelRatio(visibleSize.width / visibleSize.height/2);
          renderer.setPixelRatio(window.devicePixelRatio);
          renderer.setSize(visibleSize.width, visibleSize.height/2);
          document.body.appendChild(renderer.domElement);          

          renderer_2 = new THREE.WebGLRenderer({
            precision: "mediump",
            preserveDrawingBuffer: true
          });
          renderer_2.setClearColor(new THREE.Color(0, 0, 0));
          //renderer_2.setPixelRatio(visibleSize.width / visibleSize.height/2);
          renderer_2.setPixelRatio(window.devicePixelRatio);
          renderer_2.setSize(visibleSize.width, visibleSize.height/2);
          document.body.appendChild(renderer_2.domElement); 

          

          var ambientLight = new THREE.AmbientLight(new THREE.Color(1, 1, 1), 1.0);
          scene.add(ambientLight);

          var directionalLight = new THREE.DirectionalLight(new THREE.Color(1, 1, 0), 1.0);
          directionalLight.position.set(0, 0, 1);
          scene.add(directionalLight);

          var grid = new THREE.GridHelper(50, 10, 0xffffff, 0xffffff);
          grid.position.y = -1;
          scene.add(grid);
          
          var a = document.getElementById("can");
          a.appendChild( renderer.domElement );
          a.appendChild( renderer_2.domElement );

          a.addEventListener('resize', onWindowResize, false);
          a.addEventListener('resize', onWindowResize2, false);

          //$('#can').append(renderer.domElement);
        }

        function shareFB() {
              //var imgData;
              //var strMime = "image/jpeg";
              //imgData = renderer.domElement.toDataURL(strMime);
            //OBTENEMOS LA URL DEL PROYECTO OSEA EN MI CASO SERA http://www.localhost:8000/
            var getUrl = window.location;
            var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" ;
            //+ getUrl.pathname.split('/')[1]
            //var im = $('img').attr('src');
            var im = "test.jpg";
            //LE CONCATENAMOS LA RUTA DE LA IMAGEN EN ESTE CASO YO LO TENIA EN UN IMG ENTONCES SACO SU ATRIBUTO src
            baseUrl = baseUrl + im;
            //var score = $("#txtScore").val();
            //console.log(baseUrl);
            //console.log(im);
            //LE AGREGUE UN 2DO PARAMETRO A LA FUNCION PARA RECIBIR LA URL
            //shareScore(score,baseUrl);

		      shareScore(puntos_per1, puntos_per2, baseUrl);
        }

        function share() {
            var getUrl = window.location;
            var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" ;
            var im = "test.jpg";
            baseUrl = baseUrl + im;
            //console.log(baseUrl);
            //console.log(im);
		      shareScore(puntos_per1_2, puntos_per2_2, baseUrl);
        }

        function shareTercer() {
            var getUrl = window.location;
            var baseUrl = getUrl .protocol + "//www." + getUrl.host + "/" ;
            var im = "test.jpg";
            baseUrl = baseUrl + im;
            //console.log(baseUrl);
            //console.log(im);
		      shareScore(ptsUsuario, ptsJugador2, baseUrl);
        }

        function onWindowResize() {
          camera.aspect = visibleSize.width / (visibleSize.height/2);
          camera.updateProjectionMatrix();
          renderer.setSize(visibleSize.width, visibleSize.height/2);
        }
        
        function onWindowResize2() {
          camera_2.aspect = visibleSize.width / (visibleSize.height/2);
          camera_2.updateProjectionMatrix();
          renderer_2.setSize(visibleSize.width, visibleSize.height/2);
        }

        //function saveAsImage() {
        //  var imgData, imgNode;
        //  try {
        //      var strMime = "image/jpeg";
        //      imgData = renderer.domElement.toDataURL(strMime);
        //      saveFile(imgData.replace(strMime, strDownloadMime), "test.jpg");
        //      //var w = window.open('', '');
        //      //w.document.title = "Screenshot";
        //      //var img = new Image();
        //      //renderer.render(scene, camera);
        //      //img.src = renderer.domElement.toDataURL();
        //      //w.document.body.appendChild(img); 
        //  } catch (e) {
        //      console.log(e);
        //      return;
        //  }
        //}
        //function saveAsImage2() {
        //  var imgData, imgNode;
        //  try {
        //      var strMime = "image/jpeg";
        //      imgData = renderer_2.domElement.toDataURL(strMime);
        //      saveFile(imgData.replace(strMime, strDownloadMime), "test2.jpg");
        //  } catch (e) {
        //      console.log(e);
        //      return;
        //  }
        //}
        //var saveFile = function (strData, filename) {
        //  var link = document.createElement('a');
        //  if (typeof link.download === 'string') {
        //      document.body.appendChild(link); //Firefox requires the link to be in the body
        //      link.download = filename;
        //      link.href = strData;
        //      link.click();
        //      document.body.removeChild(link); //remove the link when done
        //  } else {
        //      location.replace(uri);
        //  }
        //}

        function tomarScreen(){
          var imgData;
          var strMime = "image/jpeg";
          imgData = renderer.domElement.toDataURL(strMime);
          var screenshot = document.getElementById("idscreen");
          screenshot.value = imgData;
        }

        function tomarScreen_2(){
          var imgData;
          var strMime = "image/jpeg";
          imgData = renderer.domElement.toDataURL(strMime);
          var screenshot = document.getElementById("idscreen_2");
          screenshot.value = imgData;
        }

        function tomarScreen_3(){
          var imgData;
          var strMime = "image/jpeg";
          imgData = renderer.domElement.toDataURL(strMime);
          var screenshot = document.getElementById("idscreen_3");
          screenshot.value = imgData;
        }

        function tomarScreen_4(){
          var imgData;
          var strMime = "image/jpeg";
          imgData = renderer.domElement.toDataURL(strMime);
          var screenshot = document.getElementById("idscreen_4");
          screenshot.value = imgData;
        }

        function tomarScreen_5(){
          var imgData;
          var strMime = "image/jpeg";
          imgData = renderer.domElement.toDataURL(strMime);
          var screenshot = document.getElementById("idscreen_5");
          screenshot.value = imgData;
        }

        function tomarScreen_6(){
          var imgData;
          var strMime = "image/jpeg";
          imgData = renderer.domElement.toDataURL(strMime);
          var screenshot = document.getElementById("idscreen_6");
          screenshot.value = imgData;
        }

  </script>
  
  <style>
        #JuegoTerminado1{
            display: none;
            z-index: 500;
        }
        #GameOver1{
            z-index: 600;
            position: absolute;
            left: 40%;
            bottom: 26%;
        }
        #puntos{
            z-index: 700;
            position: absolute;
            left: 44%;
            top: 64.7%;
        }
        #face{
            z-index: 800;
            position: absolute;
            left: 43%;
            top: 67%;
        }
        #guardar{
            z-index: 900;
            position: absolute;
            left: 44%;
            top: 70%;
        }
        #salir{
            z-index: 1000;
            position: absolute;
            left: 47%;
            top: 73%;
        }
        
        
        #LOSER{
            display: none;
            z-index: 500;
        }
        #salir3{
            z-index: 600;
            position: absolute;
            left: 47%;
            top: 68%;
        }

        #JuegoTerminado2{
            display: none;
            z-index: 500;
        }
        #GameOver2{
            z-index: 600;
            position: absolute;
            left: 40%;
            bottom: 26%;
        }
        #puntos2{
            z-index: 700;
            position: absolute;
            left: 44%;
            top: 64.7%;
        }
        #face2{
            z-index: 800;
            position: absolute;
            left: 43%;
            top: 67%;
        }
        #guardar_2{
            z-index: 900;
            position: absolute;
            left: 44%;
            top: 70%;
        }
        #salir2{   
            z-index: 900;
            position: absolute;
            left: 47%;
            top: 73%;
        }

        #Prueba{
            display: none;
            z-index: 500;
        }
        
        #pruebaImagen{
            z-index: 600;
            position: absolute;
            left: 40%;
            bottom: 26%;
        }
        #score_puntos{
            z-index: 700;
            position: absolute;
            left: 44%;
            top: 64.7%;
        }
        #book{
            z-index: 800;
            position: absolute;
            left: 43%;
            top: 67%;
        }
        #guardarNivelDos{
            z-index: 900;
            position: absolute;
            left: 44%;
            top: 70%;
        }
        #salir4{   
            z-index: 1000;
            position: absolute;
            left: 47%;
            top: 73%;
        }

        #Prueba_2{
            display: none;
            z-index: 500;
        }
        #pruebaImagen_2{
            z-index: 600;
            position: absolute;
            left: 40%;
            bottom: 26%;
        }
        #score_puntos_2{
            z-index: 700;
            position: absolute;
            left: 44%;
            top: 64.7%;
        }
        #book_2{
            z-index: 800;
            position: absolute;
            left: 43%;
            top: 67%;
        }
        #guardarNivelDos_2{
            z-index: 900;
            position: absolute;
            left: 44%;
            top: 70%;
        }
        #salir4_2{   
            z-index: 1000;
            position: absolute;
            left: 47%;
            top: 73%;
        }

        #TercerNivel{
            display: none;
            z-index: 500;
        }
        #tercerImagen{
            z-index: 600;
            position: absolute;
            left: 40%;
            bottom: 26%;
        }
        #score_tercer{
            z-index: 700;
            position: absolute;
            left: 44%;
            top: 64.7%;
        }
        #book_tercer{
            z-index: 800;
            position: absolute;
            left: 43%;
            top: 67%;
        }
        #guardarNivelTres{
            z-index: 900;
            position: absolute;
            left: 44%;
            top: 70%;
        }
        #salir5{   
            z-index: 1000;
            position: absolute;
            left: 47%;
            top: 73%;
        }

        #TercerNivel_2{
            display: none;
            z-index: 500;
        }
        #tercerImagen_2{
            z-index: 600;
            position: absolute;
            left: 40%;
            bottom: 26%;
        }
        #score_tercer_2{
            z-index: 700;
            position: absolute;
            left: 44%;
            top: 64.7%;
        }
        #book_tercer_2{
            z-index: 800;
            position: absolute;
            left: 43%;
            top: 67%;
        }
        #guardarNivelTres_2{
            z-index: 900;
            position: absolute;
            left: 44%;
            top: 70%;
        }
        #salir5_2{   
            z-index: 1000;
            position: absolute;
            left: 47%;
            top: 73%;
        }
    </style>


</head>

<body id="page-top">
  
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="/">GameJap</a>
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
              <button id="btn_regi" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"> Registrarse</button><br><br>
              <button id="btn_login" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"> Log in</button><br><br>
              @endguest
              <!-- <button id="btn_play"  class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><img width="25" height="25"/> Play</button><br><br> -->
              @auth
              <button id="btn_niveles" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"> Niveles</button><br><br>
              <button id="btn_pausa" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"> Pausa</button><br><br>
              <button id="btn_config" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"> Configuraciones</button><br><br>
              @endauth
              <button id="btn_punt" class="btn btn-primary btn-xl js-scroll-trigger" href="#about"> Puntuaciones</button><br><br>
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
                        <audio autoplay loop id="audioNaruto">
                          <source src="music/naruto.mp3">
                        </audio>
                        <script> 
                          var music = document.getElementById("audioNaruto");
                          music.volume = 0.6;
                        </script>

                          <div id="NivelUno_Texto" style="display: none">
                            <h3>Palabra a recolectar: No<br>Hitokoto: いいえ (iie)<br></h3>
                            <h3>USUARIO : 
                              <label id="1" style="display: none">い</label>
                              <label id="2" style="display: none">い</label>
                              <label id="3" style="display: none">え</label>
                              JUGADOR 2 :
                              <label id="4" style="display: none">い</label>
                              <label id="5" style="display: none">い</label>
                              <label id="6" style="display: none">え</label>
                            </h3>
                          </div>

                          <div id="NivelDos_Texto" style="display: none">
                            <h3>Palabra a recolectar: Casa<br>Hitokoto: かぞく (ka zo ku)<br></h3>
                            <h3>USUARIO : 
                              <label id="7" style="display: none">か</label>
                              <label id="8" style="display: none">ぞ</label>
                              <label id="9" style="display: none">く</label>
                              JUGADOR 2 :
                              <label id="10" style="display: none">か</label>
                              <label id="11" style="display: none">ぞ</label>
                              <label id="12" style="display: none">く</label>
                              <h3 id="tiempo"></h3>
                            </h3>
                          </div>

                          <div id="NivelTres_Texto" style="display: none">
                            <h3>Palabra a recolectar: Amigo<br>Hitokoto: 友 達 (tomo-dachi)<br></h3>
                            <h3>USUARIO : 
                              <label id="13" style="display: none">友</label>
                              <label id="14" style="display: none">達</label>
                              <label id="15" style="display: none">🃏</label>
                              JUGADOR 2 :
                              <label id="16" style="display: none">友</label>
                              <label id="17" style="display: none">達</label>
                              <label id="18" style="display: none">🃏</label>
                              <h3 id="tiempo_2"></h3>
                            </h3>
                          </div>

                          <div id="JuegoTerminado1" style="display: none">
                            <img id="GameOver1" src="img/usuario.jpg" z-index="2">
                            
                              @auth
                              <input type="hidden" name="idUsuario" id="usuid" value= "{{ Auth::user()->id }}">
                              @endauth
                              <div name="pun" id="puntos"></div>
                              <button id="guardar">Guardar Puntuacion</button>

                            <form action="{{route('guardarImagen')}}" method="POST" id="formo">
                            {{ csrf_field() }}
                              <input type="hidden" id="puntuacionUsuario" name="puntuacionUsuario">
                              <input type="hidden" id="idscreen" name="idscreen">
                              <button id="face" onclick="tomarScreen();">Compartir en Facebook</button><br/>
                            </form>

                            <button id="salir">Salir</button><br/>
                          </div>

                          <div id="JuegoTerminado2" style="display: none">
                            <img id="GameOver2" src="img/gano2.jpg" z-index="3">
                            @auth
                            <input type="hidden" name="idUsuario" id="usuid2" value= "{{ Auth::user()->id }}">
                            @endauth
                            <div id="puntos2"></div>

                            <form action="{{route('guardarImagen_2')}}" method="POST" id="formo">
                            {{ csrf_field() }}
                              <input type="hidden" id="puntuacionUsuario_2" name="puntuacionUsuario_2">
                              <input type="hidden" id="idscreen_2" name="idscreen_2">
                              <button id="face2" onclick="tomarScreen_2();">Compartir en Facebook</button><br/>
                            </form>

                            <button id="guardar_2">Guardar Puntuacion</button>
                            <button id="salir2">Salir</button><br/>
                          </div>

                          <div id="LOSER" style="display: none">
                            <img id="GameOver2" src="img/perder.jpg" z-index="4">
                            <button id="salir3">Salir</button><br/>
                          </div>

                          <div id="Prueba" style="display: none">
                            <img id="pruebaImagen" src="img/usuario.jpg" z-index="5">
                            <div id="score_puntos"></div>
                            @auth
                            <input type="hidden" name="idUsuario" id="usuid3" value= "{{ Auth::user()->id }}">
                            @endauth
                            <!-- <button id="book" onclick="share();">Compartir en Facebook</button><br/>-->

                            <form action="{{route('guardarImagen_3')}}" method="POST" id="formo">
                            {{ csrf_field() }}
                              <input type="hidden" id="puntuacionUsuario_3" name="puntuacionUsuario_3">
                              <input type="hidden" id="idscreen_3" name="idscreen_3">
                              <button id="book" onclick="tomarScreen_3();">Compartir en Facebook</button><br/>
                            </form>

                            <button id="guardarNivelDos">Guardar Puntuacion</button>
                            <button id="salir4">Salir</button><br/>
                          </div>

                          <div id="Prueba_2" style="display: none">
                            <img id="pruebaImagen_2" src="img/gano2.jpg" z-index="5">
                            <div id="score_puntos_2"></div>
                            @auth
                            <input type="hidden" name="idUsuario" id="usuid3_2" value= "{{ Auth::user()->id }}">
                            @endauth
                            <!-- <button id="book_2" onclick="share();">Compartir en Facebook</button><br/> -->

                            <form action="{{route('guardarImagen_4')}}" method="POST" id="formo">
                            {{ csrf_field() }}
                              <input type="hidden" id="puntuacionUsuario_4" name="puntuacionUsuario_4">
                              <input type="hidden" id="idscreen_4" name="idscreen_4">
                              <button id="book_2" onclick="tomarScreen_4();">Compartir en Facebook</button><br/>
                            </form>

                            <button id="guardarNivelDos_2">Guardar Puntuacion</button>
                            <button id="salir4_2">Salir</button><br/>
                          </div>

                          <div id="TercerNivel" style="display: none">
                            <img id="tercerImagen" src="img/usuario.jpg" z-index="5">
                            <div id="score_tercer"></div>
                            @auth
                            <input type="hidden" name="idUsuario" id="usuid_tercer" value= "{{ Auth::user()->id }}">
                            @endauth
                            <!-- <button id="book_tercer" onclick="shareTercer();">Compartir en Facebook</button><br/> -->

                            <form action="{{route('guardarImagen_5')}}" method="POST" id="formo">
                            {{ csrf_field() }}
                              <input type="hidden" id="puntuacionUsuario_5" name="puntuacionUsuario_5">
                              <input type="hidden" id="idscreen_5" name="idscreen_5">
                              <button id="book_tercer" onclick="tomarScreen_5();">Compartir en Facebook</button><br/>
                            </form>

                            <button id="guardarNivelTres">Guardar Puntuacion</button>
                            <button id="salir5">Salir</button><br/>
                          </div>

                          <div id="TercerNivel_2" style="display: none">
                            <img id="tercerImagen_2" src="img/gano2.jpg" z-index="5">
                            <div id="score_tercer_2"></div>
                            @auth
                            <input type="hidden" name="idUsuario" id="usuid_tercer_2" value= "{{ Auth::user()->id }}">
                            @endauth
                            <!-- <button id="book_tercer_2" onclick="shareTercer();">Compartir en Facebook</button><br/>-->

                            <form action="{{route('guardarImagen_6')}}" method="POST" id="formo">
                            {{ csrf_field() }}
                              <input type="hidden" id="puntuacionUsuario_6" name="puntuacionUsuario_6">
                              <input type="hidden" id="idscreen_6" name="idscreen_6">
                              <button id="book_tercer_2" onclick="tomarScreen_6();">Compartir en Facebook</button><br/>
                            </form>

                            <button id="guardarNivelTres_2">Guardar Puntuacion</button>
                            <button id="salir5_2">Salir</button><br/>
                          </div>

                          @auth
                          <div id="NIVELES">
                            <br><br><br>
                            <h1>Escoge un nivel</h1><br><br>
                            <button id="btn_1" class="btn btn-primary btn-xl js-scroll-trigger" onclick="Niveluno(); render()">Nivel 1</button><br><br>
                            <button id="btn_2" class="btn btn-primary btn-xl js-scroll-trigger" onclick="Niveldos(); setTimer(); render_2()">Nivel 2</button><br><br>
                            <button id="btn_3" class="btn btn-primary btn-xl js-scroll-trigger" onclick="Niveltres(); setTimer_2(); render_3()">Nivel 3</button><br><br>
                            <img width="1000" height="500" src="img/instrucciones.jpg"><br><br><br>
                          </div>
                          @endauth
                          

                          @guest
                          <div id="Validacion">
                            <h3>Inicia sesion para jugar</h3> 
                          </div>
                          @endguest

                        <div class="row">
                          <div id="can" class= "col-md-12" style="display: none">
                            <!--<canvas id="micanvas" width="1550" height="800">
                                Tu navegador no soporta canvas.
                            </canvas>-->
                          </div>
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

                          <div id="configuracion" style="display: none">
                            <br><br><br>
                            <h1>CONFIGURACIONES</h1><br><br>
                            <h3>Escoje un color para el fondo</h3><br><br>
                            <button class="btn btn-primary btn-xl js-scroll-trigger" id="gris">Gris Claro</button>
                            <button class="btn btn-primary btn-xl js-scroll-trigger" id="celeste">Celeste</button>
                            <button class="btn btn-primary btn-xl js-scroll-trigger" id="aqua">Aqua</button>
                            <button class="btn btn-primary btn-xl js-scroll-trigger" id="blanco">White</button><br><br>
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