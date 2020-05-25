<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 05/09/2018
 * Time: 09:54
 */

namespace app\DefaultApp\Models;

use systeme\Model\Model;

class Inventaire extends Model
{
    private $id;
    private $service;
    private $item;
    private $date;
    private $qt_avant;
    private $qt_apres;
    private $remarque;
    private $user;

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
    public function getQtAvant()
    {
        return $this->qt_avant;
    }

    /**
     * @param mixed $qt_avant
     */
    public function setQtAvant($qt_avant)
    {
        $this->qt_avant = $qt_avant;
    }

    /**
     * @return mixed
     */
    public function getQtApres()
    {
        return $this->qt_apres;
    }

    /**
     * @param mixed $qt_apres
     */
    public function setQtApres($qt_apres)
    {
        $this->qt_apres = $qt_apres;
    }

    /**
     * @return mixed
     */
    public function getRemarque()
    {
        return $this->remarque;
    }

    /**
     * @param mixed $remarque
     */
    public function setRemarque($remarque)
    {
        $this->remarque = $remarque;
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

    //public

    public function enregistrer()
    {
        try {
            $con = self::connection();
            $req = "INSERT INTO inventaire (service, item, date, qt_avant, qt_apres, remarque, user) VALUES 
            (:service,:item,:date,:qt_avant,:qt_apres,:remarque,:user)";

            $param = array(
                ":service" => $this->service,
                ":item" => $this->item,
                ":date" => $this->date,
                ":qt_avant" => $this->qt_avant,
                ":qt_apres" => $this->qt_apres,
                ":remarque" => $this->remarque,
                ":user" => $this->user
            );

            $stmt = $con->prepare($req);
            if($stmt->execute($param)){
                return "ok";
            }else{
                return "no";
            }

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}