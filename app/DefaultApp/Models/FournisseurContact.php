<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 14/03/2019
 * Time: 13:54
 */


namespace app\DefaultApp\Models;

use systeme\Model\Model;


class FournisseurContact extends Model
{
    protected $table = "fournisseur_contact";
    private $id, $id_fournisseur, $nom, $poste, $telephone, $email;

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
    public function getIdFournisseur()
    {
        return $this->id_fournisseur;
    }

    /**
     * @param mixed $id_fournisseur
     */
    public function setIdFournisseur($id_fournisseur)
    {
        $this->id_fournisseur = $id_fournisseur;
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
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * @param mixed $poste
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function findAll($id_fournisseur = "")
    {
        try {
            if ($id_fournisseur == "") {
                return parent::findAll();
            }

            $con = self::connection();
            $req = "select *from fournisseur_contact WHERE id_fournisseur=:id_fournisseur";

            $stmt = $con->prepare($req);
            $stmt->execute(array(
                ":id_fournisseur" => $id_fournisseur
            ));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\DefaultApp\Models\FournisseurContact");
            return $res;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function supprimerParFournisseur($id_fournisseur){
        try{
            $con=self::connection();
            $req="delete from fournisseur_contact WHERE id_fournisseur='".$id_fournisseur."'";
            if($con->query($req)){
                return "ok";
            }else{
                return "no";
            }
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }





}