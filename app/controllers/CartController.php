<?php
//namespace App\Controllers;
require_once "app/models/Producto.php";
require_once "app/models/Cart.php";

class CartController{
    private $producto;
    private $cart;
    private $user;

    public function index(){
        require_once _VIEW_PATH_ .'header2.php';

        $variable = new Cart;
        $variable2 = new Producto;

        $model = $variable->listar_car();

        $cantidad_pro = 0;
        $id_pro = 0;

        //tienes que mirar si hay carrito o no
        $carrito = $variable->getCart($cantidad_pro, $id_pro);
        //da el número de producto y la suma total
        $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);

        if (!empty($_POST))
        {
            $id_pro = $_POST['idproducto'];
            $deletepro = $_POST['deletepro'];
            $cantidad_pro = 1;
            $date_pro = date("Y-m-d H:i:s");

                if(($cantidad_pro <> NULL) AND ($deletepro==1))
                {
                    $carrito = $variable->deletePro($cantidad_pro, $id_pro, $date_pro, $carrito);

                    $_SESSION["cantidad"] = $_SESSION["cantidad"] - 1;

                    $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);
                    $model = $variable->listar_car();

                    echo'<script>

                    localStorage.setItem("cantidad","'.$_SESSION["cantidad"].'");

                    swal({
                        title: "¡OK!",
                        text: "Deleted product",
                        type:"success",
                        confirmButtonText: "Close",
                        closeOnConfirm: false
                        },
                
                        function(isConfirm){
                            if (isConfirm) {	  
                                window.location ="http://localhost/shoptodo/?c=Cart&a=index";
                            } 
                    });
                
                    </script>';

                }

            unset($_POST['idproducto']);
            unset($_POST['cantidad']);
        }

        require_once _VIEW_PATH_ .'cart/index.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function confirmpedido(){
        $model = $this->cart->listar_car();

        $cantidad_pro = 0;
        $id_pro = 0;
        $log = FALSE;

        //tienes que mirar si hay carrito o no
        $carrito = $this->cart->getCart($cantidad_pro, $id_pro);
        //da el número de producto y la suma total
        $tabla_res = $this->producto->var_item($cantidad_pro, $id_pro);

        $result = $this->cart->confirmpedido($carrito);

        require_once _VIEW_PATH_ .'header.php';
        require_once _VIEW_PATH_ .'cart/confirmpedido.php';
        require_once _VIEW_PATH_ .'footer.php';   
    }

    public function checkout(){
        require_once _VIEW_PATH_ .'header2.php';

        $variable = new Cart;
        $variable2 = new Producto;
        $variable3 = new User;
        $entro="no";

        if (!empty($_POST))
        {
            $name = $_POST['_name'];
            $email = $_POST['_email'];
            $address = $_POST['_address'];

            $date_pro = date("Y-m-d H:i:s");

            if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $name) && 
            preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $email) &&
            preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $address))
            {

                    //$tabla_res = $variable2->var_item($cantidad_pro, $id_pro);
                    //$model = $variable->listar_car();
                    $cantidad_pro=0;
                    $id_pro=0;

                    /*$tabla_res['items'] = $items;
                    $tabla_res['sumtotal'] = $sumtotal;*/

                    $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);
                
                    //$tabla_res="producto";

                    $variable->checkout($name, $email, $address, $tabla_res, $date_pro);

                    //$_SESSION["cantidad"] = 0;

                    $tabla_res['items'] = 0;
                    $tabla_res['sumtotal'] = 0;

                    $fecha = date("Y-m-d H:i:s");
                    $carrito = $_SESSION['carrito_id'];
            
                            $_SESSION['carrito_id']  = "";
                            $_SESSION['id_cliente']  = "";
                            $_SESSION['cantidad']  = 0;
                            $_SESSION['id_producto']  ="";
                            $_SESSION['usuario_nombre']  ="";
                            $_SESSION['usuario_password']  ="";
                            $_SESSION['usuario_email']  = "";
                            $_SESSION['usuario_fecha']  = $fecha;
                            $_SESSION['usuario_logged']  = FALSE;
            
                    $variable = new Cart;
            
                    $variable->delete_car($carrito);

                    $entro = "si";
                
                    echo'<script>

                    swal({
                        title: "¡OK!",
                        text: "Thank you for Order",
                        type:"success",
                        confirmButtonText: "Close",
                        closeOnConfirm: false
                        },
                
                        function(isConfirm){
                            if (isConfirm) {      
                                window.location ="http://localhost/shoptodo/?c=Admin&a=index";
                            } 
                    });
                
                    </script>';

            }else{

					echo'<script>

					swal({
						  type: "error",
						  title: "it cannot be empty or carry special characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "http://localhost/shoptodo/?c=home&a=index";

							}
						})

			  	    </script>';



			}  

        }
    
        if (($_SESSION['usuario_logged']  != TRUE) AND ($entro == "no"))
        {
                    
            echo'<script>
                                swal({
                                    title: "¡OK!",
                                    text: "Yo must log in!!",
                                    type:"warning",
                                    confirmButtonText: "Close",
                                    closeOnConfirm: false
                                    },
                            
                                    function(isConfirm){
                                        if (isConfirm) {      
                                            window.location ="http://localhost/shoptodo/?c=home&a=index";
                                        } 
                                });

                </script>';  
        }

        
        require_once _VIEW_PATH_ .'cart/checkout.php';
        require_once _VIEW_PATH_ .'footer.php';   
    }

    public function detail(){
        require_once _VIEW_PATH_ .'header2.php';

        $variable = new Cart;
        $variable2 = new Producto;

        $cantidad_pro = 0;
        $id_pro = 0;
        $log = FALSE;

        //tienes que mirar si hay carrito o no
        $carrito = $variable->getCart($cantidad_pro, $id_pro);
        //da el número de producto y la suma total
        $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);

        if (!empty($_POST))
        {
            $id_pro = $_POST['idproducto'];
            $model = $variable2->detail($id_pro);

            $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);
        }

        require_once _VIEW_PATH_ .'cart/detail.php';
        require_once _VIEW_PATH_ .'footer.php';   
    }
}