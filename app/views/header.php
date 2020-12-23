<!DOCTYPE html>
<html lang="en">
<head>
  <title>ShopTotal php 7</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="public/css/mio.css" type="text/css" rel="stylesheet">
  

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="path/to/zebra_pagination.css" type="text/css">

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script src="public/js/jquery.dataTables.min.js"></script>
  <script src="public/js/dataTables.bootstrap.min.js"></script>		
  <link rel="stylesheet" href="public/css/dataTables.bootstrap.min.css" />
  

</head>
<body>

<div class="container">
	<!--Cabecera-->
	<div class="row">
		<!--Titulo-->
		<div class="col-sm-12 col-lg-3 top">
			<h2 id="encabezado"><b>ShopTotal PHP 7</b></h2>
		</div>
		<!--busqueda de productos-->
		<div class="col-sm-12 col-lg-4 top busqueda">
			<form id="encabezado" class="form-inline my-2 my-lg-0">
				<div class="input-group">
					<input class="form-control" type="search" placeholder="Search" id="input-search">
					<div class="input-group-append">
					<div class="input-group-text" id="boton-search"><i class="fa fa-search"></i></div>
					</div>
				</div>
			</form>
		</div>
		<!--Menu de registro y login-->
		<div class="col-sm-12 col-lg-2 top">
			<div class="dropdown">
				<?php if ($_SESSION['usuario_logged']==FALSE) { ?>
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				My account
				</button>
				<?php }else{ ?>
				<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
				My account
				</button>
				<?php } ?>
				<div class="dropdown-menu">

					<?php if ($_SESSION['usuario_logged']==FALSE) { ?>
						<a class="dropdown-item" id="log" href="?c=User&a=login"><b>Hi, Log in</b>&nbsp;&nbsp;&nbsp;&nbsp;Log in  <i class="fa fa-key"></i> </a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="reg" href="?c=User&a=register"><i class="fa fa-user"></i> Registro</a>
					<?php }else{ ?>
						<h3 class="dropdown-item"><?php echo $_SESSION['usuario_nombre'];?></h3>
						<a class="dropdown-item" href="?c=User&a=logout" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>&nbsp;&nbsp;
					<?php } ?>
					<?php //if (($_SESSION['usuario_logged']==TRUE) AND ($tabla_res['items'] != 0)) {
						if (($_SESSION['usuario_logged']==TRUE)){ ?>
						<!--<a class="dropdown-item" href="?c=Cart&a=confirmpedido"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Confirm</a>&nbsp;&nbsp;-->
						<a class="dropdown-item" href="#"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Confirm</a>&nbsp;&nbsp;
					<?php } ?>
						<a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My orders</a>
						<a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Contact</a>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-1 top pull-left">
			<a class="dropdown-item" href="?c=Admin&a=index" id="cart"><button type="button" class="btn btn-warning"> Admin </button></a>
		</div>
		<!--Menu de carro de la compra-->
		<div class="col-sm col-lg-2 top">
		<?php if($_SESSION["cantidad"]==0)
			{ ?>
			<a class="dropdown-item" href="#" id="cart"><button type="button" class="btn btn-info"><i class="fa fa-shopping-cart"></i> Shopping cart <span class="badge badge-light"><?php echo $_SESSION["cantidad"]; ?></span></button></a>
		<?php }else{ ?>
			<a class="dropdown-item" href="?c=Cart&a=index" id="cart"><button type="button" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Shopping cart <span class="badge badge-light"><?php echo $_SESSION["cantidad"]; ?></span></button></a>
		<?php } ?>
		</div>
	</div>
	<div class="row categories">
		<div class="dropdown">
			<!--Todas las categorias-->
			<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				All Categories
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" id="ca-laptop" value="laptop" href="#">Laptop</a>
				<a class="dropdown-item" id="ca-book" value="book" href="#">Programming Books</a>
				<a class="dropdown-item" id="ca-tablet" value="tablet" href="#">Tablet</a>
				<a class="dropdown-item" id="ca-ebook" value="ebook" href="#">E-Book</a>
			</div>
		</div>
	</div>
	<div id="carouselid">
	<div class="row">
		<!--Carousel-->
		<div id="demo" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
				<li data-target="#demo" data-slide-to="3"></li>
			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/carrusell.jpg" alt="Laptop">
					<div class="carousel-caption">
						<h3 class="colorrojo">Laptops</h3>
						<p class="colorrojo">We have de best price here</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/carrusell2.jpg" alt="Programming Books">
					<div class="carousel-caption">
						<h3 class="colorrojo">Programming Books</h3>
						<p class="colorrojo">We have de best price here</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/carrusell3.jpg" alt="Tablet">
					<div class="carousel-caption">
						<h3 class="colorrojo">Tablet</h3>
						<p class="colorrojo">We have de best price here</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/carrusell4.jpg" alt="E-Book">
					<div class="carousel-caption">
						<h3 class="colorrojo">E-Book</h3>
						<p class="colorrojo">We have de best price here</p>
					</div>
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
				<span class="colorrojo">Previous</span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
				<span class="colorrojo">Next</span>
			</a>
		</div>
	</div>
	</div>



