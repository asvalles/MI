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
  //    function cargaContextoCanvas(micanvas){
  //      var elemento = document.getElementById(micanvas);
  //      if(elemento && elemento.getContext){
  //          var contexto = elemento.getContext('2d');
  //          if(contexto){
  //            return contexto;
  //          }
  //      }
  //      return FALSE;
  //    }
//
//
  //    window.onload = function(){
  //      //Recibimos el elemento canvas
  //      var ctx = cargaContextoCanvas('can');
  //      if(ctx){
  //          //Creo una imagen conun objeto Image de Javascript
  //          var img = new Image();
  //          //indico la URL de la imagen
  //          img.src = 'img/palabra1.png';
  //          //defino el evento onload del objeto imagen
  //          img.onload = function(){
  //            //incluyo la imagen en el canvas
  //            ctx.drawImage(img, 10, 10);
  //          }
  //      }
  //    }
  </script>

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

        var sliderPos = window.innerWidth / 2;
                
        // TODO: Modelo con animacion.
        var mixers = [];
        var mixers_2 = [];
        var objsWithAnimation = [];
        var robotControl;
        // TODO: End Modelo Animacion.

        var isWorldReady = [ false, false, false, false, false, false, false, false, false, false,
                              false, false, false, false, false, false, false ];

        $(document).ready(function() {
          persona_2 = new THREE.Object3D();
          clock=new THREE.Clock();

          setupScene();

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

          loadOBJWithMTL("assets/", "Terreno2.obj", "Terreno2.mtl", (objetoCargado) => {
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
            objetosConColision.push(farol);
            objetosConColision_2.push(farol);
            scene.add(farol);
            isWorldReady[7] = true;
          });

          
            loadOBJWithMTL("assets/", "Ficha2.obj", "Ficha2.mtl", (ficha) => {
              if(estaEnNivelUno == true){
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
              }
            });

            loadOBJWithMTL("assets/", "I.obj", "I.mtl", (ficha3) => {
              if(estaEnNivelUno == true){
                ficha3.position.z = -20;
                ficha3.position.x = 80;
                ficha3.position.y = -1;
                ficha3.rotation.y = THREE.Math.degToRad(-90);
                ficha3.scale.set(0.5, 0.5, 0.5);
                colisionficha3.push(ficha3);
                scene.add(ficha3);
                
                var ficha2 = ficha3.clone();
                ficha2.position.z = 60;
                ficha2.position.x = -50;
                ficha2.position.y = -1;
                ficha2.rotation.y = THREE.Math.degToRad(90);
                ficha2.scale.set(0.5, 0.5, 0.5);
                colisionficha2.push(ficha2);
                scene.add(ficha2);

                var ficha4 = ficha3.clone();
                //ficha4.rotation.y = THREE.Math.degToRad(90);
                ficha4.position.z = -30;
                ficha4.position.x = -80;
                ficha4.position.y = -1;
                ficha4.scale.set(0.5, 0.5, 0.5);
                colisionficha4.push(ficha4);
                scene.add(ficha4);

                var ficha5 = ficha3.clone();
                ficha5.position.z = -90;
                ficha5.position.x = 40;
                ficha5.position.y = -1;
                ficha5.rotation.y = THREE.Math.degToRad(-45);
                ficha5.scale.set(0.5, 0.5, 0.5);
                colisionficha5.push(ficha5);
                scene.add(ficha5);
              }
            });

          


          loadOBJWithMTL("assets/", "Mascara1.obj", "Mascara1.mtl", (mask1) => {
            mask1.position.z = -1;
            mask1.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(mask1);
            objetosConColision_2.push(mask1);
            scene.add(mask1);
            isWorldReady[9] = true;
          });

          loadOBJWithMTL("assets/", "Mascara2.obj", "Mascara2.mtl", (mask2) => {
            mask2.position.z = -1;
            mask2.scale.set(0.5, 0.5, 0.5);
            objetosConColision.push(mask2);
            objetosConColision_2.push(mask2);
            scene.add(mask2);
            isWorldReady[10] = true;
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

          //var spriteMap = new THREE.TextureLoader().load( "palabra1.png" );
          //var spriteMaterial = new THREE.SpriteMaterial( { map: spriteMap, color: 0xffffff } );
          //var sprite = new THREE.Sprite( spriteMaterial );
          //sprite.position.set(camera.position.x, camera.position.y, camera.position.z-2);
          //sprite.scale.set(128, 128,1);
          //scene.add( sprite );

          render();

          document.addEventListener('keydown', onKeyDown);
          document.addEventListener('keyup', onKeyUp);	
        
          //$("#ptsUsuario").val(puntos_per1.html());
          
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
          deltaTime = clock.getDelta();	

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
          if (keys["J"]) {
            yaw_2 = 2;
          } else if (keys["L"]) {
            yaw_2 = -2;
          }
          if (keys["I"]) {
            forward_2 = -20;
          } else if (keys["K"]) {
            forward_2 = 20;
          }

          estaEnNivelUno = true;

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
                  console.log("Estoy colisionando");
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
                  console.log("Estoy colisionando");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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
                  console.log("Estoy colisionando con la ficha huehuehue");
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

                  puntos_per2 = puntos_per2 + cantidadfichas_2;
                  cantidadfichas_2 = cantidadfichas_2 + 1;

                  scene.remove(colision3[0].object.parent);
                  colisionficha3.pop(colision3[0].object.parent);

                  //debugger;
                }
              }

              if( colision4.length > 0 ){
                if(colision4[0].distance < 3){
                  console.log("Estoy colisionando con la ficha huehuehue");
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

                  puntos_per2 = puntos_per2 + cantidadfichas_2;
                  cantidadfichas_2 = cantidadfichas_2 + 1;

                  scene.remove(colision4[0].object.parent);
                  colisionficha4.pop(colision4[0].object.parent);

                  //debugger;
                }
              }

              if( colision5.length > 0 ){
                if(colision5[0].distance < 3){
                  console.log("Estoy colisionando con la ficha huehuehue");
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

                  puntos_per2 = puntos_per2 + cantidadfichas_2;
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
            //debugger;

            //$('#salir').onclick(function(){
            //  $(location).attr('href', '/');
            //});
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

            $('body').on('click', '#salir2', function(){
              $(location).attr('href', '/');
            });
          }

          renderer.render(scene, camera);
          renderer_2.render(scene, camera_2);

          
          //$('#puntos').html(puntos_per1);
         
        }


        function setupScene() {		
          //var visibleSize = { width: window.innerWidth, height: window.innerHeight};
          var visibleSize = { width: 1500, height: 800};
          clock = new THREE.Clock();		
          scene = new THREE.Scene();
          persona = new THREE.Object3D();
          
          camera = new THREE.PerspectiveCamera(75, visibleSize.width / (visibleSize.height/2), 0.1, 1000);
          camera.position.z = 2;
          camera.position.y = 10;

          camera_2 = new THREE.PerspectiveCamera(75, visibleSize.width / (visibleSize.height/2), 0.1, 1000);
          camera_2.position.z = 2;
          camera_2.position.y = 10;
          

          renderer = new THREE.WebGLRenderer( {precision: "mediump" } );
          renderer.setClearColor(new THREE.Color(0, 0, 0));
          //renderer.setPixelRatio(visibleSize.width / visibleSize.height/2);
          renderer.setPixelRatio(window.devicePixelRatio);
          renderer.setSize(visibleSize.width, visibleSize.height/2);

          renderer_2 = new THREE.WebGLRenderer( {precision: "mediump" } );
          renderer_2.setClearColor(new THREE.Color(0, 0, 0));
          //renderer_2.setPixelRatio(visibleSize.width / visibleSize.height/2);
          renderer_2.setPixelRatio(window.devicePixelRatio);
          renderer_2.setSize(visibleSize.width, visibleSize.height/2);

          var ambientLight = new THREE.AmbientLight(new THREE.Color(1, 1, 1), 1.0);
          scene.add(ambientLight);

          var directionalLight = new THREE.DirectionalLight(new THREE.Color(1, 1, 0), 0.4);
          directionalLight.position.set(0, 0, 1);
          scene.add(directionalLight);

          var grid = new THREE.GridHelper(50, 10, 0xffffff, 0xffffff);
          grid.position.y = -1;
          scene.add(grid);
          
          var a = document.getElementById("can");
          a.appendChild( renderer.domElement );
          a.appendChild( renderer_2.domElement );

          //$('#can').append(renderer.domElement);
        }

        function shareFB() {
		      shareScore(puntos_per1);
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
            top: 64%;
        }
        #salir{
            z-index: 800;
            position: absolute;
            left: 41.5%;
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
            top: 64%;
        }
        #salir2{   
            z-index: 800;
            position: absolute;
            left: 41.5%;
            top: 68%;
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

                          <div id="NivelUno_Texto">
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

                          <div id="JuegoTerminado1" style="display: none">
                            <img id="GameOver1" src="img/usuario.jpg" z-index="2">
                            @auth
                            <input type="hidden" name="idUsuario" value= "{{ Auth::user()->id }}">
                            @endauth
                            <!-- <input type="text" id="puntos" name="ptsUsuario" disabled></input>
                            <input type="text" value="" id="ptsUsuario"> 
                            <button id="salir" class="btn btn-outline-dark">Compartir en facebook</button> --> 
                            <div id="puntos"></div>
                            <button onclick="shareFB();">Compartir en Facebook</button><br/>
                            <button id="salir">Salir</button><br/>
                          </div>

                          <div id="JuegoTerminado2" style="display: none">
                            <img id="GameOver2" src="img/gano2.jpg" z-index="3">
                            @auth
                            <input type="hidden" name="idUsuario" value= "{{ Auth::user()->id }}">
                            @endauth
                            <div id="puntos2"></div>
                            <button id="salir2" class="btn btn-outline-dark">Compartir en facebook</button>
                          </div>

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