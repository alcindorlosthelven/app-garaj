<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 3/25/2020
 * Time: 2:47 PM
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class PersonnePrevenirEmployer extends Model
{
    protected $table="personne_prevenir_employer";
    private $id,$id_employer,$nom,$prenom,$telephone,$relation;

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
    public function getIdEmployer()
    {
        return $this->id_employer;
    }

    /**
     * @param mixed $id_employer
     */
    public function setIdEmployer($id_employer)
    {
        $this->id_employer = $id_employer;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @param mixed $relation
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
    }

    public static function rechercherParEmployer($id_employer){
        try{
            $con=self::connection();
            $req="select *from personne_prevenir_employer where id_employer=:id_employer";
            $stmt=$con->prepare($req);
            $stmt->execute(array(
                ":id_employer"=>$id_employer
            ));
            $data=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\PersonnePrevenirEmployer");
            if(count($data)>0){
                return $data[0];
            }else{
                return null;
            }
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

}