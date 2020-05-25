<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 02/12/2018
 * Time: 12:20
 */
if (isset($_POST['heredo-asthme'])) {
    $ah .= "|Asthme : " . implode(",", $_POST['heredo-asthme']);
}
if (isset($_POST['heredo-cancer'])) {
    $ah .= "|Cancer " . $_POST['hc'] . " : " . implode(",", $_POST['heredo-cancer']);
}
if (isset($_POST['heredo-cardiopathie'])) {
    $ah .= "|Cardiopathie : " . implode(",", $_POST['heredo-cardiopathie']);
}
if (isset($_POST['heredo-diabete'])) {
    $ah .= "|Diabete : " . implode(",", $_POST['heredo-diabete']);

}
if (isset($_POST['heredo-epilepsie'])) {
    $ah .= "|Epilepsie : " . implode(",", $_POST['heredo-epilepsie']);

}
if (isset($_POST['heredo-hta'])) {
    $ah .= "|HTA : " . implode(",", $_POST['heredo-hta']);

}
if (isset($_POST['heredo-tuberculose'])) {
    $ah .= "|Tuberculose : " . implode(",", $_POST['heredo-tuberculose']);

}
if (isset($_POST['heredo-mdr-tb'])) {
    $ah .= "|MDR TB : " . implode(",", $_POST['heredo-mdr-tb']);

}
if(isset($_POST['heredo-autre']))if ($_POST['heredo-autre'] != "") {$ah .= "|Autre : " . $_POST['heredo-autre'];}
$antecedent_heredo = trim($antecedent_heredo, ",");