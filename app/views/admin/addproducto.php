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
<h2>Add Products</h2>

       <!--<form role="form" method="post" enctype="multipart/form-data">-->
       <form action="?c=Admin&a=addproducto" method="post" enctype="multipart/form-data">
         
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Add product</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EL TÍTULO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">

                  <!--<input type="text" class="form-control input-lg validarProducto tituloProducto"  placeholder="Enter product title">-->
                  <input type="text" class="form-control input-lg" name="_tituloProducto" value="" required="required" placeholder="Enter product title"/>
                </div>

            </div>

            <!--=====================================
            ENTRADA PARA BRANCH
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">

                  <!--<input type="text" class="form-control input-lg validarProducto tituloProductoBranch"  placeholder="Enter branch product">-->
                  <input type="text" class="form-control input-lg" name="_tituloProductoBranch" value="" required="required" placeholder="Enter branch product"/>
                </div>

            </div>

           <!--=====================================
            AGREGAR CATEGORÍA NUMERICA
            ======================================-->

            <div class="form-group">
                
                <div class="input-group">

                  <!--<select class="form-control input-lg seleccionarCategoria">-->
                  <select class="form-control input-lg" name="_seleccionarCategoria" required="required">
                  
                    <option value="">Selecionar categoría</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>

                    <?php

                    ?>

                  </select>

                </div>

            </div>

           <!--=====================================
            AGREGAR CATEGORÍA TEXTO
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">

                <!--<input type="text" class="form-control input-lg validarProducto seleccionarCategoriatexto"  placeholder="Enter Category">-->
                <input type="text" class="form-control input-lg" name="_seleccionarCategoriatexto" value="" required="required" placeholder="Enter Category"/>
              </div>

          </div>

           <!--=====================================
            AGREGAR DESCRIPCIÓN
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">

                <!--<textarea type="text" maxlength="320" rows="3" class="form-control input-lg descripcionProducto" placeholder="Ingresar descripción producto"></textarea>-->
                <textarea type="text" maxlength="320" rows="3" class="form-control input-lg" name="_descripcionProducto" required="required" placeholder="Ingresar descripción producto"></textarea>

              </div>

            </div>

           <!--=====================================
            AGREGAR DESCRIPCIÓN2
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">

                <!--<textarea type="text" maxlength="320" rows="3" class="form-control input-lg descripcionProducto2" placeholder="Ingresar descripción producto 2"></textarea>-->
                <textarea type="text" maxlength="320" rows="3" class="form-control input-lg" name="_descripcionProducto2" required="required" placeholder="Ingresar descripción producto 2"></textarea>
              </div>

            </div>

            <!--=====================================
            AGREGAR FOTO DE PORTADA
            ======================================-->

            <!--<div class="form-group">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

              <input type="file" class="fotoPortada">

              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>-->

            <!--=====================================
            AGREGAR PRECIO
            ======================================-->

            <div class="form-group row">
               
              <!-- PRECIO -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">PRECIO</div>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                  <!--<input type="number" class="form-control input-lg precio" min="0" step="any">-->
                  <input type="number" class="form-control input-lg" name="_precio" value="" required="required" min="0" step="any"/>

                </div>

              </div>


            </div>
            <!--=====================================
            AGREGAR FOTO
            ======================================-->

            <!--<div class="form-group">
                
              <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

              <input name="fotoPortada" type="file" class="fotoPortada">

              <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

              <img src="/shoptodo/images/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">

            </div>-->

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
              </div>
              <div class="custom-file">
                <input type="file" name="_fotoPortada" class="custom-file-input fotoPortada" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Elije el achivo</label>
 
              </div>
            </div>
            <img src="/shoptodo/images/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">
          
          </div>

        </div>

        <div class="modal-footer">

          <input type="submit" class="btn btn-success" id="_submit" name="_submit" value="Save Product" />

        </div>

       </form>
</div>