<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 31/03/2018
 * Time: 19:39
 */

namespace app\DefaultApp;
use systeme\Application\Application;
class DefaultApp extends Application
{
    //---
    public static function formatComptable($p)
    {
        if ($p == "") {
            $p = 0;
        }
        $p = str_replace(",", "", $p);
        $r = "#^[0-9]*.?[0-9]+$#";
        if (preg_match($r, $p)) {
            $p = number_format($p, 2, '.', ',');
            return $p;
        } else {
            throw new \Exception("Format incorrect pour prix ou cout");
        }
    }

    public static function eNull($text){
        $text=stripslashes(str_replace("null","",$text));
        return $text;
    }
}
