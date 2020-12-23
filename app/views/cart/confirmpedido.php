<h1>Confirm the order </h1>
                <?php if ($_SESSION['error']!=""){ ?>
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h3><?php echo $_SESSION['error']; ?></h3>
                    </div>
                <?php };?>

                    <?php if ($tabla_res['items'] == 0){ ?>
                        <b>Items: 0 | Total: 0 </b>
                    <?php }else{ ?>
                        <b>Items: <?php echo $tabla_res['items'];?> | Total: <?php echo $tabla_res['sumtotal'];?> </b>|
                    <?php }?>

			<a href="?c=Home&a=index" class = "btn btn-info">Main page</a>&nbsp;&nbsp;
			<?php if ($_SESSION['usuario_logged']==TRUE) { ?>
				<a href="?c=User&a=logout" class = "btn btn-info">Logout</a>&nbsp;&nbsp;
			<?php } ?>

  <div class="row">
    <div class="col-md-6 m-t-2">

		<?php if (($_SESSION['usuario_logged']==TRUE) AND ($tabla_res['items'] > 0)){ ?>


							<h2>Customer data</h2>

							<b>Nombre :</b><?php echo $_SESSION['usuario_nombre']; ?><br>
							<b>Id Cliente :</b><?php echo $_SESSION['id_cliente']; ?><br>
							<b>Email :</b><?php echo $_SESSION['usuario_email']; ?><br>
							<b>Fecha :</b><?php echo $_SESSION['usuario_fecha']; ?><br><br>



							<table class="confirm">
								<tr>
									<td>#Item</td><td>Product</td><td>Quantity</td><td>Item Price</td><td>Total Price</td>
								</tr>
							<?php $total = 0;
								 foreach($result as $m):?>
								<tr>
									<td><?php echo $m->id;?></td><td><?php echo $m->nombre;?></td><td><?php echo $m->cantidad;?></td><td><?php echo $m->precio;?></td><td><?php echo $m->cantidad * $m->precio;?></td>
								</tr>
								<?php echo $total = $total +   $m->cantidad  *  $m->precio;?>
							<?php endforeach;?>
								<tr>
									<td></td><td></td><td></td><td>Merchandise Subtotal</td><td><?php echo $total;?></td>
								</tr>
								<tr>
									<td></td><td></td><td></td><td>Shipping</td><td>0 €</td>
								</tr>
								<tr>
									<td></td><td></td><td></td><td>Estimated Tax</td><td>0 €</td>
								</tr>
								<tr>
									<td></td><td></td><td></td><td>Total</td><td><?php echo $total;?></td>
								</tr>	
							</table>

		<?php }?>
</div>
</div>