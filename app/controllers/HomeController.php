<?php
//namespace App\Controllers;

require_once "app/models/Producto.php";

class HomeController{
    private $producto;
    private $cart;

    public function index(){

        require_once _VIEW_PATH_ .'header.php';

        $this->producto = new Producto;

        $model = $this->producto->listar();

        $cantidad_pro = 0;
        $id_pro = 0;

        $variable = new Cart;
        $variable2 = new Producto;
        //tienes que mirar si hay carrito o no
        $carrito = $variable->getCart($cantidad_pro, $id_pro);
        //da el número de producto y la suma total
        $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);

        if (!empty($_POST))
        {
            $id_pro = $_POST['idproducto'];
            $cantidad_pro = 1;
            $date_pro = date("Y-m-d H:i:s");

                if($cantidad_pro <> NULL)
                {
                    //tienes que mirar si hay carrito o no
                    $carrito = $variable->getCart($cantidad_pro, $id_pro);
                    //da el número de producto y la suma total
                    $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);

                    $_SESSION["cantidad"] = $_SESSION["cantidad"] + 1;

                    echo'<script>

                    localStorage.setItem("cantidad","'.$_SESSION["cantidad"].'");

                    swal({
                        title: "¡OK!",
                        text: "Product added",
                        type:"success",
                        confirmButtonText: "Close",
                        closeOnConfirm: false
                        },
                
                        function(isConfirm){
                
                            if(isConfirm){
                                window.location ="http://localhost/shoptodo/index.php";
                            }
                    });
                
                    </script>';
                }

            unset($_POST['idproducto']);
            unset($_POST['cantidad']);
        }
        
        require_once _VIEW_PATH_ .'home/index.php';
        require_once _VIEW_PATH_ .'footer.php';
    }
}