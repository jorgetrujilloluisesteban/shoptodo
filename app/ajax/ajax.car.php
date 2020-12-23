<?php

require_once "../../core/Database.php";

class AjaxCar{

	/*======================================================
	show products with and without filters in ajax
	=======================================================*/	

	public $arrayValues = [];

	public function listar_car($arrayValues) {
        $result = [];

        $num_car = $arrayValues[0];
        $id_producto = $arrayValues[1];

        $sql = $consulta = "SELECT * FROM cart, producto  WHERE cart.idcarrito =" . $num_car . " AND cart.idproducto = producto.id ;";

        $stm = Database::getConnection()->prepare($sql);

        $stm->execute();

        $result = $stm->fetchAll();

		return $result;

	}

	public function ajaxCarShow(){
		
        $model2 = $this->listar_car();

		$respuesta = $model2;

		//var_dump($respuesta);

		echo json_encode($respuesta);

	}

}

if ($_POST){
    $Variable = new AjaxCart();
    $i=0;

    foreach($_POST as $campo => $valor){
            //echo "- ". $campo ." = ". $valor;
        $Variable -> arrayValues[$i] = $valor;
        if (($valor=="") or ($valor==NULL)){
            $Variable -> arrayValues[$i] = NULL;
        }
        $i++;
    }

    $Variable -> ajaxCarShow();
}else
{
    if (!$_POST){
        $Variable = new AjaxCar();

        $Variable -> ajaxCarShow();
    }
}