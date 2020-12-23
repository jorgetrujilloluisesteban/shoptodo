/*=============================================
SUBIENDO LA FOTO DE PORTADA
=============================================*/

var imagenPortada = null;

$(".fotoPortada").change(function(){

	imagenPortada = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenPortada["type"] != "image/jpeg" && imagenPortada["type"] != "image/png"){

  		$(".fotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagenPortada["size"] > 2000000){

  		$(".fotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenPortada);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarPrincipal").attr("src", rutaImagen);

  		})

  	}

})


/*===============================
DELETE PRODUCT
=================================*/

$(".deleteProduct").click(function(){
    var id = $( ".deleteProduct" ).val();

    var datos = new FormData();

    datos.append("id", id);

      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this product!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
     },
     function(isConfirm){
    
       if (isConfirm){

        $.ajax({

            url:"http://localhost/shoptodo/app/ajax/ajax.product-delete.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success:function(respuesta2){
                location.reload();
            }
        });

         /*swal("Shortlisted!", "Your product has been deleted!", "success");*/
    
        } else {
          /*swal("Cancelled", "Your product is safe!", "error");*/
        }
     });

});

/*===============================
INPUT SEARCH
=================================*/
$("#boton-search").click(function(){
    var search = $( "#input-search" ).val();

    var datos = new FormData();

    datos.append("search", search);

    url1="images/";

    $.ajax({

        url:"http://localhost/shoptodo/app/ajax/ajax.productos-search.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta2){

                console.log(respuesta2);

                var listaProductos = JSON.parse(respuesta2);

            if (listaProductos.length != 0){

                $("#productos").html('');

                $("#productos").append('<div class="col-lg-12 col-xs-12 list0" style="display: none;">');

                for(var i = 0; i < listaProductos.length; i++){
                    
                    $("#productos").append(
                        '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-left class-product list0" style="display: none;">'+
                                
                                '<div class="descripcion">'+
                                    '<a class="" href=images/"'+url1+listaProductos[i]["imagenurl"]+'">'+
                                    '<img class="img-responsive card" src="'+url1+listaProductos[i]["imagenurl"]+'" alt="Card image cap">'+
                                    '</a>'+
                                    '</div>'+
                                    '<div class="descripcion">'+
                                        '<h5 class="nombre">'+listaProductos[i]["nombre"]+'</h5>'+
                                        '<p class="desc">'+listaProductos[i]["descripcion"]+'</p>'+
                                        '<br>'+
                                        '<p class="desc2">'+listaProductos[i]["descripcion2"]+'</p>'+
                                    '</div>'+
                                '</div>'+
                             '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 descrip2 pull-right class-product list0" style="display: none;">'+
                                 '<h2 class="">£'+listaProductos[i]["precio"]+'</h2>'+
                                    '<a href="" class="consulta"><span class="iconify" data-icon="octicon-location" data-inline="false"></span>Check availability in your store</a><br>'+
                                    '<a href="" class="consulta"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Check all delivery and collection options</a>'+
                                    '<br><br><br>'+
                                 '<form action="" method="post" class="form-descripcion">'+
                                 '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                                 '<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm" />'+
                                 '</form>'+
                                '<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">'+
                                    '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                                    '<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm btn-block" />'+
                                '</form>'+
                             '</div>'+
                        '</div>');        
                }
                $("#productos").append('</div>');

                $("#productos").append('<div class="col-xs-12 grid0">');

                x=0;
                for(var i = 0; i < listaProductos.length; i++){

                    $("#productos").append('<div class="class-product grid0">'+
                    '<a href="?id='+listaProductos[i]["precio"]+'"  class="pixelProducto">'+
                    '<div class="card" style="width: 18rem;">'+
                    '<a class="" href=images/"'+url1+listaProductos[i]["imagenurl"]+'"><img class="card-img-top imagen" src="'+url1+listaProductos[i]["imagenurl"]+'" alt="Card image cap"></a>'+
                    '<div class="card-body">'+
                        '<h5 class="card-title">'+listaProductos[i]["nombre"]+'</h5>'+
                        '<p class="card-text">'+listaProductos[i]["descripcion"]+'</p>'+
                    '</div>'+
                    '<ul class="list-group list-group-flush">'+
                        '<li class="list-group-item">£'+listaProductos[i]["precio"]+'</li>'+
                    '</ul>'+
                    '<div class="card-body">'+
                        '<form action="" method="post">'+
                            '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                            '<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm btn-block" />'+
                        '</form>'+

                        '<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">'+
                            '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                            '<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm btn-block" />'+
                        '</form>'+

                    '</div>'+
                    '</div>'+
                    '</a>'+
                    '</div>');                   
                }
                $("#productos").append('</div>');   

            }
            else
            {
                location.reload();
            }
                          },
                              error: function(error){
                              alert(error);
                              console.log(error);
                          }

    });

})

