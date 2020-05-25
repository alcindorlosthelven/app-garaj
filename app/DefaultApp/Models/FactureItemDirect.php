<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 4/29/2020
 * Time: 4:48 PM
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class FactureItemDirect extends Model
{
    protected $table="facture_item_direct";
    private $id, $id_facture, $id_item, $item_nom_modifier, $categorie_item, $quantite, $prix, $id_bdc, $jour, $qt_ssu;
    private $qt_ssh, $qt_ssc, $couvert;

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
    public function getIdFacture()
    {
        return $this->id_facture;
    }

    /**
     * @param mixed $id_facture
     */
    public function setIdFacture($id_facture)
    {
        $this->id_facture = $id_facture;
    }

    /**
     * @return mixed
     */
    public function getIdItem()
    {
        return $this->id_item;
    }

    /**
     * @param mixed $id_item
     */
    public function setIdItem($id_item)
    {
        $this->id_item = $id_item;
    }

    /**
     * @return mixed
     */
    public function getItemNomModifier()
    {
        return $this->item_nom_modifier;
    }

    /**
     * @param mixed $item_nom_modifier
     */
    public function setItemNomModifier($item_nom_modifier)
    {
        $this->item_nom_modifier = $item_nom_modifier;
    }

    /**
     * @return mixed
     */
    public function getCategorieItem()
    {
        return $this->categorie_item;
    }

    /**
     * @param mixed $categorie_item
     */
    public function setCategorieItem($categorie_item)
    {
        $this->categorie_item = $categorie_item;
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

    /**
     * @return mixed
     */
    public function getIdBdc()
    {
        return $this->id_bdc;
    }

    /**
     * @param mixed $id_bdc
     */
    public function setIdBdc($id_bdc)
    {
        $this->id_bdc = $id_bdc;
    }

    /**
     * @return mixed
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     * @return mixed
     */
    public function getQtSsu()
    {
        return $this->qt_ssu;
    }

    /**
     * @param mixed $qt_ssu
     */
    public function setQtSsu($qt_ssu)
    {
        $this->qt_ssu = $qt_ssu;
    }

    /**
     * @return mixed
     */
    public function getQtSsh()
    {
        return $this->qt_ssh;
    }

    /**
     * @param mixed $qt_ssh
     */
    public function setQtSsh($qt_ssh)
    {
        $this->qt_ssh = $qt_ssh;
    }

    /**
     * @return mixed
     */
    public function getQtSsc()
    {
        return $this->qt_ssc;
    }

    /**
     * @param mixed $qt_ssc
     */
    public function setQtSsc($qt_ssc)
    {
        $this->qt_ssc = $qt_ssc;
    }

    /**
     * @return mixed
     */
    public function getCouvert()
    {
        return $this->couvert;
    }

    /**
     * @param mixed $couvert
     */
    public function setCouvert($couvert)
    {
        $this->couvert = $couvert;
    }
}