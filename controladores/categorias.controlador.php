<?php
class ControladorCategorias{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearCategoria(){

		if(isset($_POST["nuevaCategoria"])){
			
				$tabla = "categoria";
				$datos = array("nombre_categoria" => $_POST["nuevaCategoria"],
					           "descripcion" => $_POST["nuevaDescripcion"]);
                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);
				
				/* Notificaciones al usuario con jQuery Sweet Alert */
				if($respuesta == "ok"){
					echo'<script>
					swal({

						type: "success",
						title: "¡La categoría ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});

					</script>';

                }
		
		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categoria";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCategoria(){

		if(isset($_POST["editarCategoria"])){

			// if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "categoria";
				$datos = array("nombre_categoria"=>$_POST["editarCategoria"],
                               "id_categoria"=>$_POST["idCategoria"],
                               "descripcion"=>$_POST["editarDescripcion"]
							  );
				
				//var_dump($datos);
                $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);
                

				if($respuesta == "ok"){

					echo'<script>
					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "categorias";
									}
								})
					</script>';
				}
			else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "categorias";
							}
						})
			  	</script>';
			}
		}
	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$tabla ="categoria";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}
		
	}
}
