<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 25/08/2019
 * Time: 15:43
 */

namespace app\DefaultApp\Models;


use systeme\Application\Application;
use systeme\Model\Model;

class Configuration extends Model
{
    private $id, $nom, $valeur, $categorie;

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
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * @param mixed $valeur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

   public static function getValueOfConfiguraton($nom)
    {
        try {

            $con = self::connection();
            $req = "SELECT *FROM configuration WHERE nom=:nom";
            $stmt = $con->prepare($req);
            $stmt->execute(array(
                ":nom" => $nom
            ));
            $data = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Configuration");
            if (count($data) > 0) {
                return $data[0]->getValeur();
            } else {
                return "";
            }

        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getTextType()
    {
        $type = self::getValueOfConfiguraton("type");
        $txtEl = "Elèves";
        if ($type == "ecole") {
            $txtEl = "Elèves";
        } elseif ($type == "universite") {
            $txtEl = "Étudiants";
        } else {
            $txtEl = "Elèves";
        }
        return $txtEl;
    }

    public static function listeModuleActif()
    {
        $con = self::connection();
        $req = "SELECT module FROM module WHERE actif='oui'";
        $stmt = $con->prepare($req);
        $stmt->execute(array());
        $resultat = array();
        $data = $stmt->fetchAll();
        foreach ($data as $d) {
            $resultat[] = $d[0];
        }
        return $resultat;
    }

    public static function moduleExiste($module)
    {
        /*if(Utilisateur::role()=="super_admin"){
            return true;
        }*/
        $listeModule=self::listeModuleActif();
        if (isset($_SESSION['module'])) {

            if(count($_SESSION['module'])!=count($listeModule)){
                $_SESSION['module']=$listeModule;
            }

            if (in_array(strtolower($module), $_SESSION['module'])) {
                return true;
            } else {
                return false;
            }

        } else {
            $_SESSION['module']=$listeModule;
            if (in_array(strtolower($module), $_SESSION['module'])) {
                return true;
            } else {
                return false;
            }
        }
    }


}