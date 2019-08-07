<?php

class ControladorProductos
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor)
	{

		$tabla = "producto_categoria";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto()
	{
		if (isset($_POST["nuevaCategoria"])) {

			$tabla = "producto";
			$datos = array(
				"id_categoria" => (int)$_POST["nuevaCategoria"],
				"nombre_producto" => $_POST["nuevoNombre"],
				"descripcion" => $_POST["nuevaDescripcion"],
				"almacen" => $_POST["nuevoStock"],
				"precio" => (float)$_POST["nuevoPrecio"],
			);
			 var_dump( $_POST["nuevaCategoria"]);
			// print_r($datos);
			// var_dump($datos);

			$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

			}
		}
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto()
	{

		if (isset($_POST["idProducto"])) {
			
			$tabla = "producto";

			$datos = array(
				"id_producto"=> (int)$_POST["idProducto"],				
				"nombre_producto" => $_POST["editarNombre"],
				"descripcion" => $_POST["editarDescripcion"],
				"almacen" => (int)$_POST["editarStock"],
				"precio" => (float)$_POST["editarPrecio"],
			);
			//var_dump($_POST["idProducto"]);

			echo var_dump($datos);
			var_dump($datos);

		    $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);
			
			

			if ($respuesta == "ok") {

				echo '<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

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
							// window.location = "productos";
							}
						})
			  	</script>';
			}
		}
		// }else{
		// 	echo'<script>
		// 		swal({
		// 			  type: "error",
		// 			  title: "¡Ni siquiera Posteo!",
		// 			  showConfirmButton: true,
		// 			  confirmButtonText: "Cerrar"
		// 			  }).then(function(result){
		// 				if (result.value) {
						
		// 				}
		// 			})
		// 	  </script>';
		// }

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto()
	{

		if (isset($_GET["idProducto"])) {

			$tabla = "producto";
			$datos = $_GET["idProducto"];						

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas()
	{

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}


}