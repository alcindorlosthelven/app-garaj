<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 23/12/2018
 * Time: 12:15
 */
$sup=new \app\DefaultApp\Models\Supplementation();
if(isset($_POST['type_vitamine_a']))$sup->setType($_POST['type_vitamine_a']);
if(isset($_POST['date_vitamine_a']))$sup->setDate($_POST['date_vitamine_a']);
$sup->setIdPatient($id_patient);
$sups[]=$sup;

$sup=new \app\DefaultApp\Models\Supplementation();
if(isset($_POST['type_fer']))$sup->setType($_POST['type_fer']);
if(isset($_POST['date_fer']))$sup->setDate($_POST['date_fer']);
$sup->setIdPatient($id_patient);
$sups[]=$sup;


$sup=new \app\DefaultApp\Models\Supplementation();
if(isset($_POST['type_iode']))$sup->setType($_POST['type_iode']);
if(isset($_POST['date_iode']))$sup->setDate($_POST['date_iode']);
$sup->setIdPatient($id_patient);
$sups[]=$sup;

$sup=new \app\DefaultApp\Models\Supplementation();
if(isset($_POST['type_deparasitage']))$sup->setType($_POST['type_deparasitage']);
if(isset($_POST['date_deparasitage']))$sup->setDate($_POST['date_deparasitage']);
$sup->setIdPatient($id_patient);
$sups[]=$sup;

$sup=new \app\DefaultApp\Models\Supplementation();
if(isset($_POST['type_zinc']))$sup->setType($_POST['type_zinc']);
if(isset($_POST['date_zinc']))$sup->setDate($_POST['date_zinc']);
$sup->setIdPatient($id_patient);
$sups[]=$sup;


$sup=new \app\DefaultApp\Models\Supplementation();
if(isset($_POST['type_autrev']))$sup->setType($_POST['type_autrev']);
if(isset($_POST['date_autrev']))$sup->setDate($_POST['date_autrev']);
$sup->setIdPatient($id_patient);
if($_POST['type_autrev']!="")$sups[]=$sup;