<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 26/03/2018
 * Time: 12:23
 */

namespace app\DefaultApp\Models;
use systeme\Model\Model;
class Employer extends Model
{
    protected $table="employer";
    private $id;
    private $nom;
    private $prenom;
    private $sexe;
    private $date_naissance;
    private $nif;
    private $cin;
    private $adresse;
    private $telephone;
    private $email;
    private $religion;
    private $statut_matrimonial;
    private $date_entrer_en_travail;
    private $poste;
    private $service;
    private $type_contrat;
    private $identifiant;
    private $role;
    private $password;
    private $actif;
    private $pinactif;
    private $date_inactif;
    private $user_inactif;
    private $photo;

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }



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
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * @param mixed $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    /**
     * @return mixed
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param mixed $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
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

    /**
     * @return mixed
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @param mixed $religion
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;
    }

    /**
     * @return mixed
     */
    public function getStatutMatrimonial()
    {
        return $this->statut_matrimonial;
    }

    /**
     * @param mixed $statut_matrimonial
     */
    public function setStatutMatrimonial($statut_matrimonial)
    {
        $this->statut_matrimonial = $statut_matrimonial;
    }

    /**
     * @return mixed
     */
    public function getDateEntrerEnTravail()
    {
        return $this->date_entrer_en_travail;
    }

    /**
     * @param mixed $date_entrer_en_travail
     */
    public function setDateEntrerEnTravail($date_entrer_en_travail)
    {
        $this->date_entrer_en_travail = $date_entrer_en_travail;
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
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getTypeContrat()
    {
        return $this->type_contrat;
    }

    /**
     * @param mixed $type_contrat
     */
    public function setTypeContrat($type_contrat)
    {
        $this->type_contrat = $type_contrat;
    }

    /**
     * @return mixed
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * @param mixed $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getPinactif()
    {
        return $this->pinactif;
    }

    /**
     * @param mixed $pinactif
     */
    public function setPinactif($pinactif)
    {
        $this->pinactif = $pinactif;
    }


    /**
     * @return mixed
     */
    public function getDateInactif()
    {
        return $this->date_inactif;
    }

    /**
     * @param mixed $date_inactif
     */
    public function setDateInactif($date_inactif)
    {
        $this->date_inactif = $date_inactif;
    }

    /**
     * @return mixed
     */
    public function getUserInactif()
    {
        return $this->user_inactif;
    }

    /**
     * @param mixed $user_inactif
     */
    public function setUserInactif($user_inactif)
    {
        $this->user_inactif = $user_inactif;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }




    private function employerExiste($nom, $prenom, $cin, $nif)
    {
        $con=self::connection();
        $req = "SELECT *FROM employer WHERE nom='" . $nom . "' AND prenom='" . $prenom . "' AND (cin='" . $cin . "' OR nif='" . $nif . "')";
        $rs = $con->query($req);
        if ($rs->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function add()
    {
        if($this->employerExiste($this->nom,$this->prenom,$this->cin,$this->nif)){
            return "employer existe";
        }
        return parent::add(); // TODO: Change the autogenerated stub
    }

    public static function activer($id)
    {
        $con=self::connection();
        $req = "UPDATE employer SET actif='oui',pinactif='' WHERE id='" . $id . "'";
        $con->query($req);
    }

    public static function desactiver($id, $raison)
    {
        $date=date("d-m-Y");
        $user="1";
        $con=self::connection();
        $req = "UPDATE employer SET actif='non',pinactif='" . $raison . "',date_inactif='".$date."',user_inactif='".$user."' WHERE id='" . $id . "'";
        $con->query($req);
    }

    public function modifierPassword($id, $password)
    {
        $password = sha1($password);
        $con=self::connection();
        $req = "UPDATE employer SET password='" . $password . "'  WHERE id='" . $id . "'";
        if ($con->query($req)) {
            return true;
        } else {
            return false;
        }
    }

    public static function dernierId()
    {
        $con=self::connection();
        $req = "SELECT id FROM employer ORDER BY id DESC LIMIT 1";
        $rs = $con->query($req);
        $da = $rs->fetch();
        return $da['id'];
    }

    public static function id_utilisateur($ref){
        try{
            $con=self::connection();
            $req="select id from utilisateur WHERE ref='".$ref."'";
            $rs=$con->query($req);
            $data=$rs->fetch();
            return $data['id'];
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

}