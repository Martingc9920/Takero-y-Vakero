<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla VALUES (null, :nombre_producto, :precio, :descripcion, :id_categoria, 1, :almacen)");
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);		
		if(empty($datos["almacen"])){			
			$stmt->bindParam(":almacen", $datos["almacen"], PDO::PARAM_NULL);
		}else{
			$stmt->bindParam(":almacen", $datos["almacen"], PDO::PARAM_STR);
		}			
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		nombre_producto = :nombre_producto, 
		precio = :precio, 
		descripcion = :descripcion, 
		almacen = :almacen 
		WHERE id_producto = :id_producto");				
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);		
		if(empty($datos["almacen"])){			
			$stmt->bindParam(":almacen", $datos["almacen"], PDO::PARAM_NULL);
		}else{
			$stmt->bindParam(":almacen", $datos["almacen"], PDO::PARAM_STR);
		}					
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);				
		
		
		if($stmt->execute()){

			return "ok";

		}else{				
			//echo Console::log('Stmt', $stmt);
			return "error";					
		}		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");
		$stmt -> bindParam(":id_producto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";		
		}else{

			return "error";	

		}
		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

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

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}


}