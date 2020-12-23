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
	$records_per_page = 3;
	
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
<h2>Products</h2>
<a href="?c=Admin&a=addproducto">
<button type="button" class="btn btn-success">Add Product</button>
</a>

<br><br>
<table class="table table-sm table-hover">
<!--<table id="lookup" class="table table-bordered table-hover">-->
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Image</th>
			<th scope="col">Price</th>
			<th scope="col">Category</th>
			<th scope="col">Description</th>
			<th scope="col">Action</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>

			<?php foreach($model as $m): ?>
					<tr>
                      <td><?php echo $m["nombre"]; ?></td>
				      <td scope="row"><img id="imagen2" class="" src="images/<?php echo $m["imagenurl"]; ?>" alt="Card image cap"></td>
				      
				      <td><?php echo $m["precio"]; ?>€</td>
				      <td><?php echo $m["idcategoria"]; ?></td>
					  <td style="font-size: 12px;"><?php echo $m["descripcion"]; ?></td>
				      <td>
					    <a href="?c=Admin&a=edit&id=<?php echo $m["id"]; ?>">
					  		<button type="button" class="btn btn-info">Edit</button></td>
						</a>
                      <td>
					  	<!--<a href="?c=Admin&a=delete&id=<?php //echo $m["id"]; ?>">-->
					  		<button type="button" value="<?php echo $m["id"]; ?>" class="btn btn-danger deleteProduct">Delete</button>
						<!--</a>-->
					  </td>

				    </tr>
			<?php endforeach;?>


	</tbody>
</table>

	<div class="col-xs-12 col-xl-4 pagination">
		<?php			
			if ($model !=""){
				// render the pagination links
				$pagination->render();
			}
		?>
</div>
</div>



