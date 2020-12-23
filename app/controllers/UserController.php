<?php
//namespace App\Controllers;

//use PHPMailer/PHPMailer/PHPMailer;
require_once "app/models/User.php";
require_once "app/models/Cart.php";
require_once "app/models/Producto.php";

class UserController{
    private $producto;
    private $cart;
    private $user;

    public function login(){
        require_once _VIEW_PATH_ .'header2.php';

        $cantidad_pro = 0;
        $id_pro = 0;
        $enabled = 0;
        $fecha = date("Y-m-d H:i:s");
        $log = FALSE;

        $variable = new Cart;
        $variable2 = new Producto;
        //tienes que mirar si hay carrito o no
        $carrito = $variable->getCart($cantidad_pro, $id_pro);
        //da el número de producto y la suma total
        $tabla_res = $variable2->var_item($cantidad_pro, $id_pro);

        if ($_SESSION['usuario_logged']==FALSE)
        {
            if(isset($_POST["_email"])){

                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["_email"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["_password"])){

                    $encriptar = crypt($_POST["_password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    //$tabla = "usuarios";
                    $item = "email";
                    $valor = $_POST["_email"];

                    $respuesta = User::mdlMostrarUsuario($item, $valor);

                    if($respuesta["email"] == $_POST["_email"] && $respuesta["password"] == $encriptar){

                            if($respuesta["enabled"] == 1){

                                echo'<script>

                                swal({
                                    title: "YOU HAVE NOT VERIFIED YOUR EMAIL!",
                                    text: "Please check the inbox or SPAM folder of your email to verify the email address'.$respuesta["email"].'!",
                                    type: "error",
                                    confirmButtonText: "Close",
                                    closeOnConfirm: false
                                },

                                function(isConfirm){
                                        if (isConfirm) {	   
                                            history.back();
                                        } 
                                });

                                </script>';

                            }else{
                            
                                $log = true;

                                $_SESSION['carrito_id']  = $carrito;
                                $_SESSION['id_cliente']  = $respuesta["id"];
                                $_SESSION['id_producto']  ="";
                                $_SESSION['usuario_nombre']  = $respuesta["username"];
                                $_SESSION['usuario_password']  = $encriptar;
                                $_SESSION['usuario_email']  = $_POST["_email"];
                                $_SESSION['usuario_fecha']  = $fecha;
                                $_SESSION['usuario_logged']  = TRUE;
                                $_SESSION['enabled'] = TRUE;
                                $_SESSION['error'] = "";
            
                                //$contador = 0;
                                //catchap google
            
                                //UPDATE
                                /*$sql = "UPDATE user
                                            SET attempts = ?
                                            WHERE username = ?
                                            ";
                                                         
                                $stm = $this->pdo->prepare($sql);
                                $stm->execute([
                                            $contador,
                                            $username
                                ]);*/

                                echo'<script>

                                swal({
                                    title: "¡OK!",
                                    text: "You are logged in",
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

                    }else{

                        echo'<script>

                                swal({
                                    title: "ERROR WHEN ENTERING!",
                                    text: "Please check that the email exists or the password matches the one registered!",
                                    type: "error",
                                    confirmButtonText: "Close",
                                    closeOnConfirm: false
                                },

                                function(isConfirm){
                                        if (isConfirm) {	   
                                            history.back();
                                        } 
                                });

                                </script>';

                    }

                }else{

                    echo '<script> 

                            swal({
                                title: "¡ERROR!",
                                text: "Error entering the system, special characters are not allowed!",
                                type:"error",
                                confirmButtonText: "Close",
                                closeOnConfirm: false
                                },

                                function(isConfirm){

                                    if(isConfirm){
                                        history.back();
                                    }
                            });

                    </script>';

                }

            }
        else{
            $enabled = $_SESSION['enabled'];

            if ($enabled == TRUE){
                $log =TRUE;
            }
            else{
                $log = FALSE;
                //$_SESSION['error'] = "You must to confirm you email";
            }
        }
    }

        require_once _VIEW_PATH_ .'user/login.php';
        require_once _VIEW_PATH_ .'footer.php';
    }

    public function logout(){
        require_once _VIEW_PATH_ .'header.php';

        $model = "";
        $cantidad_pro = 0;
        $id_pro = 0;
        $log = FALSE;

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

        echo'<script>

        localStorage.setItem("cantidad","'.$_SESSION["cantidad"].'");

        swal({
            title: "¡OK!",
            text: "You are logged out",
            type:"success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            },

            function(isConfirm){

                if(isConfirm){
                    window.location = "http://localhost/shoptodo/index.php";
                }
        });

        </script>';

        require_once _VIEW_PATH_ .'home/index.php';
        require_once _VIEW_PATH_ .'footer.php';
    }
    public function register(){

        require_once _VIEW_PATH_ .'header2.php';

        // define variables and set to empty values
        $username = $email = $password = $csrf_token ="";
        $nameErr = $emailErr = $passwordErr ="";
        $cantidad_pro = 0;
        $id_pro = 0;
        $log = FALSE;

        //Generacion de Token
        $token = uniqid();

        if (!empty($_POST))
        {            
            if(isset($_POST["_username"])){

                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["_username"]) &&
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["_email"]) &&
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["_password"])){
    
                       $encriptar = crypt($_POST["_password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$
                           $2a$07$asxx54ahjppf45sd87a5auxq/SS293XhTEeizKWMnfhnpfay0AALe');
    
                       $encriptarEmail = md5($_POST["_email"]);

                       $csrf_token = $_POST["_csrf_token"];
    
                    $datos = array("username"=>$_POST["_username"],
                                   "password"=> $encriptar,
                                   "email"=> $_POST["_email"],
                                   "foto"=>"",
                                   "modo"=> "directo",
                                   "verificacion"=> 1,
                                   "csrf_token"=> $csrf_token,
                                   "enabled"=> 0,
                                   "attempts"=> 0,
                                   "emailEncriptado"=>$encriptarEmail);
    
                    //$tabla = "usuarios";
                    $respuesta = User::save($datos);
    
                    if($respuesta == "ok"){

                        /*=============================================
                        VERIFICACIÓN CORREO ELECTRÓNICO
                        =============================================*/

                        //date_default_timezone_set("America/Bogota");

                        //$url = Ruta::ctrRuta();	

                        /*$mail = new PHPMailer;

                        $mail->CharSet = 'UTF-8';

                        $mail->isMail();

                        $mail->setFrom('estebanbluefire@gmail.com', 'Artstyloweb.com');

                        $mail->addReplyTo('estebanbluefire@gmail.com', 'Artstyloweb.com');

                        $mail->Subject = "Please verify your email address";

                        $mail->addAddress($_POST["_email"]);

                        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
                            

                            <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                            
                                <center>
                                

                                <h3 style="font-weight:100; color:#999">CHECK YOUR EMAIL ADDRESS</h3>

                                <hr style="border:1px solid #ccc; width:80%">

                                <h4 style="font-weight:100; color:#999; padding:0 20px">To start using your Virtual Store account, you must confirm your email address</h4>

                                <a href="'.$csrf_token.'" target="_blank" style="text-decoration:none">

                                <div style="line-height:60px; background:#0aa; width:60%; color:white">Verify your email address</div>

                                </a>

                                <br>

                                <hr style="border:1px solid #ccc; width:80%">

                                <h5 style="font-weight:100; color:#999">If you did not sign up for this account, you can ignore this email and the account will be deleted.</h5>

                                </center>

                            </div>

                        </div>');

                        $envio = $mail->Send();*/

                        /*=============================
                        TIENES QUE CONSEGUIR QUE ENVIE
                        ==============================*/
                        $envio = true;
                        /*===========================
                        ============================= */

                        if(!$envio){

                            echo '<script> 

                                swal({
                                    title: "¡ERROR!",
                                    text: "There was a problem sending email verification to '.$_POST["_email"].$mail->ErrorInfo.'!",
                                    type:"error",
                                    confirmButtonText: "Close",
                                    closeOnConfirm: false
                                    },

                                    function(isConfirm){

                                        if(isConfirm){
                                            history.back();
                                        }
                                });

                            </script>';

                        }else{

                            echo '<script> 

                                swal({
                                    title: "¡OK!",
                                    text: "Please check the inbox or SPAM folder of your email '.$_POST["_email"].' to verify the account!",
                                    type:"success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                    },

                                    function(isConfirm){

                                        if(isConfirm){
                                            window.location = "http://localhost/shoptodo/index.php";
                                        }
                                });

                            </script>';

                        }

                    }else{
                    
                        echo '<script> 

                        swal({
                            title: "¡ERROR!",
                            text: "There was a problem : '.$_SESSION['error'].'!",
                            type:"error",
                            confirmButtonText: "Close",
                            closeOnConfirm: false
                            },

                            function(isConfirm){

                                if(isConfirm){
                                    history.back();
                                }
                        });

                    </script>';
            
                    }    
                }else{
    
                    echo '<script> 
    
                            swal({
                                  title: "¡ERROR!",
                                  text: "Error registering user, no special characters allowed!",
                                  type:"error",
                                  confirmButtonText: "Cerrar",
                                  closeOnConfirm: false
                                },
    
                                function(isConfirm){
    
                                    if(isConfirm){
                                        history.back();
                                    }
                            });
    
                    </script>';
    
                }
    
            }
        }


        require_once _VIEW_PATH_ .'user/register.php';
        require_once _VIEW_PATH_ .'footer.php';      
    }

    public function confirmemail(){
        // define variables and set to empty values
        $username = $csrf_token = $res = "";
        $nameErr = $emailErr = "";
        $cantidad_pro = 0;
        $id_pro = 0;
        $log = FALSE;

        //Generacion de Token
        $token = uniqid();

        //tienes que mirar si hay carrito o no
        $carrito = $this->cart->getCart($cantidad_pro, $id_pro);
        //da el número de producto y la suma total
        $tabla_res = $this->producto->var_item($cantidad_pro, $id_pro);

        $username = $_GET['n'];
        $csrf_token = $_GET['h'];

        $res = $this->user->confirmuser($csrf_token, $carrito);    

        if ($res == TRUE){
            $log = TRUE;
        }else{
            $log = FALSE;
        } 

        require_once _VIEW_PATH_ .'header2.php';
        require_once _VIEW_PATH_ .'user/confirmemail.php';
        require_once _VIEW_PATH_ .'footer.php';   
    }
}