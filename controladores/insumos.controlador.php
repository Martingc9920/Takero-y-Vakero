<?php
class ControladorInsumos{

	/*==================================
	Mostrar insumos
	================================*/

static public function ctrMostrarInsumos($item, $valor){

	$tabla ="insumo_medicion";

	$respuesta =ModelInsumos::mdlMostrarInsumos($tabla,$item,$valor);

	return $respuesta;
}


	/*==================================
	Mostrar Mediciones
	================================*/

static public function ctrMostrarMediciones($item, $valor){

	$tabla ="medicion";
	$respuesta =ModelInsumos::mdlMostrarMediciones($tabla,$item,$valor);
	return $respuesta;
}


/*=============================================
	CREAR Insumo
	=============================================*/

	
	static public function ctrCrearInsumos()
	{
		if (isset($_POST["nuevoNombre"])) {

			$tabla = "insumo";
			$datos = array(				
				"nombre_insumo" => $_POST["nuevoNombre"],
				"cantidad" => (float)$_POST["nuevaCantidad"],
				"id_medicion" => $_POST["nuevaMedicion"],
				"insumo_minimo" =>(float) $_POST["nuevoMinimo"]
			);

			var_dump($datos);	
			

			$respuesta = ModelInsumos::mdlIngresarInsumos($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

						swal({
							  type: "success",
							  title: "El insumo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "insumos";

										}
									})

						</script>';
			}
			else{
				echo'<script>	
					swal({
						  type: "error",
						  title: "¡El producto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							// window.location = "insumos";
							}
						})
			  	</script>';
			}
		}
	}

/*=============================================
	EDITAR INSUMO
	=============================================*/


	static public function ctrEditarInsumos()
	{

		if (isset($_POST["editarInsumo"])) {
			
		
		
			$tabla = "insumo";
			$datos = array(				
				"id_insumo" => $_POST["editarInsumo"],
				"nombre_insumo" => $_POST["editarNombre"],
				"cantidad" => (float)$_POST["editarCantidad"],
				"id_medicion" => $_POST["editarMedicion"],
				"insumo_minimo" =>(float) $_POST["editarMinimo"]
			);
			//var_dump($_POST["idInsumo"]);

			//echo var_dump($datos);
			
			//echo("<script>console.log('PHP Controlador: " . $datos["editarInsumo"] . "');</script>");

		    $respuesta = ModelInsumos::mdlEditarInsumos($tabla, $datos);
			
			

			if ($respuesta == "ok") {

				

				echo '<script>
						
						
						swal({
							  type: "success",
							  title: "El insumo ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "insumos";

										}
									})
						
					</script>';
			}
			else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El insumo no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							// window.location = "insumos";
							}
						})
			  	</script>';
			}
		}	
	}





	/*=============================================
	BORRAR INSUMO
	=============================================*/

	static public function ctrEliminarInsumos()
	{

		if (isset($_GET["idInsumo"])) {

			$tabla = "insumo";
			$datos = $_GET["idInsumo"];						

			$respuestaEliminar = ModelInsumos::mdlEliminarInsumos($tabla, $datos);

			echo "Eliminar tabla: $tabla";
			echo "Eliminar insumo: $datos";
			if ($respuestaEliminar == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "insumos";

								}
							})

				</script>';

			}else{
				echo "No se elimino";
			}
		}
	}
}

	
