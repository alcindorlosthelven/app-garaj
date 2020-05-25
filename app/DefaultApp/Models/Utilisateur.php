<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 30/03/2018
 * Time: 16:10
 */

namespace app\DefaultApp\Models;
use \systeme\Model\Utilisateur as user;
class Utilisateur extends user
{
    protected $table="utilisateur";
    public static function total(){
        $bdd=self::connection();
        $total = $bdd->query('SELECT * FROM utilisateur');
        return $total->rowCount();
    }
}