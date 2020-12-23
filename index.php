<?php
session_start();

if(!isset($_SESSION['carrito_id']) || !isset($_SESSION['id_cliente']) || !isset($_SESSION['cantidad']) || 
!isset($_SESSION['id_producto']) || !isset($_SESSION['usuario_nombre']) || !isset($_SESSION['usuario_password']) || 
!isset($_SESSION['usuario_email']) || !isset($_SESSION['enabled']) || !isset($_SESSION['usuario_fecha'])||
!isset($_SESSION['usuario_logged'])|| !isset($_SESSION['admin'])){

	$fecha = date("Y-m-d H:i:s");

	$_SESSION['carrito_id']  = "";
	$_SESSION['id_cliente']  = "";
	$_SESSION['cantidad']  = 0;
	$_SESSION['id_producto']  ="";
	$_SESSION['usuario_nombre']  ="";
	$_SESSION['usuario_password']  ="";
	$_SESSION['usuario_email']  = "";
	$_SESSION['enabled'] = FALSE;
	$_SESSION['usuario_fecha']  = $fecha;
	$_SESSION['usuario_logged']  = FALSE;

	$_SESSION['admin'] = FALSE;

	$_SESSION['total']  = 0;
	$_SESSION['iva'] = 0;

}

require_once "vendor/autoload.php";
require_once "app/controllers/HomeController.php";
require_once "app/controllers/UserController.php";
require_once "app/controllers/CartController.php";
require_once "app/controllers/AdminController.php";

//require_once 'path/to/Zebra_Pagination.php';

$_SESSION['error']="";

define('_VIEW_PATH_','app/views/');

/*
?c=home&a=index
?c=User&a=login
?c=User&a=register
?c=User&a=logout
?c=Cart&a=index
?c=Cart&a=confirmpedido
?c=Cart&a=detail
?c=Cart&a=checkout
?c=Cart&a=confirmemail&n=jose&h=988990
?c=Admin&a=product
?c=Admin&a=order
?c=Admin&a=index
?c=Admin&a=addproducto
?c=Admin&a=sent
?c=Admin&a=pending
?c=Admin&a=delete
?c=Admin&a=edit
?c=Admin&a=saveproductedit
?c=Admin&a=addorder
?c=Admin&a=orderby
?c=Admin&a=deleteorder&id
*/
if (isset($_GET['c'],$_GET['a']))
{
    $c=$_GET['c'];
    $a=$_GET['a'];
}
else{
    $c="Home";
    $a="index";
}


if (($c == "Home" AND $a == "index") OR ($c == "User" AND $a == "login") OR ($c == "User" AND $a == "register") 
	OR ($c == "User" AND $a == "logout") OR ($c == "Cart" AND $a == "detail") OR ($c == "Cart" AND $a == "confirmpedido") OR ($c == "Cart" AND $a == "index") OR ($c == "Cart" AND $a == "checkout")
	OR ($c == "User" AND $a == "confirmemail") OR ($c == "Admin" AND $a == "product") 
	OR ($c == "Admin" AND $a == "order") OR ($c == "Admin" AND $a == "index") OR ($c == "Admin" AND $a == "addproducto") OR ($c == "Admin" AND $a == "sent") OR ($c == "Admin" AND $a == "pending")
	OR ($c == "Admin" AND $a == "delete") OR ($c == "Admin" AND $a == "edit") OR ($c == "Admin" AND $a == "saveproductedit") OR ($c == "Admin" AND $a == "addorder") OR ($c == "Admin" AND $a == "orderby")
	OR ($c == "Admin" AND $a == "deleteorder"))
{

	//Router
	//$d = sprintf('App\Controllers\%sController', $_GET['c']);
	//$c = "Home";
	$d = sprintf('%sController', $c);

	$e = $a;

	$d = trim($d);

	$controller = new $d;
	$variable = null;

	$controller->$e($variable);
}
else
{
	//Router
	$c = sprintf('%sController', 'Home');

	$a = 'index';

	//$c = trim(ucfirst($c));
	$c = trim($c);

	$controller = new $c;
	$variable = null;
	
	$controller->$a();
}