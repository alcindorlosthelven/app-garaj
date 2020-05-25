<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 02/12/2018
 * Time: 16:12
 */
if (isset($_POST['motif_consultation'])) {
    $motif = $_POST['motif_consultation'];
    $motif = implode(",", $motif);
}
if (isset($_POST['oedeme_motif'])) {
    $var .= ",oedeme : " . $_POST['oedeme_motif1'];
}
if (isset($_POST['douleurs_motif'])) {
    $var .= ",douleurs : " . $_POST['douleurs_motif1'];
}
if (isset($_POST['brulure_motif'])) {
    $var .= ",brulure : " . $_POST['brulure_motif1'];
}
if (isset($_POST['trouble_motif'])) {
    $var .= ",troubles mentaux : " . $_POST['troube_motif1'];
}
if (isset($_POST['plaie_motif'])) {
    $var .= ",plaie : " . implode("|", $_POST['plaie']);
}
if (isset($_POST['eruption_motif'])) {
    $var .= ",eruption cutanées : " . $_POST['eruption_motif1'];
}
$motif .= $var;