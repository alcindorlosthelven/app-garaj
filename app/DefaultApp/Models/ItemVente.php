<?php


namespace app\DefaultApp\Models;


use systeme\Model\Model;

class ItemVente extends Model
{

    protected $table = "item_vente";
    private $id, $id_vente, $id_produit, $quantite, $prix;

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
    public function getIdVente()
    {
        return $this->id_vente;
    }

    /**
     * @param mixed $id_vente
     */
    public function setIdVente($id_vente)
    {
        $this->id_vente = $id_vente;
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

    public function add()
    {
        if (!$this->existe($this->id_vente, $this->id_produit)) {
            return parent::add(); // TODO: Change the autogenerated stub
        }
        return "Article existe deja pour cette vente !!!";

    }

    private function existe($id_vente, $id_produit)
    {
        $con = self::connection();
        $req = "SELECT *FROM item_vente WHERE id_vente='" . $id_vente . "' AND id_produit='" . $id_produit . "'";
        $rs = $con->query($req);
        if ($rs->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function sousTotal($idvente)
    {
        $con = self::connection();
        $req = "SELECT SUM(item_vente.quantite * item_vente.prix) as stotal FROM item_vente WHERE id_vente='{$idvente}'";
        $rs = $con->query($req);
        $da = $rs->fetch();
        return $da['stotal'];
    }

    public static function listerParVente($id_vente)
    {
        $con = self::connection();
        $req = "SELECT *FROM item_vente WHERE id_vente=:id_vente";
        $stmt = $con->prepare($req);
        $stmt->execute(array(
            ":id_vente" => $id_vente
        ));
        $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\DefaultApp\Models\ItemVente");
        return $res;
    }

    public static function dernierId($id_vente)
    {
        $con=self::connection();
        $req = "SELECT id FROM item_vente where id_vente='{$id_vente}' ORDER BY id DESC LIMIT 1";
        $rs = $con->query($req);
        $da = $rs->fetch();
        return $da['id'];
    }

}