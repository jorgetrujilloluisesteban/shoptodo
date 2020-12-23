<?php
//namespace App\Models;

//require '../vendor/autoload.php';
require_once "core/Database.php";

class Producto{
	private $pdo;
	protected $id;
	protected $nombre;
	protected $precio;
	protected $descripcion;
	protected $imagenurl;
	protected $idcategoria;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     *
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return int
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set imagenurl
     *
     * @param string $imagenurl
     *
     * @return Producto
     */
    public function setImagenurl($imagenurl)
    {
        $this->imagenurl = $imagenurl;

        return $this;
    }

    /**
     * Get imagenurl
     *
     * @return string
     */
    public function getImagenurl()
    {
        return $this->imagenurl;
    }

    /**
     * Set idcategoria
     *
     * @param integer $idcategoria
     *
     * @return Producto
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria
     *
     * @return int
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }


    /***************************
    ***************************/

    public function listar() {
		$result = [];

        try{
            $sql = "
                SELECT
                    p.id,
                    p.nombre,
                    p.precio,
                    p.descripcion,
                    p.descripcion2,
                    p.imagenurl,
                    p.idcategoria
                FROM producto p;
            ";

            $stm = Database::getConnection()->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();

        }catch(Exception $e){}

		return $result;
	}

    public function listar2($arrayValues) {
		$result = [];

        try{
            $sql = "
                SELECT
                    p.id,
                    p.nombre,
                    p.precio,
                    p.descripcion,
                    p.descripcion2,
                    p.imagenurl,
                    p.idcategoria
                FROM producto p;
            ";
            
            $stm = Database::getConnection()->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();

        }catch(Exception $e){}

		return $result;
	}

    public function var_item($cantidad_pro, $id_pro) //da el numero de productos y la suma total
    {

                $log = $_SESSION['usuario_logged'];

                $num_car = NULL;

                $num_car = $_SESSION['carrito_id'];

                $stm = Database::getConnection()->prepare("SELECT c.cantidad, p.precio FROM compras c, producto p WHERE p.id = c.id_producto AND c.id_carrito = :numcar");
                $stm->bindParam(":numcar", $num_car, PDO::PARAM_INT);

                $stm->execute();
                $result = $stm->fetchAll();

                $items = 0;
                $sumtotal = 0;

                foreach ($result as $resultado) {

                    $items = $items + $resultado["cantidad"];
                    $total = $resultado["cantidad"] * $resultado["precio"];
                    $sumtotal = $sumtotal + $total;

                }

                $tabla_res['items'] = $items;
                $tabla_res['sumtotal'] = $sumtotal;

        return $tabla_res;

    }

    public function detail($id_pro){
		$result = [];

        try{
            $sql = "SELECT * FROM producto WHERE producto.id=". $id_pro . ";";

            $stm = Database::getConnection()->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();

        }catch(Exception $e){}

		return $result;    
    }

}