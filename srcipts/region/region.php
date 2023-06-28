<?php
namespace App;

class region extends connect{
    private $queryPost = 'INSERT INTO region(idReg, nombreReg, idDep) VALUES (:id, :nombre_region, :fk_dep)';
    private $queryGet = 'SELECT region.idReg AS "id",
     region.nombreReg AS "nombre_region",
     region.idDep AS "fk_dep",
     departamento.nombreDep AS "nombre_Dep"
     FROM region 
     INNER JOIN departamento ON region.idDep = departamento.idDep
     WHERE idReg =:id';
    private $queryGetAll = 'SELECT region.idReg AS "id",
    region.nombreReg AS "nombre_region",
    region.idDep AS "fk_dep",
    departamento.nombreDep AS "nombre_Dep"
    FROM region 
    INNER JOIN departamento ON region.idDep = departamento.idDep';
    private $queryUpdate = 'UPDATE region SET nombreReg = :nombre_region, idDep = :fk_dep WHERE idReg = :id';
    private $queryDelete = 'DELETE FROM region WHERE idReg = :id';
    use getInstance;
    private $message;
    function __construct(private $idReg =1, public $nombreReg = 1, private $idDep=1){
        parent::__construct();
    }


    public function post_region(){
        try{
            $res = $this->conexion->prepare($this->queryPost);
            $res->bindValue("id", $this->idReg);
            $res->bindValue("nombre_region", $this->nombreReg);
            $res->bindValue("fk_dep", $this->idDep);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message"=>"inserted Data"];
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message"=> $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAll_region(){
        try{
            $res = $this->conexion->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];
        }   catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        }   finally {
            print_r(json_encode($this->message));
        }
    }

    public function get_region($idReg){
        try{
            $res = $this->conexion->prepare($this->queryGet);
            $res->bindParam("id", $idReg);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetch(\PDO::FETCH_ASSOC)];
        }   catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        }   finally {
            print_r(json_encode($this->message));
        }
    }
    public function update_region(){
        try{
            $res = $this->conexion->prepare($this->queryUpdate);
            $res->bindValue("id", $this->idReg);
            $res->bindValue("nombre_region", $this->nombreReg);
            $res->bindValue("fk_dep", $this->idDep);
            $res->execute();
            
            if ($res->rowCount() > 0){
                $this->message = ["Code" => 200, "Message" => "Data updated"];
            }
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function delete_region(){
        try{
            $res = $this->conexion->prepare($this->queryDelete);
            $res->bindValue("id", $this->idReg);
            $res-> execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}


?>

