/*=============================================
GUARDAR EL PRODUCTO
=============================================*/


$(".guardarProducto").click(function(){

	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	/*console.log("tituloProducto", $(".tituloProducto").val());
	console.log("seleccionarCategoria", $(".seleccionarCategoria").val());
	console.log("seleccionarCategoriatexto", $(".seleccionarCategoriatexto").val());
	console.log("descripcionProducto", $(".descripcionProducto").val());
	console.log("descripcionProducto2", $(".descripcionProducto2").val());
	console.log("tituloProductoBranch", $(".tituloProductoBranch").val());
	console.log("precio", $(".precio").val());*/

	if($(".tituloProducto").val() != "" && 
	   $(".seleccionarCategoria").val() != "" &&
	   $(".seleccionarCategoriatexto").val() != "" &&
	   $(".descripcionProducto").val() != "" &&
	   $(".descripcionProducto2").val() != "" &&
	   $(".tituloProductoBranch").val() != "" &&
	   $(".precio").val() != ""){

		/*=============================================
		ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
		=============================================*/

		var nombre = $(".tituloProducto").val();
		var seleccionarCategoria = $(".seleccionarCategoria").val();
		var seleccionarCategoriatexto = $(".seleccionarCategoriatexto").val();
		var descripcionProducto = $(".descripcionProducto").val();
		var descripcionProducto2 = $(".descripcionProducto2").val();
		var tituloProductoBranch = $(".tituloProductoBranch").val();
		var precio = $(".precio").val();
		
        var datosProducto = new FormData();
        datosProducto.append("tituloProducto", nombre);
		datosProducto.append("seleccionarCategoria", seleccionarCategoria);
		datosProducto.append("seleccionarCategoriatexto", seleccionarCategoriatexto);
		datosProducto.append("descripcionProducto", descripcionProducto);
		datosProducto.append("descripcionProducto2", descripcionProducto2);
		datosProducto.append("tituloProductoBranch", tituloProductoBranch);
        datosProducto.append("precio", precio);

					$.ajax({
						url:"http://localhost/shoptodo/app/ajax/productos.ajax.php",
						method: "POST",
						data: datosProducto,
						cache: false,
						contentType: false,
						processData: false,
						success: function(respuesta){
							
					        // console.log("respuesta", respuesta);

                            if(respuesta == "ok"){

                                swal({
                                type: "success",
                                title: "The product has been stored correctly",
                                showConfirmButton: true,
                                confirmButtonText: "!Close"
                                });

                                return;
                            }

						}

					})


	}else{

		swal({
			title: "Fill in all the required fields",
			type: "error",
			confirmButtonText: "Close",
			closeOnConfirm: false
		},

		function(isConfirm){
				if (isConfirm) {	   
					history.back();
				} 
		});
	}

})


