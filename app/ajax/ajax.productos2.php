<?php

require_once "../../core/Database.php";

class AjaxProductos2{

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

        if (($arrayValues[0]==NULL) AND ($arrayValues[1]==NULL) AND ($arrayValues[2]==NULL) 
            AND ($arrayValues[3]==NULL) AND ($arrayValues[4]=="") AND ($arrayValues[5]=="")
            AND ($arrayValues[6]==""))
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
                        p.Branch
                    FROM producto p WHERE p.Branch='".$arrayValues[0]."' or p.Branch='".$arrayValues[1]."' or p.Branch='".$arrayValues[2]."' or p.Branch='".$arrayValues[3]."'or p.Branch='".$arrayValues[4]."'or p.Branch='".$arrayValues[5]."'or p.Branch='".$arrayValues[6]."';";

                $stm = Database::getConnection()->prepare($sql);

                $stm->execute();
    
                $result = $stm->fetchAll();

            }catch(Exception $e){}

            return $result;
        }
	}

	public function ajaxProductosShow(){
		
        if (($this->arrayValues[0]==NULL) AND ($this->arrayValues[1]==NULL) AND ($this->arrayValues[2]==NULL) 
            AND ($this->arrayValues[3]==NULL) AND ($arrayValues[4]=="") AND ($arrayValues[5]=="")
            AND ($arrayValues[6]=="")) 
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
    $Variable = new AjaxProductos2();
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
        $Variable = new AjaxProductos2();

        $Variable -> ajaxProductosShow();
    }
}