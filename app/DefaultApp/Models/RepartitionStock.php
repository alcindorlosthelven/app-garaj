<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 18/04/2018
 * Time: 09:24
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class RepartitionStock extends Model
{
    private $id;
    private $service;
    private $item;
    private $quantite;

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
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param mixed $item
     */
    public function setItem($item)
    {
        $this->item = $item;
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

    public function ajouter()
    {
        $con = self::connection();
        try {
            $req = "insert into repartition_stock (service, item, quantite) VALUES ('" . $this->service . "','" . $this->item . "','" . $this->quantite . "')";
            if ($con->query($req)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listerParItem($item)
    {
        $liste = array();
        $con = self::connection();
        $req = "select *from repartition_stock where item='" . $item . "'";
        $rs = $con->query($req);
        while ($d = $rs->fetch()) {
            $a = new RepartitionStock();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setService($d['service']);
            $a->setQuantite($d['quantite']);
            $liste[] = $a;
        }

        return $liste;
    }

    public function lister()
    {
        $liste = array();
        $con = self::connection();
        $req = "select *from repartition_stock";
        $rs = $con->query($req);
        while ($d = $rs->fetch()) {
            $a = new RepartitionStock();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setService($d['service']);
            $a->setQuantite($d['quantite']);
            $liste[] = $a;
        }

        return $liste;
    }

    public function listerMagasin()
    {
        $liste = array();
        $con = self::connection();
        $req = "select rs.id,rs.item,rs.service,rs.quantite from repartition_stock rs,stock s where rs.item=s.id and s.groupe != 'Medicament' ";
        $rs = $con->query($req);
        while ($d = $rs->fetch()) {
            $a = new RepartitionStock();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setService($d['service']);
            $a->setQuantite($d['quantite']);
            $liste[] = $a;
        }

        return $liste;
    }

    public function listerPharmacie()
    {
        $liste = array();
        $con = self::connection();
        $req = "select rs.id,rs.item,rs.service,rs.quantite from repartition_stock rs,stock s where rs.item=s.id and s.groupe = 'Medicament' ";
        $rs = $con->query($req);
        while ($d = $rs->fetch()) {
            $a = new RepartitionStock();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setService($d['service']);
            $a->setQuantite($d['quantite']);
            $liste[] = $a;
        }

        return $liste;
    }

    public static function total($item)
    {
        $liste = array();
        $con = self::connection();
        $req = "select sum(quantite) as 'total' from repartition_stock where item='" . $item . "'";
        $rs = $con->query($req);
        if ($d = $rs->fetch()) {
            return $d['total'];
        }

    }

    public static function quantiteActuel($service, $item)
    {
        $con = self::connection();
        $req = "select quantite from repartition_stock where service='" . $service . "' and item='" . $item . "'";
        $rs = $con->query($req);
        if ($data = $rs->fetch()) {
            return $data['quantite'];
        } else {
            $r = "insert into repartition_stock (service, item, quantite) VALUES ('" . $service . "','" . $item . "','0')";
            $con->query($r);
            return 0;
        }
    }

    public static function augementer($service, $item, $quantite, $user, $raison = "")
    {
        try {
            $qt = $quantite;
            $con = self::connection();
            $qta = self::quantiteActuel($service, $item);
            $quantite = self::quantiteActuel($service, $item) + $quantite;

            $req = "update repartition_stock set quantite='" . $quantite . "' where service='" . $service . "' and item='" . $item . "'";
            if ($con->query($req)) {
                $ets = new EntrerSortie();
                $ets->setItem($item);
                $ets->setNoTransaction("A-" . rand(10, 1000000));
                $ets->setTypeTransaction("Augementation Stock : $raison");
                $ets->setDate(date("Y-m-d h:i:s"));
                $ets->setLocation($service);
                $ets->setQuantite($qt);
                $ets->setQuantiteAvant($qta);
                $ets->setQuantiteApres($quantite);
                $ets->setUser($user);
                $ets->setRaison($raison);
                $ets->ajouter();
                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public static function dimimuer($service, $item, $quantite, $user, $raison = "", $destination = "")
    {
        try {
            $qt = "-" . $quantite;
            $con = self::connection();
            $qta = self::quantiteActuel($service, $item);

            $quantite = self::quantiteActuel($service, $item) - $quantite;

            if ($quantite < 0) {
                return "Stock Insufisant impossible de diminuer dans " . Service::nonService($service);
            }

            $req = "update repartition_stock set quantite='" . $quantite . "' where service='" . $service . "' and item='" . $item . "'";

            if ($con->query($req)) {
                $ets = new EntrerSortie();
                $ets->setItem($item);
                $ets->setNoTransaction("A-" . rand(10, 1000000));
                $ets->setTypeTransaction("Diminution Stock");
                $ets->setDate(date("Y-m-d h:i:s"));
                $ets->setLocation($service);
                $ets->setQuantite($qt);
                $ets->setQuantiteAvant($qta);
                $ets->setQuantiteApres($quantite);
                $ets->setUser($user);
                $ets->setDestination($destination);
                $ets->setRaison($raison);
                $ets->ajouter();

                $role = "cusg,pharmacien,magasinier";

                /*if ($quantite <= Stock::quantiteCritique($item)) {
                    $alert=new Alert();
                    $alert->setRole($role);
                    $alert->setStatut("non");
                    $alert->setDate(date("Y-m-d h:i:s"));
                    $alert->setMessage("Quantité critique pour Item du nom " . addslashes(Stock::nomItem($item)) . "");
                    $m = $alert->ajouter();
                }*/

                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function dimimuerBdc($service, $item, $quantite, $user, $raison = "", $destination = "")
    {
        try {
            $qt = "-" . $quantite;
            $con = self::connection();
            $qta = self::quantiteActuel($service, $item);

            $quantite = self::quantiteActuel($service, $item) - $quantite;

            $req = "update repartition_stock set quantite='" . $quantite . "' where service='" . $service . "' and item='" . $item . "'";

            if ($con->query($req)) {
                $ets = new EntrerSortie();
                $ets->setItem($item);
                $ets->setNoTransaction("A-" . rand(10, 1000000));
                $ets->setTypeTransaction("Diminution Stock");
                $ets->setDate(date("Y-m-d h:i:s"));
                $ets->setLocation($service);
                $ets->setQuantite($qt);
                $ets->setQuantiteAvant($qta);
                $ets->setQuantiteApres($quantite);
                $ets->setUser($user);
                $ets->setDestination($destination);
                $ets->setRaison($raison);
                $ets->ajouter();
                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function transfert($item, $quantite, $de, $a, $user, $raison = "", $destination = "")
    {
        $diminuer = self::dimimuer($de, $item, $quantite, $user, $raison, $destination);
        if ($diminuer == "ok") {
            $augementer = self::augementer($a, $item, $quantite, $user);
            if ($augementer == "ok") {
                return "ok";
            } else {
                return "no";
            }
        } else {
            echo $diminuer;
        }
    }

    public static function itemExisteService($service, $item)
    {
        $con = self::connection();
        $req = "select *from repartition_stock where service='" . $service . "' and item='" . $item . "'";
        $rs = $con->query($req);
        if ($rs->fetch()) {
            return true;
        } else {
            return false;
        }

    }

    public static function updateQuantite($service,$item,$quantite){
        try{
            $req="update repartition_stock set quantite=:qt WHERE service=:service and item=:item";
            $con=self::connection();
            $stmt=$con->prepare($req);
            if($stmt->execute(array(
               ":qt"=>$quantite,
               ":service"=>$service,
               ":item"=>$item
            ))){
                return "ok";
            }else{
                return "no";
            }
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

}