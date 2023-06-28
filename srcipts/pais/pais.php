<?php
namespace App;

class pais extends connect{
    private $queryPost = 'INSERT INTO pais(idPais, nombrePais) VALUES (:id, :nombre_pais)';
    private $queryGet = 'SELECT idPais AS "id", nombrePais AS "nombre_pais" FROM pais WHERE idPais =:id';
    private $queryGetAll = 'SELECT idPais AS "id", nombrePais AS "nombre_pais" FROM pais';
    private $queryUpdate = 'UPDATE pais SET nombrePais = :nombre_pais WHERE idPais = :id';
    private $queryDelete = 'DELETE FROM pais WHERE idPais = :id';
    use getInstance;
    private $message;
    function __construct(private $idPais =1, public $nombrePais = 1){
        parent::__construct();
    }


    public function post_pais(){
        try{
            $res = $this->conexion->prepare($this->queryPost);
            $res->bindValue("id", $this->idPais);
            $res->bindValue("nombre_pais", $this->nombrePais);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message"=>"inserted Data"];
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message"=> $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAll_pais(){
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

    public function get_pais($idPais){
        try{
            $res = $this->conexion->prepare($this->queryGet);
            $res->bindParam("id", $idPais);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetch(\PDO::FETCH_ASSOC)];
        }   catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        }   finally {
            print_r(json_encode($this->message));
        }
    }
    public function update_pais(){
        try{
            $res = $this->conexion->prepare($this->queryUpdate);
            $res->bindValue("id", $this->idPais);
            $res->bindValue("nombre_pais", $this->nombrePais);
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
    public function delete_pais(){
        try{
            $res = $this->conexion->prepare($this->queryDelete);
            $res->bindValue("id", $this->idPais);
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
