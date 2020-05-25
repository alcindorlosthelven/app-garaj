<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 30/11/2018
 * Time: 21:24
 */
//examen physique
if (isset($_POST['general'])) {
    $general = trim(addslashes($_POST['general']));
} else {
    $general="";
}
if (isset($_POST['tete'])) {
    $tete = trim(addslashes($_POST['tete']));
} else {
    $tete="";
}
if (isset($_POST['cou'])) {
    $cou = trim(addslashes($_POST['cou']));
} else {
    $cou="";
}
if (isset($_POST['thyroide'])) {
    $thyroide = trim(addslashes($_POST['thyroide']));
} else {
    $thyroide="";
}
if (isset($_POST['poumon'])) {
    $poumons = trim(addslashes($_POST['poumon']));
} else {
    $poumons="";
}
if (isset($_POST['coeur'])) {
    $coeur = trim(addslashes($_POST['coeur']));
} else {
    $coeur="";
}
if (isset($_POST['seins'])) {
    $seins = trim(addslashes($_POST['seins']));
} else {
    $seins="";
}
if (isset($_POST['abdomene'])) {
    $abdomene = trim(addslashes($_POST['abdomene']));
} else {
    $abdomene="";
}
if (isset($_POST['uterus'])) {
    $uterus = trim(addslashes($_POST['uterus']));
} else {
    $uterus="";
}
if (isset($_POST['organe_genitaux'])) {
    $organe_genitaux = trim(addslashes($_POST['organe_genitaux']));
} else {
    $organe_genitaux="";
}
if (isset($_POST['vagin'])) {
    $vagin = trim(addslashes($_POST['vagin']));
} else {
    $vagin="";
}
if (isset($_POST['col'])) {
    $col = trim(addslashes($_POST['col']));
} else {
    $col="";
}
if (isset($_POST['annexes'])) {
    $annexes = trim(addslashes($_POST['annexes']));
} else {
    $annexes="";
}
if (isset($_POST['toucher_rectal'])) {
    $toucher_rectal = trim(addslashes($_POST['toucher_rectal']));
} else {
    $toucher_rectal="";
}
if (isset($_POST['membres'])) {
    $membres = trim(addslashes($_POST['membres']));
} else {
    $membres="";
}
if (isset($_POST['reflexe'])) {
    $reflex = trim(addslashes($_POST['reflexe']));
} else {
    $reflex="";
}
if (isset($_POST['peau'])) {
    $peau = trim(addslashes($_POST['peau']));
} else {
    $peau="";
}
if (isset($_POST['rythme_cardiaque'])) {
    $rythme_cardiaque = trim(addslashes($_POST['rythme_cardiaque']));
} else {
    $rythme_cardiaque="";
}
if (isset($_POST['hauteur_uterine'])) {
    $hauteur_uterine = trim(addslashes($_POST['hauteur_uterine']));
} else {
    $hauteur_uterine="";
}
if (isset($_POST['oedeme'])) {
    $oedeme = trim(addslashes($_POST['oedeme']));
} else {
    $oedeme = "";
}
if (isset($_POST['presentation'])) {
    $presentation = $_POST['presentation'];
} else {
    $presentation = "";
}
if (isset($_POST['position'])) {
    $position = $_POST['position'];
} else {
    $position = "";
}
if (isset($_POST['contraction'])) {
    $contraction = trim(addslashes($_POST['contraction']));
} else {
    $contraction = "";
}
if (isset($_POST['description'])) {
    $description = trim(addslashes($_POST['description']));
} else {
    $description = "";
}
$examenph->setCou($cou);
$examenph->setGeneral($general);
$examenph->setTete($tete);
$examenph->setThyroide($thyroide);
$examenph->setPoumons($poumons);
$examenph->setCoeur($coeur);
$examenph->setSeins($seins);
$examenph->setAbdomene($abdomene);
$examenph->setUterus($uterus);
$examenph->setOrganeGenitaux($organe_genitaux);
$examenph->setVagin($vagin);
$examenph->setCol($col);
$examenph->setAnnexes($annexes);
$examenph->setToucherRectal($toucher_rectal);
$examenph->setMembres($membres);
$examenph->setReflexesOsteoTendineux($reflex);
$examenph->setPeau($peau);
$examenph->setRythmeCardiaque($rythme_cardiaque);
$examenph->setHauteurUterine($hauteur_uterine);
$examenph->setOedeme($oedeme);
if(isset($_POST['presentation']))$examenph->setPresentation(implode(",", $presentation));
if(isset($_POST['position']))$examenph->setPosition(implode(",", $position));
$examenph->setContractionUterine($contraction);
$examenph->setDescription($description);
//fin examen physique