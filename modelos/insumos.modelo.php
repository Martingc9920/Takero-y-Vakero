<?php
require_once "conexion.php";
class ModelInsumos
{

	/*==================================
	Mostrar insumos
	================================*/
	static public function mdlMostrarInsumos($tabla, $item, $valor)
	{

		if ($item != null) {			
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item =:$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();

		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	/*==================================
	Mostrar Mediciones
	================================*/
	static public function mdlMostrarMediciones($tabla, $item, $valor)
	{

		if ($item != null) {			

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item =:$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();

		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

/*=============================================
	REGISTRO DE INSUMO
	=============================================*/
	static public function mdlIngresarInsumos($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla VALUES (null, :nombre_insumo, :cantidad, :id_medicion, :insumo_minimo)");

		$stmt->bindParam(":nombre_insumo", $datos["nombre_insumo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":id_medicion", $datos["id_medicion"], PDO::PARAM_STR);
		$stmt->bindParam(":insumo_minimo", $datos["insumo_minimo"], PDO::PARAM_STR);//dudas con las tablas 		

		if ($stmt->execute()) {

			return "ok";

		} else {

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}




/*=============================================
	EDITAR INSUMO
	=============================================*/
	static public function mdlEditarInsumos($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_insumo = :nombre_insumo, cantidad = :cantidad, id_medicion = :id_medicion, insumo_minimo = :insumo_minimo WHERE id_insumo = :id_insumo");

		$stmt->bindParam(":id_insumo", $datos["id_insumo"], PDO::PARAM_STR);//duda es relacion a la tablas inusmos ?
		$stmt->bindParam(":nombre_insumo", $datos["nombre_insumo"], PDO::PARAM_STR);//duda es relacion a la tablas inusmos ?
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":id_medicion", $datos["id_medicion"], PDO::PARAM_STR);
		$stmt->bindParam(":insumo_minimo", $datos["insumo_minimo"], PDO::PARAM_STR);
	
		
		if ($stmt->execute()) {
			/*echo("<script>console.log('PHP M id: " . $datos["id_insumo"] . "');</script>");
			echo("<script>console.log('PHP M name: " . $datos["nombre_insumo"] . "');</script>");
			echo("<script>console.log('PHP M cant: " . $datos["cantidad"] . "');</script>");
			echo("<script>console.log('PHP M med: " . $datos["id_medicion"] . "');</script>");
			echo("<script>console.log('PHP M min: " . $datos["insumo_minimo"] . "');</script>");*/
			return "ok";

		} else {

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}


/*=============================================
	ELIMINAR INSUMO
	=============================================*/

	static public function mdlEliminarInsumos($tabla, $datos)
	{
		echo "Aqui estamos con $datos";

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_insumo = :id_insumo");

		$stmt->bindParam(":id_insumo", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";

		} else {

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}


/*=============================================
	ACTUALIZAR INSUMO
	=============================================*/

	static public function mdlActualizarInsumo($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}