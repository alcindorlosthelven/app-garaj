<?php


namespace app\DefaultApp\Models;


use systeme\Model\Model;

class Achat extends Model
{
 private $id,$id_fournisseur,$date,$statut;

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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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

    public static function dernierId($id_fournisseur)
    {
        $con=self::connection();
        $req = "SELECT id FROM achat where id_fournisseur='{$id_fournisseur}' ORDER BY id DESC LIMIT 1";
        $rs = $con->query($req);
        $da = $rs->fetch();
        return $da['id'];
    }

    public static function existe($fournisseur, $date)
    {
        $con=self::connection();
        $req = "SELECT *FROM achat WHERE id_fournisseur='" . $fournisseur . "' AND date='" . $date. "' and statut='encour'";
        $rs = $con->query($req);
        if ($rs->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function rechercherParFournisseurNonFinaliser($fournisseur, $date)
    {
        $con=self::connection();
        $req = "SELECT *FROM achat WHERE id_fournisseur='" . $fournisseur . "' AND date='" . $date. "' and statut='encour'";
        $stmt=$con->prepare($req);
        $stmt->execute();
        $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Achat");
        if(count($res)>0){
            return $res[0];
        }else{
            return null;
        }
    }

    public static function listeNonFinaliser($fournisseur="")
    {
        $con=self::connection();
        if($fournisseur==""){
            $req = "SELECT *FROM achat WHERE statut='encour'";
        }else{
            $req = "SELECT *FROM achat WHERE statut='encour' and id_fournisseur='{$fournisseur}'";
        }
        $stmt=$con->prepare($req);
        $stmt->execute();
        $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Achat");
        return $res;
    }

    public static function listeFinaliser($fournisseur="")
    {
        $con=self::connection();
        if($fournisseur==""){
            $req = "SELECT *FROM achat WHERE statut='finaliser'";
        }else{
            $req = "SELECT *FROM achat WHERE statut='finaliser' and id_fournisseur='{$fournisseur}'";
        }
        $stmt=$con->prepare($req);
        $stmt->execute();
        $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Achat");
        return $res;
    }

    public static function all($fournisseur="")
    {
        $con=self::connection();
        if($fournisseur==""){
            $req = "SELECT *FROM achat WHERE";
        }else{
            $req = "SELECT *FROM achat WHERE id_fournisseur='{$fournisseur}'";
        }
        $stmt=$con->prepare($req);
        $stmt->execute();
        $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Achat");
        return $res;
    }
}