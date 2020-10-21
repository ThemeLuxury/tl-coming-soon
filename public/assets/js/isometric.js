if ( ! Detector.webgl ) Detector.addGetWebGLMessage();
			var container;
			var camera, scene, renderer;
			var plane, cube;
			var mouse, raycaster, isShiftDown = false;
			var rollOverMesh, rollOverMaterial;
			var cubeGeo, cubeMaterial;
			var objects = [];
			init();
			render();
			function init() {
				container = document.createElement( 'div' );
				document.body.appendChild( container );
				
				camera = new THREE.OrthographicCamera( window.innerWidth / - 2, window.innerWidth / 2, window.innerHeight / 36, window.innerHeight / - 2, - 2000, 1000 );

				camera.position.set( 200, 100, 200 );
				camera.lookAt( new THREE.Vector3() );
				scene = new THREE.Scene();
				// roll-over helpers
				rollOverGeo = new THREE.BoxGeometry( 16, 8, 16 );
				rollOverMaterial = new THREE.MeshBasicMaterial( { color: 0xff0000, opacity: 0.5, transparent: true } );
				rollOverMesh = new THREE.Mesh( rollOverGeo, rollOverMaterial );
				scene.add( rollOverMesh );
				// cubes
				cubeGeo = new THREE.BoxGeometry( 16, 8, 16 );
				cubeMaterial = new THREE.MeshLambertMaterial( {  map: new THREE.TextureLoader().load( "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUAQMAAAC3R49OAAAABlBMVEUAebgAld7kPtyIAAAAEklEQVQI12NgAIL6/w+ogoEAAKI4Kp2RNhrhAAAAAElFTkSuQmCC" ) } );
				// grid
				var size = 10000, step = 16;
				var geometry = new THREE.Geometry();
				for ( var i = - size; i <= size; i += step ) {
					geometry.vertices.push( new THREE.Vector3( - size, 0, i ) );
					geometry.vertices.push( new THREE.Vector3(   size, 0, i ) );
					geometry.vertices.push( new THREE.Vector3( i, 0, - size ) );
					geometry.vertices.push( new THREE.Vector3( i, 0,   size ) );
				}
				var material = new THREE.LineBasicMaterial( { color: 0x0f78b4, opacity: 0.2, transparent: true } );
				var line = new THREE.LineSegments( geometry, material );
				scene.add( line );
				//
				raycaster = new THREE.Raycaster();
				mouse = new THREE.Vector2();
				var geometry = new THREE.PlaneBufferGeometry( 10000, 10000 );
				geometry.rotateX( - Math.PI / 2 );
				plane = new THREE.Mesh( geometry, new THREE.MeshBasicMaterial( { visible: false } ) );
				scene.add( plane );
				objects.push( plane );
				// Lights
				var ambientLight = new THREE.AmbientLight( 0x2b495a );
				scene.add( ambientLight );
				var directionalLight = new THREE.DirectionalLight( 0xffffff );
				directionalLight.position.set( 1, 0.75, 0.5 ).normalize();
				scene.add( directionalLight );
				renderer = new THREE.WebGLRenderer( { antialias: true } );
				renderer.setClearColor( 0xf0f0f0 );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );
				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				document.addEventListener( 'mousedown', onDocumentMouseDown, false );
				document.addEventListener( 'keydown', onDocumentKeyDown, true );
				document.addEventListener( 'keyup', onDocumentKeyUp, true );
				//
				window.addEventListener( 'resize', onWindowResize, false );
			}
			function onWindowResize() {
				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();
				renderer.setSize( window.innerWidth, window.innerHeight );
			}
			function onDocumentMouseMove( event ) {
				event.preventDefault();
				mouse.set( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1 );
				raycaster.setFromCamera( mouse, camera );
				var intersects = raycaster.intersectObjects( objects );
				if ( intersects.length > 0 ) {
					var intersect = intersects[ 0 ];
					rollOverMesh.position.copy( intersect.point ).add( intersect.face.normal );
					rollOverMesh.position.divideScalar( 16 ).floor().multiplyScalar( 16 ).addScalar( 16 );
				}
				render();
			}
			function onDocumentMouseDown( event ) {
				event.preventDefault();
				mouse.set( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1 );
				raycaster.setFromCamera( mouse, camera );
				var intersects = raycaster.intersectObjects( objects );
				if ( intersects.length > 0 ) {
					var intersect = intersects[ 0 ];
					// delete cube
					if ( isShiftDown ) {
						if ( intersect.object != plane ) {
							scene.remove( intersect.object );
							objects.splice( objects.indexOf( intersect.object ), 1 );
						}
					// create cube
					} else {
						var voxel = new THREE.Mesh( cubeGeo, cubeMaterial );
						voxel.position.copy( intersect.point ).add( intersect.face.normal );
						voxel.position.divideScalar( 16 ).floor().multiplyScalar( 16 ).addScalar( 16 );
						scene.add( voxel );
						objects.push( voxel );
					}
					render();
				}
			}
			function onDocumentKeyDown( event ) {
				switch( event.keyCode ) {
					case 32: isShiftDown = true; break;
				}
			}
			function onDocumentKeyUp( event ) {
				switch ( event.keyCode ) {
					case 32: isShiftDown = false; break;
				}
			}
			function render() {
				renderer.render( scene, camera );
			}