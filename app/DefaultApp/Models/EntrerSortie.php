<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 17/04/2018
 * Time: 13:59
 */
namespace app\DefaultApp\Models;
use systeme\Model\Model;

class EntrerSortie extends Model
{

   private $id;
   private $item;
   private $no_transaction;
   private $type_transaction;
   private $date;
   private $location;
   private $quantite_avant;
   private $quantite;
   private $quantite_apres;
   private $raison;
   private $destination;
   private $user;

    /**
     * @return mixed
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * @param mixed $raison
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
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
    public function getNoTransaction()
    {
        return $this->no_transaction;
    }

    /**
     * @param mixed $no_transaction
     */
    public function setNoTransaction($no_transaction)
    {
        $this->no_transaction = $no_transaction;
    }

    /**
     * @return mixed
     */
    public function getTypeTransaction()
    {
        return $this->type_transaction;
    }

    /**
     * @param mixed $type_transaction
     */
    public function setTypeTransaction($type_transaction)
    {
        $this->type_transaction = $type_transaction;
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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getQuantiteAvant()
    {
        return $this->quantite_avant;
    }

    /**
     * @param mixed $quantite_avant
     */
    public function setQuantiteAvant($quantite_avant)
    {
        $this->quantite_avant = $quantite_avant;
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
    public function getQuantiteApres()
    {
        return $this->quantite_apres;
    }

    /**
     * @param mixed $quantite_apres
     */
    public function setQuantiteApres($quantite_apres)
    {
        $this->quantite_apres = $quantite_apres;
    }



    public function ajouter(){
       $con=self::connection();
        try{
           $req="insert into entrer_sortie (item, quantite, date, no_transaction, type_transaction, location, quantite_avant, quantite_apres,raison,destination,user) VALUES 
            ('".$this->item."','".$this->quantite."','".$this->date."','".$this->no_transaction."','".$this->type_transaction."','".$this->location."','".$this->quantite_avant."','".$this->quantite_apres."'
            ,'".$this->raison."','".$this->destination."','".$this->user."') ";

              if($con->query($req)){
                return "ok";
            }else{
                return "no";
            }
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }

    public function listerParItem($item,$location=""){
        $liste=array();
        $con=self::connection();
        if($location==""){
            $req="select *from entrer_sortie where item='".$item."' order by id desc ";
        }else{
            $location=Service::idService($location);
            $req="select *from entrer_sortie where item='".$item."' and location='".$location."' order by id desc ";
        }

        $rs=$con->query($req);
        while ($d=$rs->fetch()){
            $a=new EntrerSortie();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setQuantite($d['quantite']);
            $a->setDate($d['date']);
            $a->setNoTransaction($d['no_transaction']);
            $a->setTypeTransaction($d['type_transaction']);
            $a->setLocation($d['location']);
            $a->setQuantiteAvant($d['quantite_avant']);
            $a->setQuantiteApres($d['quantite_apres']);
            $a->setRaison($d['raison']);
            $a->setDestination($d['destination']);
            $a->setUser($d['user']);
            $liste[]=$a;
        }

        return $liste;
    }

    public function lister($location=""){
        $liste=array();
        $con=self::connection();
        if($location==""){
            $req="select *from entrer_sortie order by id desc";
        }else{
            $location=Service::idService($location);
            $req="select *from entrer_sortie where location='".$location."' order by id desc";
        }

        $rs=$con->query($req);
        while ($d=$rs->fetch()){
            $a=new EntrerSortie();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setQuantite($d['quantite']);
            $a->setDate($d['date']);
            $a->setNoTransaction($d['no_transaction']);
            $a->setTypeTransaction($d['type_transaction']);
            $a->setLocation($d['location']);
            $a->setQuantiteAvant($d['quantite_avant']);
            $a->setQuantiteApres($d['quantite_apres']);
            $a->setRaison($d['raison']);
            $a->setDestination($d['destination']);
            $a->setUser($d['user']);
            $liste[]=$a;
        }

        return $liste;
    }

    public function listerMagasin($location=""){
        $liste=array();
        $con=self::connection();
        if($location=="") {
            $req = "SELECT es.id,es.item,es.quantite,es.date,es.no_transaction,es.type_transaction,es.location,es.quantite_avant,es.quantite_apres,es.raison,es.destination,es.user
            FROM entrer_sortie es ,stock s WHERE es.item=s.id AND s.groupe != 'Medicament'  ORDER BY es.id DESC";
        }else{
            $location=Service::idService($location);
            $req = "SELECT es.id,es.item,es.quantite,es.date,es.no_transaction,es.type_transaction,es.location,es.quantite_avant,es.quantite_apres,es.raison,es.destination,es.user
            FROM entrer_sortie es ,stock s WHERE es.item=s.id AND s.groupe != 'Medicament' and es.location='".$location."'  ORDER BY es.id DESC";
        }
        $rs=$con->query($req);
        while ($d=$rs->fetch()){
            $a=new EntrerSortie();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setQuantite($d['quantite']);
            $a->setDate($d['date']);
            $a->setNoTransaction($d['no_transaction']);
            $a->setTypeTransaction($d['type_transaction']);
            $a->setLocation($d['location']);
            $a->setQuantiteAvant($d['quantite_avant']);
            $a->setQuantiteApres($d['quantite_apres']);
            $a->setRaison($d['raison']);
            $a->setDestination($d['destination']);
            $a->setUser($d['user']);
            $liste[]=$a;
        }

        return $liste;
    }

    public function listerPharmacie($location=""){
        $liste=array();
        $con=self::connection();
        if($location==""){
        $req="select es.id,es.item,es.quantite,es.date,es.no_transaction,es.type_transaction,es.location,es.quantite_avant,es.quantite_apres,es.raison,es.destination,es.user
        from entrer_sortie es ,stock s where es.item=s.id and s.groupe = 'Medicament'  order by es.id desc";
        }
        else{
            $location=Service::idService($location);
            $req="select es.id,es.item,es.quantite,es.date,es.no_transaction,es.type_transaction,es.location,es.quantite_avant,es.quantite_apres,es.raison,es.destination,es.user
            from entrer_sortie es ,stock s where es.item=s.id and s.groupe = 'Medicament' and es.location='".$location."' order by es.id desc";
        }
        $rs=$con->query($req);
        while ($d=$rs->fetch()){
            $a=new EntrerSortie();
            $a->setId($d['id']);
            $a->setItem($d['item']);
            $a->setQuantite($d['quantite']);
            $a->setDate($d['date']);
            $a->setNoTransaction($d['no_transaction']);
            $a->setTypeTransaction($d['type_transaction']);
            $a->setLocation($d['location']);
            $a->setQuantiteAvant($d['quantite_avant']);
            $a->setQuantiteApres($d['quantite_apres']);
            $a->setRaison($d['raison']);
            $a->setDestination($d['destination']);
            $a->setUser($d['user']);
            $liste[]=$a;
        }

        return $liste;
    }

}