<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 4/29/2020
 * Time: 4:44 PM
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class Facture extends Model
{

    protected $table="facture";
    private $id,$id_admision,$no,$categorie_prix,$statut,$total_facture,$deduction,$total_patient,$total_assurance;
    private $balance,$date_enregistrement,$date_modification;
    private $tag;

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
    public function getIdAdmision()
    {
        return $this->id_admision;
    }

    /**
     * @param mixed $id_admision
     */
    public function setIdAdmision($id_admision)
    {
        $this->id_admision = $id_admision;
    }

    /**
     * @return mixed
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * @param mixed $no
     */
    public function setNo($no)
    {
        $this->no = $no;
    }

    /**
     * @return mixed
     */
    public function getCategoriePrix()
    {
        return $this->categorie_prix;
    }

    /**
     * @param mixed $categorie_prix
     */
    public function setCategoriePrix($categorie_prix)
    {
        $this->categorie_prix = $categorie_prix;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getTotalFacture()
    {
        return $this->total_facture;
    }

    /**
     * @param mixed $total_facture
     */
    public function setTotalFacture($total_facture)
    {
        $this->total_facture = $total_facture;
    }

    /**
     * @return mixed
     */
    public function getDeduction()
    {
        return $this->deduction;
    }

    /**
     * @param mixed $deduction
     */
    public function setDeduction($deduction)
    {
        $this->deduction = $deduction;
    }

    /**
     * @return mixed
     */
    public function getTotalPatient()
    {
        return $this->total_patient;
    }

    /**
     * @param mixed $total_patient
     */
    public function setTotalPatient($total_patient)
    {
        $this->total_patient = $total_patient;
    }

    /**
     * @return mixed
     */
    public function getTotalAssurance()
    {
        return $this->total_assurance;
    }

    /**
     * @param mixed $total_assurance
     */
    public function setTotalAssurance($total_assurance)
    {
        $this->total_assurance = $total_assurance;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getDateEnregistrement()
    {
        return $this->date_enregistrement;
    }

    /**
     * @param mixed $date_enregistrement
     */
    public function setDateEnregistrement($date_enregistrement)
    {
        $this->date_enregistrement = $date_enregistrement;
    }

    /**
     * @return mixed
     */
    public function getDateModification()
    {
        return $this->date_modification;
    }

    /**
     * @param mixed $date_modification
     */
    public function setDateModification($date_modification)
    {
        $this->date_modification = $date_modification;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public static function dernierId()
    {
        try {
            $con = self::connection();
            $req = "SELECT id FROM facture ORDER BY id DESC LIMIT 1";
            $res = $con->query($req);
            $data = $res->fetch();
            return $data['id'];
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function rechercherParAdmision($id_admision)
    {
        try {
            $con = self::connection();
            $req = "select *from facture WHERE id_admision=:id_admision";
            $stmt = $con->prepare($req);
            $stmt->execute(array(
                ":id_admision"=>$id_admision
            ));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Facture");
            if(count($res)>0){
                return $res[0];
            }
            return null;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }


}