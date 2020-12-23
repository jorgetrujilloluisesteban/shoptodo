<?php
$suma=0;
?>
<h3>Items in cart </h3>

			<a href="?c=Home&a=index" class = "btn btn-info">Main page</a>&nbsp;&nbsp;
			<br><br>
		<!--<div class="table-responsive">-->
			<table class="table table-sm car">
				  <thead class="car">
				    <tr class="car">
				      <th scope="col">Product</th>
				      <th scope="col" class="ocultar">Description</th>
				      <th scope="col">Name</th>
				      <th scope="col">Price</th>
				      <th scope="col">Amount</th>
				      <th scope="col">Total</th>
				      <th scope="col"></th>
				    </tr>
				  </thead>
				  <tbody>

				<?php 
				if ($tabla_res['items']!=0){
				foreach($model as $m): ?>
					<tr class="car">
				      <td scope="row" class="car"><img id="imagen2" class="" src="images/<?php echo $m["imagenurl"]; ?>" alt="Card image cap"></td>
				      <td class="descripcart car">
					  		<b><?php echo $m["descripcion"]; ?></b><div class="descrip22"><?php echo $m["descripcion2"]; ?></div>
							<br><br><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Delivery available in <span style="color:green">2-5 days</span>
							<br><br>
							<?php
								if (($m["categoria"])!="book"){?>

								<div class="col-xs-12 col-lg-10 pull-left">
									<button class="btn-sm btn-primary button-circle" id="guarantee">
										<i class="fa fa-angle-down" aria-hidden="true"></i>
									</button>&nbsp;<b>Guarantee plus</b>
										<br>
										<input type="checkbox" class="filter-guarantee-1" id="<?php echo $m['id'];?>a" name="vehicle1" value="plus">
										<label class="">Plus Extension 5 Years</label>
										<br>						
								</div>
								<div class="col-xs-12 col-lg-2 pull-right">
									<button class="btn-sm btn-primary button-circle" id="espacio">
										<i class="fa fa-angle-down" aria-hidden="true"></i>
									</button>
									<br>
									<span class="<?php echo $m['id'];?>a" value="59" style="display:none; font-size:15px;">59</span>€
								</div>
							<?php
								}
							?>
							
					  </td>
				      <td class="car"><?php echo $m["nombre"]; ?></td>
				      <td class="car"><?php echo $m["precio"]; ?>€</td>
				      <td class="car"><?php echo $m["cantidad"]; ?></td>
					  <td class="car"><?php echo $m["cantidad"] * $m["precio"];?></td>
				      <td class="cantidadcart car"></td>
				      <td class="car">
				      		<form action="" method="post">
								<input type="hidden" name="idproducto" value="<?php echo $m["id"]; ?>"/>
								<input type="hidden" name="deletepro" value=1/>
								<input type="submit" name="submit" value="Delete Product" class="btn btn-danger btn-sm btn-block deletepro" />
							</form>
				      </td>
				    </tr>
				    <?php $total = $m["precio"] * $m["cantidad"]; ?>
				    <?php $suma = $suma + $total; ?>
				<?php endforeach;
				}?>
					<tr class="car">
				     	<th scope="row"></th>
				      	<td></td>	
						<td></td>
						<td></td>
						<td><b>Subtotal</b></td>
						<td id="sumatotal"><?php echo $_SESSION['total']  = $suma;?></td>
						<td></td>
						<td></td>
				    </tr>
					<tr class="car">
				     	<th scope="row"></th>
				      	<td></td>	
						<td></td>
						<td></td>
						<td>IVA 21%</td>
						<td id="iva"><?php echo $suma * 21 /100;?></td>
						<td></td>
						<td></td>
				    </tr>
					<tr class="car">
				     	<th scope="row"></th>
				      	<td></td>	
						<td></td>
						<td></td>
						<td id="texttotal"><b>Total</b></td>
						<td id="total"><?php echo round(($suma * 21 /100) + $suma);?></td>
						<td></td>
						<td>IVA included</td>
				    </tr>
					<tr class="car">
				     	<th scope="row"></th>
				      	<td></td>	
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<!--<form lang="en" action="" method="post" class="detail">-->
							<!--Necesitas guardar datos en tabla factura y finalizar el proceso de compras -->
							<!--<form action="" method="post">
								<input type="hidden" name="idproducto" value="<?php //echo $m["id"]; ?>"/>
								<input type="hidden" name="deletepro" value=0/>
								<input type="submit" name="submit" value="Chekout" class="btn btn-success btn-lg checkout" />
							</form>-->
							<!--</form>-->
							<!--<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalCheckout">Checkout</button>-->
							
							<a class="dropdown-item" href="?c=Cart&a=checkout" id="checkout"><button type="button" class="btn btn-success btn-lg">Checkout</button></a>
						</td>
				    </tr>
				   </tbody>
			</table>
		<!--</div>-->
		</article>

<!-- Modal -->
<div class="modal fade" id="modalCheckout" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea class="form-control" id="inputMessage" placeholder="Enter your message"></textarea>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#websendeos').stacktable();
</script>

<script>
    $('table').stacktable();
</script>