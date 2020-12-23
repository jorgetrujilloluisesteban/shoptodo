<?php
//namespace App\Models;

//use PHPMailer\PHPMailer\PHPMailer;
//require 'PHPMailerAutoload.php';

//require '../vendor/autoload.php';
require_once "core/Database.php";

class User{
	private $pdo;
	
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $usernameCanonical;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $emailCanonical;

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * The salt to use for hashing.
     *
     * @var string
     */
    protected $salt;

    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     */
    protected $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @var \DateTime
     */
    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string
     */
    protected $confirmationToken;

    /**
     * @var \DateTime
     */
    protected $passwordRequestedAt;

    /**
     * @var Collection
     */
    protected $groups;

    /**
     * @var array
     */
    protected $roles;


    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    //*************************
    //*************************

    public function find($username, $password, $carrito) //busca cliente
    {
            $enabled = 0;
            $vusername = 0;
            $pass="FALSE";
            $fecha = date("Y-m-d H:i:s");
            
            // Consultar si el usuario envió la contraseña correcta
            $consulta = sprintf("SELECT * FROM user WHERE username='" . $username . "';");

            $stm = Database::getConnection()->prepare($consulta);
            $stm->execute();

            $results = $stm->fetchAll();

            foreach($results as $row)
            {   
                $vusername = $row->username;
                $enabled = $row->enabled;
                $contador = $row->attempts;

                if ($row && password_verify($password, $row->password)) {
                    $pass = "TRUE";
                }else{
                    $pass = "FALSE";
                    $contador++;
                }
            }

            if (($username) == ($vusername) AND ($enabled==1) AND ($pass=="TRUE"))
            {

                    $_SESSION['carrito_id']  = $carrito;
                    $_SESSION['id_cliente']  = $row->id;
                    $_SESSION['id_producto']  ="";
                    $_SESSION['usuario_nombre']  =$row->username;
                    $_SESSION['usuario_password']  = password_verify($password, $row->password);
                    $_SESSION['usuario_email']  = $row->email;
                    $_SESSION['usuario_fecha']  = $fecha;
                    $_SESSION['usuario_logged']  = TRUE;
                    $_SESSION['enabled'] = TRUE;
                    $_SESSION['error'] = "";

					$contador = 0;
					//catchap google

					//UPDATE
					$sql = "UPDATE user
								SET attempts = ?
								WHERE username = ?
								";
											 
                    $stm = Database::getConnection()->prepare($sql);
					$stm->execute([
								$contador,
								$username
					]);


                return TRUE;
            }
            else
            {
                if (($username) == ($vusername) AND ($enabled==0) AND ($pass=="TRUE"))
                {
                    $_SESSION['error'] = "You must to confirm you email";
                    $contador = 0;

                    //UPDATE
                    $sql = "UPDATE user
                                SET attempts = ?
                                WHERE username = ?
                                ";
                                         
                    $stm = Database::getConnection()->prepare($sql);
                    $stm->execute([
                                    $contador,
                                    $username
                                ]);
                            
                }
                else
                {
					$_SESSION['error'] = "Your username o password it is wrong";
				}
                    if (($username) == ($vusername) AND ($enabled==1) AND ($pass=="FALSE"))
                    {
                        if($contador <3)
                        {
                            $_SESSION['error'] = "Your username o password it is wrong";
							//UPDATE
                            $sql = "UPDATE user
                                         SET attempts = ?
                                         WHERE username = ?
                                         ";
                                         
                            $stm = Database::getConnection()->prepare($sql);
                            $stm->execute([
                                            $contador,
                                            $username
                                ]);
                        }
                        else
                        {
                            $_SESSION['error'] = "You have exceeded the maximum attempts";
							/*if ($pass=="TRUE")
							{
								$contador = 0;
								//catchap google

								//UPDATE
								$sql = "UPDATE user
											 SET attempts = ?
											 WHERE username = ?
											 ";
											 
								$stm = $this->pdo->prepare($sql);
								$stm->execute([
												$contador,
												$username
									]);
							}*/
                        }
                    }

                $_SESSION['enable'] = FALSE;

                return FALSE;
            }
    }

