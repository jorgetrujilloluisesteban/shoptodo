<?php
//namespace App\Models;

//require '../vendor/autoload.php';
require_once "core/Database.php";

class Admin{
    public function insertarProducto($tituloPro, $tituloProBranch, $Categoria, $Categoriatexto, $descripProducto, $precio, $imagenurl, $descripProducto2)
    {
        $estado=0;

        $stmt = Database::getConnection()->prepare("INSERT INTO producto(nombre, precio, descripcion, imagenurl, idcategoria, categoria, Branch, descripcion2) VALUES (:nombre, :precio, :descripcion, :imagenurl, :idcategoria, :categoria, :Branch, :descripcion2)");

        $stmt->bindParam(":nombre", $tituloPro, PDO::PARAM_STR);
        $stmt->bindParam(":precio", $precio, PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $descripProducto, PDO::PARAM_STR);
        $stmt->bindParam(":imagenurl", $imagenurl, PDO::PARAM_STR);
        $stmt->bindParam(":idcategoria", $Categoria, PDO::PARAM_INT);
        $stmt->bindParam(":categoria", $Categoriatexto, PDO::PARAM_STR);
        $stmt->bindParam(":Branch", $tituloProBranch, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion2", $descripProducto2, PDO::PARAM_STR);
  
            
        $stmt->execute();

    }

    public function listar_order(){
        try{
            $consulta = "SELECT * FROM orders;";

            $stm = Database::getConnection()->prepare($consulta);

            $stm->execute();

            $model = $stm->fetchAll();

        }catch(Exception $e){}

        return $model;
    }

    public function listar_order2($sortby){
        try{
            $consulta = "SELECT * FROM orders ORDER BY fecharegistro ".$sortby.";";

            $stm = Database::getConnection()->prepare($consulta);

            $stm->execute();

            $model = $stm->fetchAll();

        }catch(Exception $e){}

        return $model;
    }

    public function sent($id)
    {
        $estado=1;
        //UPDATE
        $sql = "UPDATE orders
                SET estado = ?
                WHERE id = ?
                ";
                            
        $stm = Database::getConnection()->prepare($sql);
        $stm->execute([
        $estado,
        $id
        ]);
    }

    public function pending($id)
    {
        $estado=0;
        //UPDATE
        $sql = "UPDATE orders
                SET estado = ?
                WHERE id = ?
                ";
                            
        $stm = Database::getConnection()->prepare($sql);
        $stm->execute([
        $estado,
        $id
        ]);
    }

    public function deleteorder($id)
    {
        $estado=2;
        //UPDATE
        $sql = "UPDATE orders
                SET estado = ?
                WHERE id = ?
                ";
                            
        $stm = Database::getConnection()->prepare($sql);
        $stm->execute([
        $estado,
        $id
        ]);
    }

    public function showProductid($id)
    {
        $sql = "SELECT * FROM producto WHERE producto.id=". $id . ";";

        $stm = Database::getConnection()->prepare($sql);
        $stm->execute();

        $result = $stm->fetchAll();

        return $result;
    }
    public function delete($id)
    {
        $stm = Database::getConnection()->prepare('DELETE FROM producto where id = ?');
        $stm->execute([$id]);
    }
    public function editvalue($id)
    {
        $result = [];

        try{
            $sql = "SELECT * FROM producto WHERE producto.id=". $id . ";";

            $stm = Database::getConnection()->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();

        }catch(Exception $e){}

		return $result;
    }

    public function editarProducto($tituloPro, $tituloProBranch, $Categoria, $Categoriatexto, $descripProducto, $precio, $rutaPortada, $descripProducto2, $id)
    {

       /* $stmt->bindParam(":nombre", $tituloPro, PDO::PARAM_STR);
        $stmt->bindParam(":precio", $precio, PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $descripProducto, PDO::PARAM_STR);
        $stmt->bindParam(":imagenurl", $imagenurl, PDO::PARAM_STR);
        $stmt->bindParam(":idcategoria", $Categoria, PDO::PARAM_INT);
        $stmt->bindParam(":categoria", $Categoriatexto, PDO::PARAM_STR);
        $stmt->bindParam(":Branch", $tituloProBranch, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion2", $descripProducto2, PDO::PARAM_STR);*/

        //BORRAR IMAGEN ANTERIOR

        $sql = "SELECT * FROM producto WHERE producto.id=". $id . ";";

        $stm = Database::getConnection()->prepare($sql);
        $stm->execute();

        $result = $stm->fetchAll();

        foreach($result as $m):
            $nomImagen = $m["imagenurl"];
        endforeach;

        $target_path = $_SERVER['DOCUMENT_ROOT'].'/shoptodo/images/'.$nomImagen; 
        unlink($target_path);

                //UPDATE
                $sql = "UPDATE producto
                SET  nombre = ?,
                     precio = ?,
                     descripcion = ?,
                     imagenurl = ?,
                     idcategoria = ?,
                     categoria = ?,
                     Branch = ?,
                     descripcion2 =?
                WHERE id = ?
                ";
                            
        $stm = Database::getConnection()->prepare($sql);
        $stm->execute([
        $tituloPro,
        $precio,
        $descripProducto,
        $rutaPortada,
        $Categoria,
        $Categoriatexto,
        $tituloProBranch,
        $descripProducto2,
        $id
        ]);
    }

    public function insertarOrder($name, $email, $address, $ordercontent, $fecharegistro, $estado)
    {
        $stmt = Database::getConnection()->prepare("INSERT INTO orders(name, email, address, ordercontent, fecharegistro, estado) VALUES (:name, :email, :address, :ordercontent, :fecharegistro, :estado)");

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":ordercontent", $ordercontent, PDO::PARAM_STR);
        $stmt->bindParam(":fecharegistro", $fecharegistro, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
         
        $stmt->execute();
    }
}