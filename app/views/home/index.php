<?php
	$url1="images/";
	$i=0;
	$primero=true;
	$primero2=true;
	$cantidad=1;

	// let's paginate data from an array...
	$countries = array(
		// array of countries
	);
	
	// how many records should be displayed on a page?
	$records_per_page = 8;
	
	// include the pagination class
	//require 'path/to/Zebra_Pagination.php';
	
	// instantiate the pagination object
	$pagination = new Zebra_Pagination();
	
	if ($model !=""){
		// the number of total records is the number of records in the array
		$pagination->records(count($model));

		// records per page
		$pagination->records_per_page($records_per_page);

		// here's the magic: we need to display *only* the records for the current page
		$model = array_slice(
			$model,
			(($pagination->get_page() - 1) * $records_per_page),
			$records_per_page
		);
	}
?>
	<!--=====================================
	BOTON GRID AND LIST
	======================================-->


			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="gridlist">

				<div class="btn-group pull-right gridlist">

					 <button type="button" class="btn btn-primary btnGrid float-right" id="btnList0">
					 
						<i class="fa fa-list" aria-hidden="true"></i> 

						<span class="col-xs-0 pull-right">&nbsp;LIST</span>

					 </button>

					 &nbsp;&nbsp;&nbsp;&nbsp;

					 <button type="button" class="btn btn-primary btnList float-right" id="btnGrid0">
					 	
					 	<i class="fa fa-th" aria-hidden="true"></i>

						<span class="col-xs-0 pull-right">&nbsp;GRID</span>

					 </button>
					
				</div>		

			</div>

			<div class="clearfix"></div>

		<?php
		if(!$model){

			echo '<div class="col-xs-12 error404 text-center">

					<h1><small>¡Oops!</small></h1>

					<h2>There are not Products</h2>

				</div>';

			}else{ 
		?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fondo">
	<!--=============================================
	FILTER
	=============================================-->
	<div class="col-xs-12 col-lg-2 pull-left">
		<div class="clearfix"></div><div class="col-xs-12"><hr></div>'
		<div class="background-filter">
			<h5><b>Filter the item list</b></h5>
			<a href="#" id="delete-filters">Delete filters</a>
			<hr>
			<!-- Filter 1-->
			<button class="btn-sm btn-primary button-circle" id="flip">
				<i class="fa fa-angle-down" aria-hidden="true"></i>
			</button>&nbsp;<b>Category</b>


			<div class="category" id="panel">
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-laptop" id="customCheck" value="laptop" name="example1">
					<label class="custom-control-label" for="customCheck">Laptop</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-tablet" id="customCheck1" value="tablet" name="example1">
					<label class="custom-control-label" for="customCheck1">Tablet</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-e-book" id="customCheck2" value="ebook" name="example1">
					<label class="custom-control-label" for="customCheck2">E-book</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-book" id="customCheck3" value="book" name="example1">
					<label class="custom-control-label" for="customCheck3">Book</label>
				</div>
			</div>
			<!-- Filter 2-->

			<button class="btn-sm btn-primary button-circle" id="flip2">
				<i class="fa fa-angle-down" aria-hidden="true"></i>
			</button>&nbsp;<b>Branch</b>


			<div class="category" id="panel2">
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-laptop" value="lenovo" id="customCheck4" name="example1">
					<label class="custom-control-label" for="customCheck4">Lenovo</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-tablet" value = "medio" id="customCheck5" name="example1">
					<label class="custom-control-label" for="customCheck5">Medio</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-e-book" value = "samsung" id="customCheck6" name="example1">
					<label class="custom-control-label" for="customCheck6">Samsung</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-book" value = "amazon" id="customCheck7" name="example1">
					<label class="custom-control-label" for="customCheck7">Amazon</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-tablet" value = "php" id="customCheck8" name="example1">
					<label class="custom-control-label" for="customCheck8">Php</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-e-book" value = "jquery" id="customCheck9" name="example1">
					<label class="custom-control-label" for="customCheck9">JQuery</label>
				</div>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input filter-category-book" value = "java" id="customCheck10" name="example1">
					<label class="custom-control-label" for="customCheck10">Java</label>
				</div>
			</div>
			<!-- Filter 3-->
			<br>
			<button class="btn-sm btn-primary button-circle" id="flip3">
				<i class="fa fa-angle-down" aria-hidden="true"></i>
			</button>&nbsp;<b>Higher price</b>
			<div class="category" id="panel3">
				<div class="slidecontainer">

					<input type="range" min="1" max="700" value="350" class="custom-range" id="customCheck11" name="points1">

					<p>Price: <span id="demo2">350</span></p>
				</div>
			</div>

		</div>
	</div>

	<div class="col-xs-12 col-lg-10 pull-right" id="productos">

	<!--=============================================
	CALL PRODUCTOS
	=============================================-->
		<?php

					echo '<div class="col-lg-12 col-xs-12 list0" style="display: none;">';

					$i = 0 ;

					//foreach ($model as $key => $value)
					foreach($model as $m):

						echo '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-left">
								<!--izquierda-->
								<div class="descripcion">
								<a class="" href="'.$url1.$m["imagenurl"].'">
									<img class="img-responsive card" src="'.$url1.$m["imagenurl"].'" alt="Card image cap">
								</a>
								</div>
								<div class="descripcion">
									<h5 class="nombre">'.$m["nombre"].'</h5>
									<p class="desc">'.$m["descripcion"].'</p>
									<br>
									<p class="desc2">'.$m["descripcion2"].'</p>
								</div>
							 </div>
							 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 descrip2 pull-right">
								 <!--derecha-->
								 <h2 class="">£'.$m["precio"].'</h2>

									<a href="" class="consulta"><span class="iconify" data-icon="octicon-location" data-inline="false"></span>
									Check availability in your store</a><br>
									<a href="" class="consulta"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Check all delivery and collection options</a>
									<br>
									<br>
									<form lang="en" action="?c=home&a=index" method="post">
										<input type="hidden" name="idproducto" value="'.$m["id"].'"/>
										<input type="hidden" name="idcliente" value="'.$_SESSION["id_cliente"].'"/>
										<input type="hidden" name="idcarro" value="'.$_SESSION['carrito_id'].'"/>
										<input type="hidden" name="cantidad" value="'.$cantidad.'"/>
										<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm addCar1" />
									</form>
									<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">
										<input type="hidden" name="idproducto" value="'.$m["id"].'"/>
										<input type="hidden" name="idcliente" value="'.$_SESSION["id_cliente"].'"/>
										<input type="hidden" name="idcarro" value="'.$_SESSION['carrito_id'].'"/>
										<input type="hidden" name="cantidad" value="'.$cantidad.'"/>
										<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm" />
									</form>
							 </div>
						';					

					endforeach;
						

					echo '</div>';

					echo '<div class="col-xs-12 grid0">';

						$i = 0 ;

						//foreach ($model as $key => $value)
						foreach($model as $m):
							echo '<a href="?id='.$m["id"].'"  class="pixelProducto">
								<div style="display: inline-block;font-size: inherit;">
									<div class="card">
									<a class="" href="'.$url1.$m["imagenurl"].'"><img class="card-img-top imagen" src="'.$url1.$m["imagenurl"].'" alt="Card image cap"></a>
									<div class="card-body">
										<h5 class="card-title">'.$m["nombre"].'</h5>
										<p class="card-text">'.$m["descripcion"].'</p>
									</div>
									<ul class="list-group list-group-flush">
										<li class="list-group-item">£'.$m["precio"].'</li>
									</ul>
									<div class="card-body">
										<form lang="en" action="?c=home&a=index" method="post">
											<input type="hidden" name="idproducto" value="'.$m["id"].'"/>
											<input type="hidden" name="idcliente" value="'.$_SESSION["id_cliente"].'"/>
											<input type="hidden" name="idcarro" value="'.$_SESSION['carrito_id'].'"/>
											<input type="hidden" name="cantidad" value="'.$cantidad.'"/>
											<input type="submit" name="submit" value="Add to Cart" class="btn btn-danger btn-sm btn-block addCart2" />
										</form>
										<form lang="en" action="?c=Cart&a=detail" method="post" class="detail">
											<input type="hidden" name="idproducto" value="'.$m["id"].'"/>
											<input type="hidden" name="idcliente" value="'.$_SESSION["id_cliente"].'"/>
											<input type="hidden" name="idcarro" value="'.$_SESSION['carrito_id'].'"/>
											<input type="hidden" name="cantidad" value="'.$cantidad.'"/>
											<input type="submit" name="submit" value="Details" class="btn btn-danger btn-sm btn-block" />
										</form>
									</div>
									</div>
								</div>
								</a>';			

						endforeach;	

					echo '</div>';					

				}
			?>
	</div>
</div>

<div class="clearfix"></div>
	<div class="row">
		<div class="col-xs-12 col-xl-4">
		</div>
		<div class="col-xs-12 col-xl-4 pagination">
			<?php			
				if ($model !=""){
					// render the pagination links
					$pagination->render();
				}
			?>
		</div>
		<div class="col-xs-12 col-xl-4">
		</div>

	</div>

</div>