/*===============================
TOAST REGISTER
===============================*/
$("#toastRegister").click(function(){
    $(".toast").show();
    $('.toast').toast('show');
})

$("#toastRegisterclose").click(function(){
    $(".toast").hide();
})

/*===============================
FILTER CATEGORY FUNCTIONALITY
=================================*/
$("#ca-laptop").click(function(){
    lapton2="laptop";
    book2=null;
    tablet2=null;
    ebook2=null;

    caProductos(lapton2, book2, tablet2, ebook2);
})

$("#ca-book").click(function(){
    lapton2=null;
    book2="book";
    tablet2=null;
    ebook2=null;

    caProductos(lapton2, book2, tablet2, ebook2);
})

$("#ca-tablet").click(function(){
    lapton2=null;
    book2=null;
    tablet2="tablet";
    ebook2=null;

    caProductos(lapton2, book2, tablet2, ebook2);
})

$("#ca-ebook").click(function(){
    lapton2=null;
    book2=null;
    tablet2=null;
    ebook2="ebook";

    caProductos(lapton2, book2, tablet2, ebook2);
})

function caProductos(laptop2, book2, tablet2, ebook2) {

    var datos = new FormData();

    datos.append("laptop", laptop2);
    datos.append("book", book2);
    datos.append("tablet", tablet2);
    datos.append("ebook", ebook2);

    //console.log("variable", laptop2);

    url1="images/";

    $.ajax({

        url:"http://localhost/shoptodo/app/ajax/ajax.productos3.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta3){

                console.log(respuesta3);

                var listaProductos = JSON.parse(respuesta3);

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

}

/*=================================
GET PRICE
==================================*/

$("#customCheck11").change(function(){

    $("#customCheck4, #customCheck5, #customCheck6, #customCheck7, #customCheck8, #customCheck9, #customCheck10").attr("disabled", false);
    $("#customCheck, #customCheck1, #customCheck2, #customCheck3").attr("disabled", false);

    $("#customCheck4, #customCheck5, #customCheck6, #customCheck7, #customCheck8, #customCheck9, #customCheck10").prop('checked', false);
    $("#customCheck, #customCheck1, #customCheck2, #customCheck3").prop('checked', false);

    var slider2 = document.getElementById("customCheck11");
    var output = document.getElementById("demo2");
    var precio = slider2.value;
    output.innerHTML = this.value;

    slider2.oninput = function() {
        output.innerHTML = this.value;
        precio = this.value;
    }

    priceProductos(precio);
    
})

function priceProductos(price2) {

    var datos = new FormData();

    datos.append("price", price2);

    url1="images/";

    $.ajax({

        url:"http://localhost/shoptodo/app/ajax/ajax.productos4.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta4){

                var listaProductos = JSON.parse(respuesta4);

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

}