    /*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function mdlMostrarUsuario($item, $valor){

		$stmt = Database::getConnection()->prepare("SELECT * FROM user WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}

    public function find_username($username, $email)
    {
            $vusername = $vemail = "";
			$existusername = $existemail = FALSE;

            $consulta = "SELECT * FROM user  WHERE username ='" . $username . "';";


            $stm = Database::getConnection()->prepare($consulta);
            $stm->execute();

            

            $results = $stm->fetchAll();

            foreach($results as $row)
            {   
                $vusername = $row["username"];
                
                if ($username == $vusername){
                    $existusername = TRUE;
                }
            }
			
			$consulta = "SELECT * FROM user  WHERE email ='" . $email . "';";

            $stm = Database::getConnection()->prepare($consulta);
            $stm->execute();

            $results = $stm->fetchAll();

            foreach($results as $row)
            {   
                $vemail = $row["email"];
                
                if ($email == $vemail){
                    $existemail = TRUE;
				}
            }
			if ($existusername == TRUE)
			{
				$_SESSION['error'] = "Your username exist, put other";
			}
			if ($existemail == TRUE)
			{
				$_SESSION['error'] = "Your email already exist, put other";	
			}
			if (($existusername == TRUE) || ($existemail == TRUE))
				return TRUE;
			else
				return FALSE;

    }

    static public function save($datos){

        $variable = new User;
        $res = $variable->find_username($datos["username"], $datos["email"]);

        if ($res == FALSE)
        {
            $stmt = Database::getConnection()->prepare("INSERT INTO user(username, password, email, token, enabled, attempts) VALUES (:username, :password, :email, :token, :enabled, :attempts)");
            
            $stmt->bindParam(":username", $datos["username"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            //$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
            //$stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
            //$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
            $stmt->bindParam(":token", $datos["csrf_token"], PDO::PARAM_STR);
            $stmt->bindParam(":enabled", $datos["enabled"], PDO::PARAM_STR);
            $stmt->bindParam(":attempts", $datos["attempts"], PDO::PARAM_STR);

            if($stmt->execute()){

                return "ok";

            }else{

                return "error";
            
            }

            $stmt->close();
            $stmt = null;

        }else{
            return "error";
        }

    }
    
    public function test_input($data) {

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    public function confirmuser($csrf_token, $carrito){

            $vcsrf_token = $pass = $vusername = $enabled = $entro = "";
            $fecha = date("Y-m-d H:i:s");

            $consulta = "SELECT * FROM user  WHERE  confirmation_token='" . $csrf_token . "';";

            $stm = Database::getConnection()->prepare($consulta);
            $stm->execute();

            $results = $stm->fetchAll();

            foreach($results as $row)
            {   
                $vcsrf_token = $row->confirmation_token;
                $enabled = $row->enabled;

                $entro = "SI";

                if ($csrf_token == $vcsrf_token){
                    $pass = "SI";
                }else{
                    $pass = "NO";
                }
            }

            if (($enabled == 0) AND ($pass == "SI"))
            {
                    //User logger and update enabled = 1
                    $_SESSION['carrito_id']  = $carrito;
                    $_SESSION['id_cliente']  = $row->id;
                    $_SESSION['id_producto']  ="";
                    $_SESSION['usuario_nombre']  =$row->username;
                    $_SESSION['usuario_password']  ="";
                    $_SESSION['usuario_email']  = $row->email;
                    $_SESSION['usuario_fecha']  = $fecha;
                    $_SESSION['usuario_logged']  = TRUE;
                    $_SESSION['enabled'] = TRUE;
                    $_SESSION['error'] = "";

                    $enabled = 1;
                    //UPDATE
                    $sql = "UPDATE user
                             SET enabled = ?
                             WHERE confirmation_token = ?
                             ";
                             
                    $stm = Database::getConnection()->prepare($sql);
                    $stm->execute([
                        $enabled,
                        $csrf_token
                        ]);

                return TRUE;
            }
            else
            {
                if ($enabled == 1)
                {
                    $_SESSION['error'] = "You are logger";
                    return TRUE;
                }else
                {
                    $_SESSION['error'] = "Your link it is wrong, please register again";
                    return FALSE;
                }

            }
    }
}