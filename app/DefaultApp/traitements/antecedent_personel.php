<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 02/12/2018
 * Time: 12:22
 */
if (isset($_POST['ant_personnel'])) {
    $antecedent_personel = implode(",", $_POST['ant_personnel']);
}
$vantp = "";
if (isset($_POST['antp_alergie'])) {
    $vantp .= "," . $_POST['antp_alergie'] . " : " . $_POST['antp_allergie1'];
}
if (isset($_POST['antp_chirugie'])) {
    $vantp .= "," . $_POST['antp_chirugie'] . " : " . $_POST['antp_chirugie1'];
}
if (isset($_POST['antp_hemo'])) {
    $vantp .= "," . $_POST['antp_hemo'] . " : " . $_POST['antp_hemo1'];
}
if (isset($_POST['antp_ist'])) {
    $vantp .= "," . $_POST['antp_ist'] . " : " . $_POST['antp_ist1'];
}
if (isset($_POST['antp_trouble'])) {
    $vantp .= "," . $_POST['antp_trouble'] . " : " . $_POST['antp_trouble1'];
}
if (isset($_POST['antp_cancer'])) {
    $vantp .= "," . $_POST['antp_cancer'] . " : " . $_POST['antp_cancer1'];
}
if (isset($_POST['antp_drogue'])) {
    $vantp .= "," . $_POST['antp_drogue'] . " : " . $_POST['antp_drogue1'];
}
if (isset($_POST['antp_autres'])) {
    $vantp .= "," . $_POST['antp_autres'] . " : " . $_POST['antp_autres1'];
}
if(isset($_POST['medicament_actuel'])){$medicament_actuel = trim(addslashes($_POST['medicament_actuel']));}else{$medicament_actuel="";};
if(isset($_POST['remarque'])){$remarque = trim(addslashes($_POST['remarque']));}else{$remarque="";};
$antecedent_personel = trim($antecedent_personel, ",");
