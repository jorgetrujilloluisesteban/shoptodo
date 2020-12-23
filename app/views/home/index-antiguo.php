<h2>Your <span>catalog</span></h2>

		<h3><?php echo $_SESSION['error']; ?></h3>
					<?php if ($tabla_res['items'] == 0){ ?>
						<b>Items: 0 | Total: 0 </b>
					<?php }else{ ?>
						<b>Items: <?php echo $tabla_res['items'];?> | Total: <?php echo $tabla_res['sumtotal'];?> </b>|
					<?php }?>

			<a href="?c=Cart&a=index" class = "btn btn-info">View Cart</a>&nbsp;&nbsp;
			<?php if ($_SESSION['usuario_logged']==FALSE) { ?>
				<a href="?c=User&a=login" class = "btn btn-info">Login</a>&nbsp;&nbsp;
				<a href="?c=User&a=register" class="btn btn-primary">Register User</a>&nbsp;&nbsp;
			<?php }else{ ?>
				<a href="?c=User&a=logout" class = "btn btn-info">Logout</a>&nbsp;&nbsp;
			<?php } ?>
			<?php if (($_SESSION['usuario_logged']==TRUE) AND ($tabla_res['items'] != 0)) { ?>
				<a href="?c=Cart&a=confirmpedido" class = "btn btn-primary">Confirm</a>&nbsp;&nbsp;
			<?php } ?>

			<article class="productos">
				<?php foreach($model as $m): ?>
				<section class="libros">

						<div class="imagen"> <img src="<?php echo $m->imagenurl;?>.jpg" /></div>
								<div class="nom-desc">
									<h3><b><?php echo $m->nombre?></b></h3>
									<h6><?php echo $m->descripcion?></h6><br>
								</div>
								<div class="formulario">
									<b>Book <?php echo $m->precio ?>€</b><br>
									 <form lang="en" action="?c=home&a=index" method="post">
										<input type="hidden" name="idproducto" value="<?php echo $m->id?>"/>
										<label>Amount&nbsp;&nbsp;</label><br>
										<input lang="en" type="number" name="cantidad" size="2" min="1" max="5" style="width: 2em;"/><br><br>
										<input type="submit" name="submit" value="Add to Cart" class="btn btn-success" />
									 </form>
								</div>
						</div>
						<div class="separa"></div>
						<br>
				</section>
				<?php endforeach;?>
			</article>
