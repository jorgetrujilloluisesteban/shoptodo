<?php
 $cantidad = 1;
?>
<h3>Detail </h3>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="col-xs-12" id="productos">

    <a href="?c=Home&a=index" class = "btn btn-info">Main page</a>&nbsp;&nbsp;

        <div class="col-lg-12 col-xs-12 list0">

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-left">
            <?php foreach($model as $m):?>
                <!--izquierda-->
                <div class="descripcion">
                    <a class="" href="images/<?php echo $m["imagenurl"]; ?>">
                        <img class="img-responsive card" src="images/<?php echo $m["imagenurl"]; ?>">
                    </a>
                    </div>
                    <div class="descripcion">
                        <h5 class="nombre"><?php echo $m["nombre"]; ?></h5>
                        <p class="desc"><?php echo $m["descripcion"]; ?></p>
                        <br>
                        <p class="desc2"><?php echo $m["descripcion2"]; ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 descrip2 pull-right">
                    <!--derecha-->
                    <h2 class="">£<?php echo $m["precio"]; ?></h2>

                        <a href="" class="consulta"><span class="iconify" data-icon="octicon-location" data-inline="false"></span>
                        Check availability in your store</a><br>
                        <a href="" class="consulta"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Check all delivery and collection options</a>
                        <br>
                        <br>
                        <form lang="en" action="?c=home&a=index" method="post">
                            <input type="hidden" name="idproducto" value="<?php echo $m["id"]; ?>"/>
                            <input type="hidden" name="idcliente" value="<?php echo $_SESSION["id_cliente"]; ?>"/>
                            <input type="hidden" name="idcarro" value="<?php echo $_SESSION["carrito_id"]; ?>"/>
                            <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>"/>
                            <input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-lg addCar1" />
                        </form>
                </div>
                <?php endforeach;?>
            </div>

        </div>
    </div>
</div>