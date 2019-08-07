<?php

require_once "../controladores/insumos.controlador.php";
require_once "../modelos/insumos.modelo.php";

class AjaxInsumos{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idInsumo;

	public function ajaxEditarInsumo(){

		$item = "id_insumo";
		$valor = $this->idInsumo;

		$respuesta = ControladorInsumos::ctrMostrarInsumos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idInsumo"])){
	
	$insumo = new AjaxInsumos();
	$insumo -> idInsumo = $_POST["idInsumo"];
	$insumo -> ajaxEditarInsumo();
}
