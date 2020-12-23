<?php

require_once "../../core/Database.php";

//define("RAIZ", $_SERVER['DOCUMENT_ROOT'].'/images/');

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

    public function eliminarproducto($arrayValues) {
        $result = [];
        $i = 0;
        $id = $arrayValues[0];

        if ($arrayValues[0]==NULL)
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

                $result = [];

                $sql = "SELECT * FROM producto WHERE producto.id=". $id . ";";
        
                $stm = Database::getConnection()->prepare($sql);
                $stm->execute();
        
                $result = $stm->fetchAll();

                foreach($result as $m):
                    $nomImagen = $m["imagenurl"];
                endforeach;

   
                $target_path = $_SERVER['DOCUMENT_ROOT'].'/shoptodo/images/'.$nomImagen; 

                unlink($target_path);

                $stm = Database::getConnection()->prepare('DELETE FROM producto where id = ?');
                $stm->execute([$id]);


            }catch(Exception $e){}

            return "ok";
        }
	}

	public function ajaxProductos(){
		
        if ($this->arrayValues[0]==NULL) 
        {
            $model = $this->listar();

        }else{
            $model = $this->eliminarproducto($this->arrayValues);
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