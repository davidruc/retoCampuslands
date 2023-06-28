<?php
namespace App;

class departamento extends connect{
    private $queryPost = 'INSERT INTO departamento(idDep, nombreDep, idPais) VALUES (:id, :nombre_departamento, :fk_pais)';
    private $queryGet = 'SELECT departamento.idDep AS "id",
     departamento.nombreDep AS "nombre_departamento",
     departamento.idPais AS "fk_pais",
     pais.nombrePais AS "nombre_pais"
     FROM departamento 
     INNER JOIN pais ON departamento.idPais = pais.idPais
     WHERE idDep =:id';
    private $queryGetAll = 'SELECT departamento.idDep AS "id",
    departamento.nombreDep AS "nombre_departamento",
    departamento.idPais AS "fk_pais",
    pais.nombrePais AS "nombre_pais"
    FROM departamento 
    INNER JOIN pais ON departamento.idPais = pais.idPais';
    private $queryUpdate = 'UPDATE departamento SET nombreDep = :nombre_departamento, idPais = :fk_pais WHERE idDep = :id';
    private $queryDelete = 'DELETE FROM departamento WHERE idDep = :id';
    use getInstance;
    private $message;
    function __construct(private $idDep =1, public $nombreDep = 1, private $idPais=1){
        parent::__construct();
    }


    public function post_departamento(){
        try{
            $res = $this->conexion->prepare($this->queryPost);
            $res->bindValue("id", $this->idDep);
            $res->bindValue("nombre_departamento", $this->nombreDep);
            $res->bindValue("fk_pais", $this->idPais);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message"=>"inserted Data"];
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message"=> $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAll_departamento(){
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

    public function get_departamento($idDep){
        try{
            $res = $this->conexion->prepare($this->queryGet);
            $res->bindParam("id", $idDep);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetch(\PDO::FETCH_ASSOC)];
        }   catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        }   finally {
            print_r(json_encode($this->message));
        }
    }
    public function update_departamento(){
        try{
            $res = $this->conexion->prepare($this->queryUpdate);
            $res->bindValue("id", $this->idDep);
            $res->bindValue("nombre_departamento", $this->nombreDep);
            $res->bindValue("fk_pais", $this->idPais);
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
    public function delete_departamento(){
        try{
            $res = $this->conexion->prepare($this->queryDelete);
            $res->bindValue("id", $this->idDep);
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

