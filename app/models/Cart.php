<?php
//namespace App\Models;

//require '../vendor/autoload.php';
require_once "core/Database.php";

class Cart{
	private $pdo;
	protected $id;
	protected $idcarrito;
	protected $idproducto;
	protected $cantidad;
	protected $fecharegistro;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

        /**
     * Set idcarrito
     *
     * @param int $idcarrito
     *
     * @return Cart
     */
    public function setIdcarrito($idcarrito)
    {
        $this->idcarrito = $idcarrito;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getIdcarrito()
    {
        return $this->idcarrito;
    }

        /**
     * Set idproducto
     *
     * @param int $idproducto
     *
     * @return Cart
     */
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto
     *
     * @return int
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

        /**
     * Set cantidad
     *
     * @param int $cantidad
     *
     * @return Cart
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

        /**
     * Set fecharegistro
     *
     * @param date $fecharegistro
     *
     * @return Cart
     */
    public function setFecharegistro($fecharegistro)
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return date
     */
    public function getFecharegistro()
    {
        return $this->fecharegistro;
    }

    /***************************
    ***************************/

    public function listar_car(){

        $num_car = $_SESSION['carrito_id'];
        $id_producto = $_SESSION['id_producto'];

        try{
            $consulta = "SELECT * FROM compras, producto  WHERE compras.id_carrito =" . $num_car . " AND compras.id_producto = producto.id ;";

            $stm = Database::getConnection()->prepare($consulta);

            $stm->execute();

            $result = $stm->fetchAll();

        }catch(Exception $e){}

		return $result;
	}


    public function createNumber()
    {
        $num = "";

        $num = rand(0, 9999);

        return $num;
    }

    public function GetidCarrito_sesion()
    {   
            //session_start();

            $num_car = NULL;

            if ( $_SESSION['carrito_id']!="")
            {
                $num_car = $_SESSION['carrito_id'];
                return $num_car;
            }
            else
            {
                $tempCarrito = $this->createNumber();

                $fecha = date("Y-m-d H:i:s");

                $_SESSION['carrito_id']  = $tempCarrito;
                $_SESSION['id_cliente']  = "";
                $_SESSION['cantidad']  = 0;
                $_SESSION['id_producto']  ="";
                $_SESSION['usuario_nombre']  ="";
                $_SESSION['usuario_password']  ="";
                $_SESSION['usuario_email']  = "";
                $_SESSION['usuario_fecha']  = $fecha;
                $_SESSION['usuario_logged']  = FALSE;
                $_SESSION['enabled'] = FALSE;
                $_SESSION['error'] = "";

                return $tempCarrito;
            }

    }

    public function checkout($name, $email, $address, $tabla_res, $date_pro)
    {
        $estado=0;

        /*$tabla_res['items'] = $items;
        $tabla_res['sumtotal'] = $sumtotal;*/

        $ordercontent = $tabla_res['items'] . "units, £" . $tabla_res['sumtotal'];

        $stmt = Database::getConnection()->prepare("INSERT INTO orders(name, email, address, ordercontent, fecharegistro, estado) VALUES (:name, :email, :address, :ordercontent, :fecharegistro, :estado)");

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":ordercontent", $ordercontent, PDO::PARAM_STR);
        $stmt->bindParam(":fecharegistro", $date_pro, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
  
            
        $stmt->execute();

    }

    public function deletePro($cantidad, $idproducto, $fecha, $carrito)
    {
        $vcantidad = 0;
                
        $carrito = $this->GetidCarrito_sesion();

        $consulta = "SELECT * FROM compras WHERE id_producto =" . $idproducto . " AND id_carrito =" . $carrito .";";

        $stm = Database::getConnection()->prepare($consulta);
        $stm->execute();

        $results = $stm->fetchAll();

        foreach($results as $row)
        {   
            $vcantidad = $row["cantidad"];
        }
        
        $vcantidad = $vcantidad - $cantidad;
        $vcantidad2 = $vcantidad;

            if ($vcantidad >0 OR $vcantidad ==0)
            {
                if ($row["cantidad"] == 1 OR ($vcantidad2 == 0))
                {

                    $stm = Database::getConnection()->prepare('DELETE FROM compras where id_producto = ?');
                    $stm->execute([$idproducto]);

                }
                else
                {
                    //UPDATE
                    $sql = "UPDATE compras
                             SET cantidad = ?,
                                 fecha = ? 
                             WHERE id_producto = ?
                             AND id_carrito = ?
                             ";
                             
                    $stm = Database::getConnection()->prepare($sql);
                    $stm->execute([
                        $vcantidad,
                        $fecha,
                        $idproducto,
                        $carrito
                        ]);
    
                }
            }
    }

    public function AgregarACarrito($carrito, $idproducto, $cantidad, $fecha)
    {
        $metodo = $direccion = $pago = "";
        
            $consulta = "SELECT * FROM compras WHERE id_producto =" . $idproducto . " AND id_carrito =" . $carrito .";";

            $stm = Database::getConnection()->prepare($consulta);
            $stm->execute();

            $result = $stm->fetchAll();

            $nuevacantidad = 0;


                $control = "FALSE";
                foreach($result as $row)
                {
                    $control = "TRUE";
                    $nuevacantidad = $nuevacantidad + $row["cantidad"];
                }
                $nuevacantidad = $nuevacantidad + $cantidad;
            
            if ($control == "TRUE")
            {
                //UPDATE
                $sql = "UPDATE compras
                             SET cantidad = ?,
                                 fecha= ? 
                             WHERE id_producto = ?
                             ";
                             
                $stm = Database::getConnection()->prepare($sql);
                $stm->execute([
                    $nuevacantidad,
                    $fecha,
                    $idproducto
                    ]);  
                
                return $carrito;
            }
            else
            {
                if ($nuevacantidad <> 0)
                 {
                    $stmt = Database::getConnection()->prepare("INSERT INTO compras(id_carrito, id_usuario, id_producto, metodo, direccion, pago, fecha, cantidad) VALUES (:id_carrito, :id_usuario, :id_producto, :metodo, :direccion, :pago, :fecha, :cantidad)");

                    $stmt->bindParam(":id_carrito", $carrito, PDO::PARAM_INT);
                    $stmt->bindParam(":id_usuario", $_SESSION["id_cliente"], PDO::PARAM_INT);
                    $stmt->bindParam(":id_producto", $idproducto, PDO::PARAM_INT);
                    $stmt->bindParam(":metodo", $metodo, PDO::PARAM_STR);
                    $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
                    $stmt->bindParam(":pago", $pago, PDO::PARAM_STR);
                    $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
                    $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            
                    $stmt->execute();

                    return $carrito;
                }
            }
            
    }

    public function getCart($cantidad, $idproducto)
    {
        $fecha = date("Y-m-d H:i:s");

        $variable = new Cart;
        $carrito = $variable->GetidCarrito_sesion();

            if($cantidad!=0)
            {
                $vcarrito = $variable->AgregarACarrito($carrito, $idproducto, $cantidad, $fecha);
            }

        return $carrito;


    }
    public function delete_car($carrito){
        $stm = Database::getConnection()->prepare('DELETE FROM compras where id_carrito = ?');
        $stm->execute([$carrito]);   

        $_SESSION['carrito_id']!="";
        $this->GetidCarrito_sesion();
    }

    public function confirmpedido($carrito){
         $consulta = "SELECT * FROM compras2, producto2  WHERE compras.id_carrito =" . $carrito . " AND compras.id_producto = producto.id ;";

        $result = Database::getConnection()->prepare($consulta);


        return $result;

    }
}