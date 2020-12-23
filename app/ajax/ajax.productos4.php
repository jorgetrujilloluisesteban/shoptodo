<?php

require_once "../../core/Database.php";

class AjaxProductos{

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

    public function listar2($arrayValues) {
        $result = [];
        $i = 0;

        if (($arrayValues[0]==NULL)) 
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
                    FROM producto p;
                ";

                $stm = Database::getConnection()->prepare($sql);

                $stm->execute();
    
                $result = $stm->fetchAll();
    
            }catch(Exception $e){}
    
            return $result;
        }else{
            try{
                $sql = "
                    SELECT
                        p.id,
                        p.nombre,
                        p.precio,
                        p.descripcion,
                        p.descripcion2,
                        p.imagenurl,
                        p.idcategoria,
                        p.precio
                    FROM producto p WHERE p.precio >='".$arrayValues[0]."';";

                $stm = Database::getConnection()->prepare($sql);

                $stm->execute();
    
                $result = $stm->fetchAll();

            }catch(Exception $e){}

            return $result;
 
        }
	}

	public function ajaxProductosShow(){
		
        if (($this->arrayValues[0]==NULL)) 
        {
            $model = $this->listar();

        }else{
            $model = $this->listar2($this->arrayValues);
        }

		$respuesta = $model;

		//var_dump($respuesta);

		echo json_encode($respuesta);

	}

}

if ($_POST){
    $Variable = new AjaxProductos();
    $i=0;

    foreach($_POST as $campo => $valor){
            //echo "- ". $campo ." = ". $valor;
        $Variable -> arrayValues[$i] = $valor;
        if (($valor=="") or ($valor==NULL)){
            $Variable -> arrayValues[$i] = NULL;
        }
        $i++;
    }

    $Variable -> ajaxProductosShow();
}else
{
    if (!$_POST){
        $Variable = new AjaxProductos();

        $Variable -> ajaxProductosShow();
    }
}