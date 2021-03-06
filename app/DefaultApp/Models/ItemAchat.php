<?php


namespace app\DefaultApp\Models;


use systeme\Model\Model;

class ItemAchat extends Model
{

    protected $table="item_achat";
    private $id,$id_achat,$id_produit,$quantite,$prix;

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
    public function getIdAchat()
    {
        return $this->id_achat;
    }

    /**
     * @param mixed $id_achat
     */
    public function setIdAchat($id_achat)
    {
        $this->id_achat = $id_achat;
    }

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->id_produit;
    }

    /**
     * @param mixed $id_produit
     */
    public function setIdProduit($id_produit)
    {
        $this->id_produit = $id_produit;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
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


    public function add()
    {
        if (!$this->existe($this->id_achat, $this->id_produit)) {
            return parent::add(); // TODO: Change the autogenerated stub
        }
        return "Article existe deja pour cette vente !!!";

    }

    private function existe($id_achat, $id_produit)
    {
        $con = self::connection();
        $req = "SELECT *FROM item_achat WHERE id_achat='" . $id_achat . "' AND id_produit='" . $id_produit . "'";
        $rs = $con->query($req);
        if ($rs->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function sousTotal($idachat)
    {
        $con = self::connection();
        $req = "SELECT SUM(item_achat.quantite * item_achat.prix) as stotal FROM item_achat WHERE id_achat='{$idachat}'";
        $rs = $con->query($req);
        $da = $rs->fetch();
        return $da['stotal'];
    }

    public static function listerParAchat($id_achat)
    {
        $con = self::connection();
        $req = "SELECT *FROM item_achat WHERE id_achat=:id_achat";
        $stmt = $con->prepare($req);
        $stmt->execute(array(
            ":id_achat" => $id_achat
        ));
        $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\DefaultApp\Models\ItemAchat");
        return $res;
    }

    public static function dernierId($id_achat)
    {
        $con=self::connection();
        $req = "SELECT id FROM item_achat where id_achat='{$id_achat}' ORDER BY id DESC LIMIT 1";
        $rs = $con->query($req);
        $da = $rs->fetch();
        return $da['id'];
    }

}