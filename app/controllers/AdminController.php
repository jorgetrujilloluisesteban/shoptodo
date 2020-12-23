<?php
//namespace App\Controllers;

require_once "app/models/Producto.php";
require_once "app/models/Cart.php";
require_once "app/models/Admin.php";

class AdminController{
    private $producto;
    private $cart;
    private $admin;

    public function index(){
        require_once _VIEW_PATH_ .'header2.php';
        require_once _VIEW_PATH_ .'admin/index.php';
        require_once _VIEW_PATH_ .'footer.php';
    }
    public function product(){
        require_once _VIEW_PATH_ .'header2.php';

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

        require_once _VIEW_PATH_ .'admin/product.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function order(){
        require_once _VIEW_PATH_ .'header2.php';

        $this->admin = new Admin;

        $model = $this->admin->listar_order();

        require_once _VIEW_PATH_ .'admin/order.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function orderby(){
        require_once _VIEW_PATH_ .'header2.php';

        $this->admin = new Admin;

        $sortby = $_GET['sortby'];

        $model = $this->admin->listar_order2($sortby);

        require_once _VIEW_PATH_ .'admin/order.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function addorder(){
        require_once _VIEW_PATH_ .'header2.php';

        $variable = new Cart;
        $variable2 = new Producto;
        $variable3 = new Admin;

        if (!empty($_POST))
        {
            $name = $_POST['_name'];
            $email = $_POST['_email'];
            $address = $_POST['_address'];
            $ordercontent = $_POST['_ordercontent'];
            $fecharegistro = $_POST['_fecharegistro'];
            $estado = $_POST['_estado'];

                if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $name) && 
                   preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $email) &&
                   preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $address) && 
                   preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $ordercontent))
                {

                    $variable3->insertarOrder($name, $email, $address, $ordercontent, $fecharegistro, $estado);

                    echo'<script>

                    swal({
                        title: "¡OK!",
                        text: "Saved order",
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

							window.location = "http://localhost/shoptodo/?c=Admin&a=index";

							}
						})

			  	    </script>';



			    }   
        }

        
        require_once _VIEW_PATH_ .'admin/addorder.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function addproducto(){
        require_once _VIEW_PATH_ .'header2.php';

        $variable = new Cart;
        $variable2 = new Producto;
        $variable3 = new Admin;

        if (!empty($_POST))
        {
            $tituloPro = $_POST['_tituloProducto'];
            $tituloProBranch = $_POST['_tituloProductoBranch'];
            $Categoria = $_POST['_seleccionarCategoria'];
            $Categoriatexto = $_POST['_seleccionarCategoriatexto'];
            $descripProducto = $_POST['_descripcionProducto'];
            $descripProducto2 = $_POST['_descripcionProducto2'];
            $precio = $_POST['_precio'];


                if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $tituloPro) && 
                   preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $tituloProBranch) &&
                   preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $Categoriatexto) && 
                   preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $descripProducto) &&
                   preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $descripProducto2))
                {

                    /*=============================================
                    VALIDAR IMAGEN PORTADA
                    =============================================*/

                    $rutaPortada = "default.jpg";

                        if(isset($_FILES["_fotoPortada"]["tmp_name"]) && !empty($_FILES["_fotoPortada"]["tmp_name"]))
                        {
                            /*=============================================
                            DEFINIMOS LAS MEDIDAS
                            =============================================*/
        
                            list($ancho, $alto) = getimagesize($_FILES["_fotoPortada"]["tmp_name"]);	
        
                            $nuevoAncho = 1280;
                            $nuevoAlto = 720;
        
        
                            /*=============================================
                            DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                            =============================================*/
        
                            if($_FILES["_fotoPortada"]["type"] == "image/jpeg"){
        
                                /*=============================================
                                GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                                =============================================*/
        
                                $aleatorio = mt_rand(100,999);
        
                                $rutaPortada = $_FILES["_fotoPortada"]["tmp_name"];
        
                                $origen = $_FILES["_fotoPortada"]["tmp_name"];

                                $destino = "c:/wamp64/www/shoptodo/images/".$aleatorio.".jpg";

                                $destino2 = $aleatorio.".jpg";

                                move_uploaded_file($origen,$destino);
        
                            }
        
                            if($_FILES["_fotoPortada"]["type"] == "image/png"){
        
                                /*=============================================
                                GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                                =============================================*/
        
                                $aleatorio = mt_rand(100,999);

                                $rutaPortada = $_FILES["_fotoPortada"]["tmp_name"];
        
                                $origen = $_FILES["_fotoPortada"]["tmp_name"];
	
                                $destino = "c:/wamp64/www/shoptodo/images/".$aleatorio.".png";

                                $destino2 = $aleatorio.".png";	

                                move_uploaded_file($origen,$destino);
        
                            }
        
                        }

                        /*===========================================*/

                        $tabla_res="producto";

                        $rutaPortada = $destino2;

                        $variable3->insertarProducto($tituloPro, $tituloProBranch, $Categoria, $Categoriatexto, $descripProducto, $precio, $rutaPortada, $descripProducto2);

                        echo'<script>

                        swal({
                            title: "¡OK!",
                            text: "Saved product",
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

							window.location = "http://localhost/shoptodo/?c=Admin&a=index";

							}
						})

			  	    </script>';



			    }   
        }

        
        require_once _VIEW_PATH_ .'admin/addproducto.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function sent(){
        require_once _VIEW_PATH_ .'header2.php';

        $this->admin = new Admin;

        $id = $_GET["id"];

        $this->admin->sent($id);

        $this->admin = new Admin;

        $model = $this->admin->listar_order();

        require_once _VIEW_PATH_ .'admin/order.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function pending(){
        require_once _VIEW_PATH_ .'header2.php';

        $this->admin = new Admin;

        $id = $_GET["id"];

        $this->admin->pending($id);

        $this->admin = new Admin;

        $model = $this->admin->listar_order();

        require_once _VIEW_PATH_ .'admin/order.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function deleteorder(){
        require_once _VIEW_PATH_ .'header2.php';

        $this->admin = new Admin;

        $id = $_GET['id'];

        $this->admin->deleteorder($id);

        $model = $this->admin->listar_order();

        require_once _VIEW_PATH_ .'admin/order.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function delete(){
        require_once _VIEW_PATH_ .'header2.php';

        $this->admin = new Admin;

        $id = $_GET["id"];

        $this->admin->delete($id);

        echo'<script>

        swal({
            title: "¡OK!",
            text: "Delete product",
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

        $this->producto = new Producto;

        //$model = $this->producto->listar();
        

        require_once _VIEW_PATH_ .'admin/product.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function edit(){
        require_once _VIEW_PATH_ .'header2.php';

        $this->admin = new Admin;

        $id = $_GET["id"];

        $this->admin = new Admin;

        $result = $this->admin->editvalue($id);

        //$this->admin->edit($id);

        //$this->producto = new Producto;

        //$model = $this->producto->listar();
        //?c=Admin&a=edit

        require_once _VIEW_PATH_ .'admin/editproducto.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function saveproductedit(){
        require_once _VIEW_PATH_ .'header2.php';

        $variable = new Cart;
        $variable2 = new Producto;
        $variable3 = new Admin;

        if (!empty($_POST))
        {
            $tituloPro = $_POST['_tituloProducto'];
            $tituloProBranch = $_POST['_tituloProductoBranch'];
            $Categoria = $_POST['_seleccionarCategoria'];
            $Categoriatexto = $_POST['_seleccionarCategoriatexto'];
            $descripProducto = $_POST['_descripcionProducto'];
            $descripProducto2 = $_POST['_descripcionProducto2'];
            $precio = $_POST['_precio'];
            //$imagenurl = "1.jpg";
            $id = $_POST['id'];

            if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $tituloPro) && 
            preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $tituloProBranch) &&
            preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $Categoriatexto) && 
            preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $descripProducto) &&
            preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $descripProducto2))
            {

                $rutaPortada = "default.jpg";

                        if(isset($_FILES["_fotoPortada"]["tmp_name"]) && !empty($_FILES["_fotoPortada"]["tmp_name"]))
                        {
                            /*=============================================
                            DEFINIMOS LAS MEDIDAS
                            =============================================*/
        
                            list($ancho, $alto) = getimagesize($_FILES["_fotoPortada"]["tmp_name"]);	
        
                            $nuevoAncho = 1280;
                            $nuevoAlto = 720;
        
        
                            /*=============================================
                            DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                            =============================================*/
        
                            if($_FILES["_fotoPortada"]["type"] == "image/jpeg"){
        
                                /*=============================================
                                GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                                =============================================*/
        
                                $aleatorio = mt_rand(100,999);
        
                                $origen = $_FILES["_fotoPortada"]["tmp_name"];

                                $destino = "c:/wamp64/www/shoptodo/images/".$aleatorio.".jpg";
  
                                $destino2 = $aleatorio.".jpg";
                                $rutaPortada = $destino2;

                                move_uploaded_file($origen,$destino);
        
                            }
        
                            if($_FILES["_fotoPortada"]["type"] == "image/png"){
        
                                /*=============================================
                                GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                                =============================================*/
        
                                $aleatorio = mt_rand(100,999);

                                $rutaPortada = $_FILES["_fotoPortada"]["tmp_name"];
        
                                $origen = $_FILES["_fotoPortada"]["tmp_name"];
	
                                $destino = "c:/wamp64/www/shoptodo/images/".$aleatorio.".png";
   
                                $destino2 = $aleatorio.".png";	

                                move_uploaded_file($origen,$destino);
        
                            }
        
                        }

                        /*===========================================*/

                    $tabla_res="producto";

                    //$rutaPortada = $destino2;

                    $variable3->editarProducto($tituloPro, $tituloProBranch, $Categoria, $Categoriatexto, $descripProducto, $precio, $rutaPortada, $descripProducto2, $id);

                    echo'<script>

                    swal({
                        title: "¡OK!",
                        text: "Saved product",
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

							window.location = "http://localhost/shoptodo/?c=Admin&a=index";

							}
						})

			  	    </script>';



			}  

        }

        
        require_once _VIEW_PATH_ .'admin/index.php';
        require_once _VIEW_PATH_ .'footer.php';     
    }
}