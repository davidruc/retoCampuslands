<?php
namespace App;

class campers extends connect{
    private $queryPost = 'INSERT INTO campers(idCamper, nombreCamper, apellidoCamper, fechaNac, idReg) VALUES (:id, :nombre_campers, :apellido_campers , :fecha_nacimiento, :fk_reg)';
    private $queryGet = 'SELECT campers.idCamper AS "id",
     campers.nombreCamper AS "nombre_campers",
     campers.apellidoCamper AS "apellido_campers",
     campers.fechaNac AS "fecha_nacimiento",
     campers.idReg AS "fk_reg",
     region.nombreReg AS "nombre_Reg"
     FROM campers 
     INNER JOIN region ON campers.idReg = region.idReg
     WHERE idCamper =:id';
    private $queryGetAll = 'SELECT campers.idCamper AS "id",
    campers.nombreCamper AS "nombre_campers",
    campers.apellidoCamper AS "apellido_campers",
    campers.fechaNac AS "fecha_nacimiento",
    campers.idReg AS "fk_reg",
    region.nombreReg AS "nombre_Reg"
    FROM campers 
    INNER JOIN region ON campers.idReg = region.idReg';
    private $queryUpdate = 'UPDATE campers SET nombreCamper = :nombre_campers, apellidoCamper = :apellido_campers, fechaNac=:fecha_nacimiento,idReg=:fk_reg   WHERE idCamper = :id';
    private $queryDelete = 'DELETE FROM campers WHERE idCamper = :id';
    use getInstance;
    private $message;
    function __construct(private $idCamper =1, public $nombreCamper = 1, public $apellidoCamper=1, private $fechaNac=1, private $idReg=1){
        parent::__construct();
    }


    public function post_campers(){
        try{
            $res = $this->conexion->prepare($this->queryPost);
            $res->bindValue("id", $this->idCamper);
            $res->bindValue("nombre_campers", $this->nombreCamper);
            $res->bindValue("apellido_campers", $this->apellidoCamper);
            $res->bindValue("fecha_nacimiento", $this->fechaNac);
            $res->bindValue("fk_reg", $this->idReg);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message"=>"inserted Data"];
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message"=> $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAll_campers(){
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

    public function get_campers($idCamper){
        try{
            $res = $this->conexion->prepare($this->queryGet);
            $res->bindParam("id", $idCamper);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetch(\PDO::FETCH_ASSOC)];
        }   catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        }   finally {
            print_r(json_encode($this->message));
        }
    }
    public function update_campers(){
        try{
            $res = $this->conexion->prepare($this->queryUpdate);
            $res->bindValue("id", $this->idCamper);
            $res->bindValue("nombre_campers", $this->nombreCamper);
            $res->bindValue("apellido_campers", $this->apellidoCamper);
            $res->bindValue("fecha_nacimiento", $this->fechaNac);
            $res->bindValue("fk_reg", $this->idReg);
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
    public function delete_campers(){
        try{
            $res = $this->conexion->prepare($this->queryDelete);
            $res->bindValue("id", $this->idCamper);
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

