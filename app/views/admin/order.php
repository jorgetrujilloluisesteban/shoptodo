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
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 pull-right" id="orders" style="float: right;">
<h2>Orders</h2>
<a href="?c=Admin&a=addorder">
<button type="button" class="btn btn-success">Add Order</button>
</a>
<br><br>
<table class="table table-sm table-hover">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Address</th>
			<th scope="col">Order Content</th>
			<th scope="col">
				Date<br>
				<a href="?c=Admin&a=orderby&sortby=<?php echo "DESC"; ?>">Desc</a>
				<a href="?c=Admin&a=orderby&sortby=<?php echo "ASC"; ?>">Asc</a>
			</th>
			<th scope="col" >State</th>
			<th scope="col"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>

	<?php foreach($model as $m): ?>
					<tr>
                      <td><?php echo $m["name"]; ?></td>	      
				      <td><?php echo $m["email"]; ?></td>
				      <td><?php echo $m["address"]; ?></td>
				      <td><?php echo $m["ordercontent"]; ?></td>
				      <td><?php echo $m["fecharegistro"]; ?></td>
					  <?php if ($m["estado"]==0){ ?>
					  	<td><button type="button" class="btn btn-warning btn-sm"><?php echo $m["estado"]; ?></button></td>
					  <?php }
						    if ($m["estado"]==1){ ?>
						<td><button type="button" class="btn btn-success btn-sm"><?php echo $m["estado"]; ?></button></td>
					  <?php }
						  	if ($m["estado"]==2){ ?>
						<td><button type="button" class="btn btn-danger btn-sm"><?php echo $m["estado"]; ?></button></td>
					  <?php } ?>
                      <td>
					    <a href="?c=Admin&a=pending&id=<?php echo $m["id"]; ?>">
					  		<button type="button" class="btn btn-warning btn-sm">Pending</button>
						</a>
					  </td>
					  <td>
					  	<a href="?c=Admin&a=sent&id=<?php echo $m["id"]; ?>">
					  		<button type="button" class="btn btn-success btn-sm">Sent</button>
					    </a>
					  </td>
					  <td>
					  	<a href="?c=Admin&a=deleteorder&id=<?php echo $m["id"]; ?>">
					  		<button type="button" class="btn btn-danger btn-sm">Delete</button>
					    </a>
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