/*===============================
BODY LIST0 AND GRID0
=================================*/

$("#btnList0").click(function(){   
    $("#productos .grid0").hide();
    $("#productos .list0").show();

    $(".class-product .grid0").hide();
    $(".class-product .list0").show();
})

$("#btnGrid0").click(function(){
    $("#productos .list0").hide();
    $("#productos .grid0").show();

    $(".class-product .list0").hide();
    $(".class-product .grid0").show();
})

/*===============================
FILTER CATEGORY
=================================*/

$("#flip").click(function(){
    $("#panel").slideToggle("slow");
})
$("#flip2").click(function(){
    $("#panel2").slideToggle("slow");
})
$("#flip3").click(function(){
    $("#panel3").slideToggle("slow");
})

/*==============================
DELETE FILTER
================================*/

$("#delete-filters").click(function(){
    location.reload();
});

/*===============================
FILTER CATEGORY FUNCTIONALITY
=================================*/

$("#customCheck4, #customCheck5, #customCheck6, #customCheck7, #customCheck8, #customCheck9, #customCheck10").change(function(){
    $("#customCheck4, #customCheck5, #customCheck6, #customCheck7, #customCheck8, #customCheck9, #customCheck10").removeAttr("disabled");
    $("#customCheck, #customCheck1, #customCheck2, #customCheck3").attr("disabled", true);

    if( $('#customCheck4').prop('checked') ) {
        var lenovo = $( "#customCheck4" ).val();
    }else{
        var lenovo = null;
    }

    if( $('#customCheck5').prop('checked') ) {
        var medio = $( "#customCheck5" ).val();
    }else{
        var medio = null;
    }

    if( $('#customCheck6').prop('checked') ) {
        var samsung = $( "#customCheck6" ).val();
    }else{
        var samsung = null;
    }

    if( $('#customCheck7').prop('checked') ) {
        var amazon = $( "#customCheck7" ).val();
    }else{
        var amazon = null;
    }

    if( $('#customCheck8').prop('checked') ) {
        var php = $( "#customCheck8" ).val();
    }else{
        var php = null;
    }

    if( $('#customCheck9').prop('checked') ) {
        var jquery = $( "#customCheck9" ).val();
    }else{
        var jquery = null;
    }

    if( $('#customCheck10').prop('checked') ) {
        var java = $( "#customCheck10" ).val();
    }else{
        var java = null;
    }

    var datos = new FormData();

    datos.append("lenovo", lenovo);
    datos.append("medio", medio);
    datos.append("samsung", samsung);
    datos.append("amazon", amazon);
    datos.append("php", php);
    datos.append("jquery", jquery)
    datos.append("java", java);

    url1="images/";

    $.ajax({

        url:"http://localhost/shoptodo/app/ajax/ajax.productos2.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta2){

                console.log(respuesta2);

                var listaProductos = JSON.parse(respuesta2);

            if (listaProductos.length != 0){

                $("#productos").html('');

                $("#productos").append('<div class="col-lg-12 col-xs-12 list0" style="display: none;">');

                for(var i = 0; i < listaProductos.length; i++){
                    
                    $("#productos").append(
                        '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-left class-product list0" style="display: none;">'+
								
								'<div class="descripcion">'+
                                    '<a class="" href=images/"'+url1+listaProductos[i]["imagenurl"]+'">'+
                                    '<img class="img-responsive card" src="'+url1+listaProductos[i]["imagenurl"]+'" alt="Card image cap">'+
                                    '</a>'+
                                    '</div>'+
                                    '<div class="descripcion">'+
                                        '<h5 class="nombre">'+listaProductos[i]["nombre"]+'</h5>'+
                                        '<p class="desc">'+listaProductos[i]["descripcion"]+'</p>'+
                                        '<br>'+
                                        '<p class="desc2">'+listaProductos[i]["descripcion2"]+'</p>'+
                                    '</div>'+
							    '</div>'+
							 '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 descrip2 pull-right class-product list0" style="display: none;">'+
								 '<h2 class="">£'+listaProductos[i]["precio"]+'</h2>'+
									'<a href="" class="consulta"><span class="iconify" data-icon="octicon-location" data-inline="false"></span>Check availability in your store</a><br>'+
									'<a href="" class="consulta"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Check all delivery and collection options</a>'+
									'<br><br><br>'+
								 '<form action="" method="post" class="form-descripcion">'+
								 '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
								 '<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm" />'+
								 '</form>'+
                                '<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">'+
                                    '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                                    '<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm btn-block" />'+
                                '</form>'+
                             '</div>'+
                        '</div>');        
                }
                $("#productos").append('</div>');

                $("#productos").append('<div class="col-xs-12 grid0">');

                x=0;
                for(var i = 0; i < listaProductos.length; i++){

                    $("#productos").append('<div class="class-product grid0">'+
                    '<a href="?id='+listaProductos[i]["precio"]+'"  class="pixelProducto">'+
                    '<div class="card" style="width: 18rem;">'+
                    '<a class="" href=images/"'+url1+listaProductos[i]["imagenurl"]+'"><img class="card-img-top imagen" src="'+url1+listaProductos[i]["imagenurl"]+'" alt="Card image cap"></a>'+
                    '<div class="card-body">'+
                        '<h5 class="card-title">'+listaProductos[i]["nombre"]+'</h5>'+
                        '<p class="card-text">'+listaProductos[i]["descripcion"]+'</p>'+
                    '</div>'+
                    '<ul class="list-group list-group-flush">'+
                        '<li class="list-group-item">£'+listaProductos[i]["precio"]+'</li>'+
                    '</ul>'+
                    '<div class="card-body">'+
                        '<form action="" method="post">'+
                            '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                            '<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm btn-block" />'+
                        '</form>'+

                        '<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">'+
                            '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                            '<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm btn-block" />'+
                        '</form>'+

                    '</div>'+
                    '</div>'+
                    '</a>'+
                    '</div>');                   
                }
                $("#productos").append('</div>');	

            }
            else
            {
                location.reload();
            }
                          },
                              error: function(error){
                              alert(error);
                              console.log(error);
                          }

    });

})

