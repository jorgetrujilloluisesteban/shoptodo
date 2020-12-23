<?php

require_once "../../core/Database.php";

class ProductosAjax{

	/*======================================================
	show products with and without filters in ajax
	=======================================================*/	

	public $arrayValues = [];

	private $pdo;
	protected $id;
	protected $nombre;
	protected $precio;
	protected $descripcion;
	protected $imagenurl;
	protected $idcategoria;

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

    public function guardarproducto($arrayValues) {
        $result = [];
        $i = 0;

        if (($arrayValues[0]==NULL) AND ($arrayValues[1]==NULL) AND ($arrayValues[2]==NULL) 
            AND ($arrayValues[3]==NULL) AND ($arrayValues[4]==NULL) AND ($arrayValues[5]==NULL)
            AND ($arrayValues[6]==NULL)) 
        {
            
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
                    FROM producto2 p;
                ";

                $stm = Database::getConnection()->prepare($sql);

                $stm->execute();
    
                $result = $stm->fetchAll();
    
            }catch(Exception $e){}
    
            return $result;
        }else{
            try{
  
                /*$stm = Database::getConnection()->prepare("SELECT * FROM producto WHERE precio like '%$arrayValues[0]%' OR descripcion like '%$arrayValues[0]%' OR descripcion2 like '%$arrayValues[0]%'");

                $stm-> execute();

                $result = $stm->fetchAll();*/
                $imagenurl="1.jpg";

                $stmt = Database::getConnection()->prepare("INSERT INTO producto(nombre, precio, descripcion, imagenurl, idcategoria, categoria, Branch, descripcion2) VALUES (:nombre, :precio, :descripcion, :imagenurl, :idcategoria, :categoria, :Branch, descripcion2)");

                $stmt->bindParam(":nombre", $arrayValues[0], PDO::PARAM_STR);
                $stmt->bindParam(":precio", $arrayValues[1], PDO::PARAM_INT);
                $stmt->bindParam(":descripcion", $arrayValues[2], PDO::PARAM_STR);
                $stmt->bindParam(":imageurl", $imageurl, PDO::PARAM_STR);
                $stmt->bindParam(":idcategoria", $arrayValues[3], PDO::PARAM_INT);
                $stmt->bindParam(":categoria", $arrayValues[4], PDO::PARAM_STR);
                $stmt->bindParam(":Branch", $arrayValues[5], PDO::PARAM_STR);
                $stmt->bindParam(":descripcion2", $arrayValues[6], PDO::PARAM_STR);

                $stmt->execute();


            }catch(Exception $e){}

            return "ok";
        }
	}

	public function ajaxProductos(){
		
        if (($this->arrayValues[0]==NULL) AND ($this->arrayValues[1]==NULL) AND ($this->arrayValues[2]==NULL) 
            AND ($this->arrayValues[3]==NULL) AND ($this->$arrayValues[4]==NULL) AND ($this->$arrayValues[5]==NULL)
            AND ($arrayValues[6]==NULL)) 
        {
            $model = $this->listar();

        }else{
            $model = $this->guardarproducto($this->arrayValues);
        }

		$respuesta = $model;

		//var_dump($respuesta);

		echo json_encode($respuesta);

	}

}

if ($_POST){

    $Variable = new ProductosAjax();
    $i=0;

    foreach($_POST as $campo => $valor){
            //echo "- ". $campo ." = ". $valor;
        $Variable -> arrayValues[$i] = $valor;

        if (($valor=="") or ($valor==NULL)){
            $Variable -> arrayValues[$i] = NULL;
        }
        $i++;
    }

    $Variable -> ajaxProductos();
}else
{
    if (!$_POST){
 
        $Variable = new ProductosAjax();

        $Variable -> ajaxProductos();
    }
}