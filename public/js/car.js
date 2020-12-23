$(".addCar1").click(function(){
    var idProducto = $(this).attr("idProducto");
    var idUsuario = $(this).attr("idUsuario");
    var idCarro = $(this).attr("idCarro");
    console.log("idCarro",idCarro);
    console.log("idUsuario",idUsuario);
    console.log("idProducto",idProducto);
    //priceProductos(precio);
})

$(".addCart2").click(function(){
    var idProducto = $(this).attr("idProducto");
    var idUsuario = $(this).attr("idUsuario");
    var idCarro = $(this).attr("idCarro");
    console.log("idCarro",idCarro);
    console.log("idUsuario",idUsuario);
    console.log("idProducto",idProducto);
    //priceProductos(precio);

});


$(document).ready(function(){
    total = $("#sumatotal").html();
    totalini = Number(total);
    localStorage.setItem("sumatotalini", totalini); 
});


$("input").click(function() {
    var id = $(this).prop("id");

    if( $('#'+id).prop('checked')){
        //Show Plus Extension 5 Years
        $('.'+id).show();

        //Sum Plus Extension 5 Years to total
        valor1 = $('.'+id).html();
        valor1a = Number(valor1);

        total = $("#sumatotal").html();
        totala = Number(total);

        totalpagar = totala + valor1a;

        //**********Total a pagar con iva + plus*********** */

        $("#sumatotal").html(totalpagar);


        totalpagarconiva = totalpagar + (localStorage.getItem("sumatotalini") * 21 / 100);
        $("#total").html(Math.round(totalpagarconiva));

    }

    if( $('#'+id).prop('checked') == false){
        //Hide Plus Extension 5 Years
        $('.'+id).hide();

        //subtract Plus Extension 5 Years to total
        valor1 = $('.'+id).html();
        valor1a = Number(valor1);
        
        total = $("#sumatotal").html();
        totala = Number(total);

        totalpagar = totala - valor1a;

        //************Total a pagar con iva - plus*********** */

        $("#sumatotal").html(totalpagar);

        totalpagarconiva = totalpagar + (localStorage.getItem("sumatotalini") * 21 / 100);
        $("#total").html(Math.round(totalpagarconiva));

    }
    
});