$("#customCheck, #customCheck1, #customCheck2, #customCheck3").change(function(){
    
    $("#customCheck4, #customCheck5, #customCheck6, #customCheck7, #customCheck8, #customCheck9, #customCheck10").attr("disabled", true);
    $("#customCheck, #customCheck1, #customCheck2, #customCheck3").removeAttr("disabled");
    
    if( $('#customCheck').prop('checked') ) {
        var lapton = $( "#customCheck" ).val();
    }else{
        var lapton = null;
    }

    if( $('#customCheck1').prop('checked') ) {
        var tablet = $( "#customCheck1" ).val();
    }else{
        var tablet=null;
    }

    if( $('#customCheck2').prop('checked') ) {
        var ebook = $( "#customCheck2" ).val();
    }else{
        var ebook = null;
    }

    if( $('#customCheck3').prop('checked') ) {
        var book = $( "#customCheck3" ).val();
    }else{
        var book = null;
    }

    var datos = new FormData();

    datos.append("lapton", lapton);
    datos.append("tablet", tablet);
    datos.append("ebook", ebook);
    datos.append("book", book);

    url1="images/";

    $.ajax({

        url:"http://localhost/shoptodo/app/ajax/ajax.productos.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

                console.log(respuesta);

                var listaProductos = JSON.parse(respuesta);

            if (listaProductos.length != 0){

                $("#productos").html('');

                $("#productos").append('<div class="col-lg-12 col-xs-12 list0" style="display: none;">');
 
                for(var i = 0; i < listaProductos.length; i++){
                    
                    $("#productos").append(
                        '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-left class-product list0" style="display: none;">'+
								
								'<div class="descripcion">'+
                                    '<a class="" href=images/"'+url1+listaProductos[i]["imagenurl"]+'">'+
                                    '<img class="img-responsive card" src="'+url1+listaProductos[i]["imagenurl"]+'" alt="Card image cap">'+
                                    '</a>'+
                                    '</div>'+
                                    '<div class="descripcion">'+
                                        '<h5 class="nombre">'+listaProductos[i]["nombre"]+'</h5>'+
                                        '<p class="desc">'+listaProductos[i]["descripcion"]+'</p>'+
                                        '<br>'+
                                        '<p class="desc2">'+listaProductos[i]["descripcion2"]+'</p>'+
                                    '</div>'+
							    '</div>'+
							 '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 descrip2 pull-right class-product list0" style="display: none;">'+
								 '<h2 class="">£'+listaProductos[i]["precio"]+'</h2>'+
									'<a href="" class="consulta"><span class="iconify" data-icon="octicon-location" data-inline="false"></span>Check availability in your store</a><br>'+
									'<a href="" class="consulta"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Check all delivery and collection options</a>'+
									'<br><br><br>'+
								 '<form action="" method="post" class="form-descripcion">'+
								 '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
								 '<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm" />'+
								 '</form>'+
                                '<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">'+
                                    '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                                    '<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm btn-block" />'+
                                '</form>'+
                             '</div>'+
                        '</div>');        
                }
                $("#productos").append('</div>');

                $("#productos").append('<div class="col-xs-12 grid0">');
                
                x=0;
                for(var i = 0; i < listaProductos.length; i++){

                    $("#productos").append('<div class="class-product grid2">'+
                    '<a href="?id='+listaProductos[i]["precio"]+'"'+
                    '<div style="float:left; display: inline-block">'+
                    '<div class="card">'+
                    '<a class="" href=images/"'+url1+listaProductos[i]["imagenurl"]+'"><img class="card-img-top imagen" src="'+url1+listaProductos[i]["imagenurl"]+'" alt="Card image cap"></a>'+
                    '<div class="card-body">'+
                        '<h5 class="card-title">'+listaProductos[i]["nombre"]+'</h5>'+
                        '<p class="card-text">'+listaProductos[i]["descripcion"]+'</p>'+
                    '</div>'+
                    '<ul class="list-group list-group-flush">'+
                        '<li class="list-group-item">£'+listaProductos[i]["precio"]+'</li>'+
                    '</ul>'+
                    '<div class="card-body">'+
                        '<form action="" method="post">'+
                            '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                            '<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm btn-block" />'+
                        '</form>'+
                        '<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">'+
                            '<input type="hidden" name="idproducto" value="'+listaProductos[i]["id"]+'"/>'+
                            '<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm btn-block" />'+
                        '</form>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</a>'+
                    '</div>');                   
                }
                $("#productos").append('</div>');	

            }
            else
            {
                location.reload();
            }
                          },
                              error: function(error){
                              alert(error);
                              console.log(error);
                          }

    });
})

