/*=============================================
EDITAR INSUMOS
=============================================*/
$(".tablaInsumos").on("click", "button.btnEditarInsumo", function () {

	var idInsumo = $(this).attr("idInsumo");

	var datos = new FormData();
	datos.append("idInsumo", idInsumo);

	//console.log(datos.get("idInsumo"));
		
      
	$.ajax({
		url: "ajax/insumos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

			//console.log("respuesta: ",respuesta);
			//console.log("Aqui entra");

			$("#editarInsumo").val(respuesta["id_insumo"]);
			$("#editarNombre").val(respuesta["nombre_insumo"]);
			$("#editarCantidad").val(respuesta["cantidad"]);
			$("#editarMedicion").val(respuesta["id_medicion"]);
			$("#editarMedicion").html(respuesta["nombre_medicion"]);
			$("#editarMinimo").val(respuesta["insumo_minimo"])


		}
	})
})








/*=============================================
ELIMINAR INSUMO
=============================================*/
$(".tablaInsumos").on("click", "button.btnEliminarInsumo", function () {

	var idInsumo = $(this).attr("idInsumo");

	var prueba = "Eliminar: ";
	//document.write(prueba);	
	//document.write(idInsumo);

	console.log("eliminar", idInsumo);
	swal({

		title: '¿Está seguro de borrar el insumo?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar insumo!'
	}).then(function (result) {
		if (result.value) {
			//console.log("eliminar", idInsumo);
			window.location = "index.php?ruta=insumos&idInsumo=" + idInsumo;
			

		}


	})

})