<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 17/04/2018
 * Time: 12:27
 */

namespace app\DefaultApp\Models;
use Exception;
use systeme\Model\Model;

class Stock extends Model
{
    private $id;
    private $code;
    private $groupe;
    private $nom;
    private $nom_alternatif;
    private $description;
    private $entrer_par;
    private $quantite_par_type;
    private $retirer_par;
    private $total_type;
    private $total_unite;
    private $prix;
    private $cout;
    private $quantite_maximale;
    private $quantite_critique;
    private $user;

    private $actif;
    private $type;
    private $date_expiration;


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDateExpiration()
    {
        return $this->date_expiration;
    }

    /**
     * @param mixed $date_expiration
     */
    public function setDateExpiration($date_expiration)
    {
        $this->date_expiration = $date_expiration;
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
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * @param mixed $cout
     */
    public function setCout($cout)
    {
        $this->cout = $cout;
    }


    /**
     * @return mixed
     */
    public function getBdc()
    {
        return stripslashes($this->bdc);
    }

    /**
     * @param mixed $bdc
     */
    public function setBdc($bdc)
    {
        $this->bdc = $bdc;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getGroupe()
    {
        return stripslashes($this->groupe);
    }

    /**
     * @param mixed $groupe
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return stripslashes($this->nom);
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
    public function getNomAlternatif()
    {
        return stripslashes($this->nom_alternatif);
    }

    /**
     * @param mixed $nom_alternatif
     */
    public function setNomAlternatif($nom_alternatif)
    {
        $this->nom_alternatif = $nom_alternatif;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return stripslashes($this->description);
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return mixed
     */
    public function getEntrerPar()
    {
        return stripslashes($this->entrer_par);
    }

    /**
     * @param mixed $entrer_par
     */
    public function setEntrerPar($entrer_par)
    {
        $this->entrer_par = $entrer_par;
    }

    /**
     * @return mixed
     */
    public function getQuantiteParType()
    {
        return stripslashes($this->quantite_par_type);
    }

    /**
     * @param mixed $quantite_par_type
     */
    public function setQuantiteParType($quantite_par_type)
    {
        $this->quantite_par_type = $quantite_par_type;
    }

    /**
     * @return mixed
     */
    public function getRetirerPar()
    {
        return stripslashes($this->retirer_par);
    }

    /**
     * @param mixed $retirer_par
     */
    public function setRetirerPar($retirer_par)
    {
        $this->retirer_par = $retirer_par;
    }

    /**
     * @return mixed
     */
    public function getTotalType()
    {
        return $this->total_type;
    }

    /**
     * @param mixed $total_type
     */
    public function setTotalType($total_type)
    {
        $this->total_type = $total_type;
    }

    /**
     * @return mixed
     */
    public function getTotalUnite()
    {
        return $this->total_unite;
    }

    /**
     * @param mixed $total_unite
     */
    public function setTotalUnite($total_unite)
    {
        $this->total_unite = $total_unite;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getQuantiteMaximale()
    {
        return $this->quantite_maximale;
    }

    /**
     * @param mixed $quantite_maximale
     */
    public function setQuantiteMaximale($quantite_maximale)
    {
        $this->quantite_maximale = $quantite_maximale;
    }

    /**
     * @return mixed
     */
    public function getQuantiteCritique()
    {
        return $this->quantite_critique;
    }

    /**
     * @param mixed $quantite_critique
     */
    public function setQuantiteCritique($quantite_critique)
    {
        $this->quantite_critique = $quantite_critique;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    public function itemExiste($groupe, $size, $nom)
    {
        $con=self::connection();
        try {
            $req = "SELECT *FROM stock WHERE groupe='" . $groupe . "' AND size='" . $size . "' AND nom='" . $nom . "'";
            $rs = $con->query($req);
            if ($d = $rs->fetch()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function ajouter()
    {
        $con=self::connection();
        try {
            $req = "INSERT INTO stock (code, nom, nom_alternatif, description, size, marque, quantite_maximal, quantite_critique, groupe, user, quantite_par_type, 
               classe, dosage, forme, entrer_par, retirer_par, total_type, total_unite, prix,cout,type,date_expiration)
              VALUES ('" . $this->code . "','" . $this->nom . "','" . $this->nom_alternatif . "','" . $this->description . "','" . $this->size . "','" . $this->marque . "'
              ,'" . $this->quantite_maximale . "','" . $this->quantite_critique . "','" . $this->groupe . "','" . $this->user . "','" . $this->quantite_par_type . "'
              ,'" . $this->classe . "','" . $this->dosage . "','" . $this->forme . "','" . $this->entrer_par . "','" . $this->retirer_par . "','" . $this->total_type . "','" . $this->total_unite . "','" . $this->prix . "','" . $this->cout . "','" . $this->type . "','" . $this->date_expiration . "')";

            if ($this->itemExiste($this->groupe, $this->size, $this->nom)) {
                return "Item Existe sur le systeme";
            } else {
                if ($con->query($req)) {
                    return "ok";
                } else {
                    return "no";
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function modifier()
    {
        $con=self::connection();
        try {
            $req = " UPDATE stock SET groupe='" . $this->groupe . "', nom='" . $this->nom . "', nom_alternatif='" . $this->nom_alternatif . "', description='" . $this->description . "',classe='" . $this->classe . "',
              forme='" . $this->forme . "',dosage='" . $this->dosage . "',size='" . $this->size . "',
             quantite_maximal='" . $this->quantite_maximale . "', quantite_critique='" . $this->quantite_critique . "',prix='" . $this->prix . "', cout='" . $this->cout . "',date_expiration='" . $this->date_expiration . "',type='" . $this->type . "'
             WHERE id='" . $this->id . "'";

            if ($con->query($req)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function rechercher($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT *FROM stock WHERE id='" . $id . "' OR code='" . $id . "'";
            $rs = $con->query($req);
            if ($d = $rs->fetch()) {
                $s = new Stock();
                $s->setDateExpiration($d['date_expiration']);
                $s->setType($d['type']);
                $s->setId($d['id']);
                $s->setCode($d['code']);
                $s->setGroupe($d['groupe']);
                $s->setNom($d['nom']);
                $s->setNomAlternatif($d['nom_alternatif']);
                $s->setDescription($d['description']);
                $s->setQuantiteMaximale($d['quantite_maximale']);
                $s->setQuantiteCritique($d['quantite_critique']);
                $s->setEntrerPar($d['entrer_par']);
                $s->setRetirerPar($d['retirer_par']);
                $s->setTotalType($d['total_type']);
                $s->setTotalUnite($d['total_unite']);
                $s->setQuantiteParType($d['quantite_par_type']);
                $s->setPrix($d['prix']);
                $s->setCout($d['cout']);
                $s->setUser($d['user']);
                $s->setActif($d['actif']);
                return $s;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function lister($groupe = "")
    {
        $con=self::connection();
        $resultat = array();
        try {

            if ($groupe == "") {
                $req = "SELECT *FROM stock WHERE actif='oui' AND groupe <> 'service' ";
            } else {

                if ($groupe == "Medicament") {
                    $req = "SELECT *FROM stock WHERE (groupe='" . $groupe . "' OR categorie = 'service') AND actif='oui' ";
                } else {
                    $req = "SELECT *FROM stock WHERE groupe != 'Medicament' AND actif='oui' AND groupe <> 'service' ";
                }
            }

            $rs = $con->query($req);
            while ($d = $rs->fetch()) {
                $s = new Stock();
                $s->setId($d['id']);
                $s->setDateExpiration($d['date_expiration']);
                $s->setType($d['type']);
                $s->setCode($d['code']);
                $s->setGroupe($d['groupe']);
                $s->setNom($d['nom']);
                $s->setNomAlternatif($d['nom_alternatif']);
                $s->setDescription($d['description']);
                $s->setSize($d['size']);
                $s->setMarque($d['marque']);
                $s->setQuantiteMaximale($d['quantite_maximal']);
                $s->setQuantiteCritique($d['quantite_critique']);
                $s->setEntrerPar($d['entrer_par']);
                $s->setRetirerPar($d['retirer_par']);
                $s->setTotalType($d['total_type']);
                $s->setTotalUnite($d['total_unite']);
                $s->setQuantiteParType($d['quantite_par_type']);
                $s->setClasse($d['classe']);
                $s->setForme($d['forme']);
                $s->setDosage($d['dosage']);
                $s->setPrix($d['prix']);
                $s->setBdc($d['bon_de_charge']);
                $s->setCout($d['cout']);
                $s->setUser($d['user']);
                $s->setActif($d['actif']);
                $s->setBdcSsc($d['bdc_ssc']);
                $s->setBdcSsh($d['bdc_ssh']);
                $s->setBdcSsu($d['bdc_ssu']);
                $resultat[] = $s;
            }
            return $resultat;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listerInnactif($groupe = "")
    {
        $con=self::connection();
        $resultat = array();
        try {

            if ($groupe == "") {
                $req = "SELECT *FROM stock WHERE actif='non'";
            } else {

                if ($groupe == "Medicament") {
                    $req = "SELECT *FROM stock WHERE (groupe='" . $groupe . "' OR categorie = 'service') AND actif='non' ";
                } else {
                    $req = "SELECT *FROM stock WHERE groupe != 'Medicament' AND actif='non'";
                }
            }

            $rs = $con->query($req);
            while ($d = $rs->fetch()) {
                $s = new Stock();
                $s->setId($d['id']);
                $s->setCode($d['code']);
                $s->setDateExpiration($d['date_expiration']);
                $s->setType($d['type']);
                $s->setGroupe($d['groupe']);
                $s->setNom($d['nom']);
                $s->setNomAlternatif($d['nom_alternatif']);
                $s->setDescription($d['description']);
                $s->setSize($d['size']);
                $s->setMarque($d['marque']);
                $s->setQuantiteMaximale($d['quantite_maximal']);
                $s->setQuantiteCritique($d['quantite_critique']);
                $s->setEntrerPar($d['entrer_par']);
                $s->setRetirerPar($d['retirer_par']);
                $s->setTotalType($d['total_type']);
                $s->setTotalUnite($d['total_unite']);
                $s->setQuantiteParType($d['quantite_par_type']);
                $s->setClasse($d['classe']);
                $s->setForme($d['forme']);
                $s->setDosage($d['dosage']);
                $s->setPrix($d['prix']);
                $s->setBdc($d['bon_de_charge']);
                $s->setCout($d['cout']);
                $s->setUser($d['user']);
                $s->setActif($d['actif']);
                $s->setBdcSsc($d['bdc_ssc']);
                $s->setBdcSsh($d['bdc_ssh']);
                $s->setBdcSsu($d['bdc_ssu']);
                $resultat[] = $s;
            }
            return $resultat;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /*public function listerParService($service)
    {
        $con=self::connection();
        $resultat = array();
        try {
            $req = "SELECT  stock.type,stock.cout,stock.user,stock.date_expiration, stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque,stock.bon_de_charge,
            repartition_stock.quantite,stock.bdc_ssc,stock.bdc_ssh,stock.bdc_ssu
            FROM stock,repartition_stock WHERE stock.id=repartition_stock.item AND repartition_stock.service='" . $service . "' AND stock.actif='oui'";

            echo $req;
            $rs = $con->query($req);
            while ($d = $rs->fetch()) {
                $s = new Stock();
                $s->setId($d['id']);
                $s->setDateExpiration($d['date_expiration']);
                $s->setType($d['type']);
                $s->setCode($d['code']);
                $s->setGroupe($d['groupe']);
                $s->setNom($d['nom']);
                $s->setNomAlternatif($d['nom_alternatif']);
                $s->setDescription($d['description']);
                $s->setSize($d['size']);
                $s->setMarque($d['marque']);
                $s->setTotalUnite($d['quantite']);
                $s->setBdc($d['bon_de_charge']);
                $s->setCout($d['cout']);
                $s->setUser($d['user']);
                $s->setActif($d['actif']);
                $s->setBdcSsc($d['bdc_ssc']);
                $s->setBdcSsh($d['bdc_ssh']);
                $s->setBdcSsu($d['bdc_ssu']);
                $resultat[] = $s;
            }
            return $resultat;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }*/

    public function dernierId()
    {
        $con=self::connection();
        try {
            $req = "SELECT id FROM stock ORDER BY id DESC LIMIT 1";
            $rs = $con->query($req);
            $data = $rs->fetch();
            $con = null;
            return $data['id'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function nomItem($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT nom FROM stock WHERE id='" . $id . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            $con = null;
            return $data['nom'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function sizeItem($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT size FROM stock WHERE id='" . $id . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            $con = null;
            return $data['size'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function groupeItem($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT groupe FROM stock WHERE id='" . $id . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            $con = null;
            return $data['groupe'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function descriptionItem($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT description FROM stock WHERE id='" . $id . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            $con = null;
            return $data['description'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function idItem($nom)
    {
        $con=self::connection();
        try {
            $req = "SELECT id FROM stock WHERE nom='" . $nom . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            return $data['id'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function retirerPar($item)
    {
        $con=self::connection();
        $req = "SELECT retirer_par FROM stock WHERE id='" . $item . "'";
        $rs = $con->query($req);
        $d = $rs->fetch();
        return $d['retirer_par'];
    }

    public static function entrerPar($item)
    {
        $con=self::connection();
        $req = "SELECT entrer_par FROM stock WHERE id='" . $item . "'";
        $rs = $con->query($req);
        $d = $rs->fetch();
        return $d['entrer_par'];
    }

    public static function quantiteParType($item)
    {
        $con=self::connection();
        $req = "SELECT quantite_par_type FROM stock WHERE id='" . $item . "'";
        $rs = $con->query($req);
        $d = $rs->fetch();
        return $d['quantite_par_type'];
    }

    public static function updateStock($item)
    {
        try {
            $total = RepartitionStock::total($item);
            $retirer_par = self::retirerPar($item);
            $entrer_par = self::entrerPar($item);

            if ($retirer_par == "unite" and $entrer_par == "unite") {
                $total_type = $total;
                $total_unite = $total;
            } else {
                $qtParType = self::quantiteParType($item);
                $total_type = $total / $qtParType;
                $total_unite = $total;
            }

            $req = "UPDATE stock SET total_type='" . $total_type . "',total_unite='" . $total_unite . "' WHERE id='" . $item . "'";
            $con=self::connection();
            if ($con->query($req)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function statut($item, $statut)
    {
        $con=self::connection();
        $req = "UPDATE stock SET actif='" . $statut . "' WHERE id='" . $item . "'";
        $con->query($req);
    }

    public static function prixItem($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT prix FROM stock WHERE id='" . $id . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            return $data['prix'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function quantiteMax($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT quantite_maximal FROM stock WHERE id='" . $id . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            return $data['quantite_maximal'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function quantiteCritique($id)
    {
        $con=self::connection();
        try {
            $req = "SELECT quantite_critique FROM stock WHERE id='" . $id . "'";
            $rs = $con->query($req);
            $data = $rs->fetch();
            return $data['quantite_critique'];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //pour bon de charge
    public function listerParServiceGroupe($service, $groupe = "", $bdc = "")
    {
        $con=self::connection();
        $resultat = array();
        try {
            if ($groupe == "") {
                $req = "SELECT stock.date_expiration,stock.type,stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque,
            repartition_stock.quantite,stock.actif,stock.bdc_ssu,stock.bdc_ssh,stock.bdc_ssc
            FROM stock,repartition_stock WHERE stock.id=repartition_stock.item AND repartition_stock.service='" . $service . "' AND stock.actif='oui'
            ";
            } else {
                if ($bdc == "") {
                    if ($groupe == "Medicament") {
                        $req = "SELECT  stock.date_expiration,stock.type,stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque,
            repartition_stock.quantite,stock.bdc_ssu,stock.bdc_ssh,stock.bdc_ssc
            FROM stock,repartition_stock WHERE  stock.groupe='" . $groupe . "' AND stock.id=repartition_stock.item AND repartition_stock.service='" . $service . "'  AND stock.actif='oui'
            ";
                    } else if ($groupe == "service") {
                        $req = "SELECT  stock.date_expiration,stock.type,stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque
                     ,stock.bdc_ssu,stock.bdc_ssh,stock.bdc_ssc FROM stock WHERE  stock.groupe='" . $groupe . "' AND stock.actif='oui'";
                    } else {
                        $req = "SELECT  stock.date_expiration,stock.type,stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque,
            repartition_stock.quantite,stock.bdc_ssu,stock.bdc_ssh,stock.bdc_ssc
            FROM stock,repartition_stock WHERE  stock.groupe != 'Medicament' AND stock.id=repartition_stock.item AND repartition_stock.service='" . $service . "' AND stock.actif='oui' 
            ";
                    }
                } else {
                    $ser=new Service();
                    $ser=$ser->findById($service);
                    $a="";
                    if($ser->getSigle()=="SSU"){
                        $a="bdc_ssu='oui'";
                    }

                    if($ser->getSigle()=="SSH"){
                        $a="bdc_ssh='oui'";
                    }

                    if($ser->getSigle()=="SSC"){
                        $a="bdc_ssc='oui'";
                    }


                    if ($groupe == "Medicament") {
                        $req = "SELECT  stock.date_expiration,stock.type,stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque,
            repartition_stock.quantite,stock.bdc_ssu,stock.bdc_ssh,stock.bdc_ssc
            FROM stock,repartition_stock WHERE stock.bon_de_charge='" . $bdc . "' and $a  AND stock.groupe='" . $groupe . "' AND stock.id=repartition_stock.item AND repartition_stock.service='" . $service . "'  AND stock.actif='oui'
            ";
                    } else if ($groupe == "service") {
                        $req = "SELECT stock.date_expiration,stock.type, stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque
                     ,stock.bdc_ssu,stock.bdc_ssh,stock.bdc_ssc FROM stock WHERE stock.bon_de_charge='" . $bdc . "' and $a AND  stock.groupe='" . $groupe . "' AND stock.actif='oui'";
                    } else {
                        $req = "SELECT stock.date_expiration,stock.type,stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,stock.size,stock.marque,
            repartition_stock.quantite,stock.bdc_ssu,stock.bdc_ssh,stock.bdc_ssc
            FROM stock,repartition_stock WHERE stock.bon_de_charge='" . $bdc . "' and $a AND stock.groupe != 'Medicament' AND stock.id=repartition_stock.item AND repartition_stock.service='" . $service . "' AND stock.actif='oui' 
            ";
                    }
                }

            }

            $rs = $con->query($req);
            while ($d = $rs->fetch()) {
                $s = new Stock();
                $s->setId($d['id']);
                $s->setDateExpiration($d['date_expiration']);
                $s->setType($d['type']);
                $s->setCode($d['code']);
                $s->setGroupe($d['groupe']);
                $s->setNom($d['nom']);
                $s->setNomAlternatif($d['nom_alternatif']);
                $s->setDescription($d['description']);
                $s->setSize($d['size']);
                $s->setMarque($d['marque']);
                $s->setActif($d['actif']);
                if (isset($d['quantite'])) {
                    $s->setTotalUnite($d['quantite']);
                }
                $s->setBdcSsc($d['bdc_ssc']);
                $s->setBdcSsh($d['bdc_ssh']);
                $s->setBdcSsu($d['bdc_ssu']);
                $resultat[] = $s;
            }
            return $resultat;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listerParService($service)
    {

        $con=self::connection();
        $req = "SELECT stock.date_expiration,stock.type,stock.actif, stock.id,stock.code,stock.groupe,stock.nom,stock.nom_alternatif,stock.description,repartition_stock.quantite,stock.actif
            FROM stock,repartition_stock WHERE stock.id=repartition_stock.item AND repartition_stock.service='" . $service . "' AND stock.actif='oui'
            ";
        $stmt = $con->prepare($req);
        $stmt->execute();
        $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\DefaultApp\Models\Stock");
        return $res;

    }

    public function rechercherParNom($nom)
    {

        $con=self::connection();
        $req = "select *from stock where nom=:nom";
        $stmt = $con->prepare($req);
        $stmt->execute(array(":nom"=>$nom));
        $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\DefaultApp\Models\Stock");
        if(count($res)>0){
            return $res[0];
        }else{
            return null;
        }
    }

    public static function updateCategorie($nouveauCategorie, $ancienCategorie)
    {
        $con=self::connection();
        $req = "UPDATE stock SET categorie='" . $nouveauCategorie . "' WHERE categorie='" . $ancienCategorie . "'";
        if ($con->query($req)) {
            return "ok";
        } else {
            return "no";
        }
    }

}
