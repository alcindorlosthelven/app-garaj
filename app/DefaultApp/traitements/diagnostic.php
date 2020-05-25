<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 02/12/2018
 * Time: 16:14
 */
if (isset($_POST['diagnostique'])) {
    $diagnostique = $_POST['diagnostique'];
    $diagnostique = implode(",", $diagnostique);
}
if (isset($_POST['anemiediag'])) {
    $vard .= "anémie : " . $_POST['anemiediag1'];
}
if (isset($_POST['conjonctivitediag'])) {
    $vard .= ",conjonctivite : " . $_POST['conjonctivitediag1'];
}
if (isset($_POST['denguediag'])) {
    $vard .= ",dengue : " . $_POST['denguediag1'];
}
if (isset($_POST['istdiag'])) {
    $vard .= ",ist : " . $_POST['istdiag1'];
}
if (isset($_POST['meningitediag'])) {
    $vard .= ",menengite : " . $_POST['meningitediag1'];
}
if (isset($_POST['otitdiag'])) {
    $vard .= ",otite : " . $_POST['otitdiag1'];
}
if (isset($_POST['brulurediag'])) {
    $vard .= ",brulure : " . $_POST['brulurediag1'];
}
if (isset($_POST['plaiediag'])) {
    $vard .= ",plaie : " . $_POST['plaiediag1'];
}
if (isset($_POST['charbondiag'])) {
    $vard .= ",charbon : " . $_POST['charbondiag1'];
}
if (isset($_POST['autre_diag'])) {
    $aut=str_replace(",","|",$_POST['autre_diag']);
    $vard .= ",autre : " . $aut;

}
$diagnostique .= $vard;