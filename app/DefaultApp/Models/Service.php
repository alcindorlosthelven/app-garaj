<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 3/25/2020
 * Time: 11:42 AM
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class Service extends Model
{
    protected $table = "service";
    private $id, $sigle, $definition;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * @param mixed $sigle
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;
    }

    /**
     * @return mixed
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param mixed $definition
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }

    private function existe($sigle)
    {
        try {
            $con = self::connection();
            $req = "select *from service where sigle=:sigle";
            $stmt = $con->prepare($req);
            $stmt->execute(array(
                ":sigle" => $sigle
            ));
            $data = $stmt->fetchAll();
            if (count($data) > 0) {
                return true;
            }
            return false;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function add()
    {
        if ($this->existe($this->sigle)) {
            return "Service existe deja";

        }
        return parent::add(); // TODO: Change the autogenerated stub
    }

    public static function idService($nom)
    {
        $con = self::connection();
        $req = "select id From service where sigle='$nom'";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['id'];
    }

    public static function nonService($id)
    {
        $con = self::connection();
        $req = "select sigle From service where id='$id'";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['sigle'];
    }

    public static function listerPourStock(){
        $req = "SELECT *FROM service WHERE sigle='MAGASIN' OR sigle='PHARMACIE' OR sigle='SSH' OR sigle='SSC' OR sigle='SSA' OR sigle='SSU' OR sigle='LABO'";
        $con=self::connection();
        $stmt=$con->prepare($req);
        $stmt->execute();
        $data=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Service");
        return $data;
    }


    public static function listerPourAdmision(){
        $req = "SELECT *FROM service WHERE  sigle='SSH' OR sigle='SSC' OR sigle='SSA' OR sigle='SSU'";
        $con=self::connection();
        $stmt=$con->prepare($req);
        $stmt->execute();
        $data=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Service");
        return $data;
    }


}