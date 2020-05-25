<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 3/31/2020
 * Time: 1:51 PM
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class Devise extends Model
{

    private $id,$devise;

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
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * @param mixed $devise
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;
    }



}