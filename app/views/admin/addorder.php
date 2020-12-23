<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-left">
<h3>Administrator </h3>
<a href="?c=Home&a=index" class = "btn btn-info">Main page</a>
<br><br>
    <table class="table">
        <tbody>
        <tr>
            <td>
                <a href="?c=Admin&a=product">
                    <button type="button" class="btn btn-warning btn-lg">Products</button>
                </a>
            </td>
        </tr>
        <tr>
        	<td>
                <a href="?c=Admin&a=order">
                    <button type="button" class="btn btn-warning btn-lg">Orders</button>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 pull-right" style="float: right;">
<h2>Add Order</h2>

       <!--<form role="form" method="post" enctype="multipart/form-data">-->
       <form action="?c=Admin&a=addorder" method="post">
         
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Add Order</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EL NOMBRE
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">

                  <!--<input type="text" class="form-control input-lg validarProducto tituloProducto"  placeholder="Enter product title">-->
                  <input type="text" class="form-control input-lg" name="_name" value="" required="required" placeholder="Enter name"/>
                </div>

            </div>

            <!--=====================================
            ENTRADA EMAIL
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">

                  <!--<input type="text" class="form-control input-lg validarProducto tituloProductoBranch"  placeholder="Enter branch product">-->
                  <input type="email" class="form-control input-lg" name="_email" value="" required="required" placeholder="Enter you email"/>
                </div>

            </div>


           <!--=====================================
            AGREGAR DIRECCION
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">

                <!--<input type="text" class="form-control input-lg validarProducto seleccionarCategoriatexto"  placeholder="Enter Category">-->
                <input type="text" class="form-control input-lg" name="_address" value="" required="required" placeholder="Enter Address"/>
              </div>

          </div>

           <!--=====================================
            AGREGAR ORDER CONTENT
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">

                <!--<textarea type="text" maxlength="320" rows="3" class="form-control input-lg descripcionProducto" placeholder="Ingresar descripción producto"></textarea>-->
                <input type="text" class="form-control input-lg" name="_ordercontent" value="" required="required" placeholder="Enter order content"/>

              </div>

            </div>

            <?php $fecha = date("Y-m-d H:i:s");?>

            <input name="_fecharegistro" type="hidden" value="<?php echo $fecha;?>">
           <!--=====================================
            AGREGAR ESTADO
            ======================================-->

            <div class="form-group">
                
                <div class="input-group">

                  <!--<select class="form-control input-lg seleccionarCategoria">-->
                  <select class="form-control input-lg" name="_estado" required="required">
                  
                    <option value="">Select option</option>
                    <option value="0">Pending</option>
                    <option value="1">Sent</option>

                    <?php

                    ?>

                  </select>

                </div>

            </div>
          
          </div>

        </div>

        <div class="modal-footer">

          <input type="submit" class="btn btn-success" id="_submit" name="_submit" value="Save Order" />

        </div>

       </form>
</div>