<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 02/12/2018
 * Time: 19:40
 */
if(isset($_POST['pds']))$signe_vitaux->setPds(trim(addslashes($_POST['pds'])) . " " . $_POST['pds1']);
if(isset($_POST['taille']))$signe_vitaux->setTaille(trim(addslashes($_POST['taille'])));
if(isset($_POST['metres']))$signe_vitaux->setMetres(trim(addslashes($_POST['metres'])));
if(isset($_POST['cmimc']))$signe_vitaux->setCmimc(trim(addslashes($_POST['cmimc'])));
if(isset($_POST['temp']))$signe_vitaux->setTemp(trim(addslashes($_POST['temp'])) . " " . $_POST['temp1']);
if(isset($_POST['pouls']))$signe_vitaux->setPouls(trim(addslashes($_POST['pouls'])));
if(isset($_POST['fr']))$signe_vitaux->setFr(trim(addslashes($_POST['fr'])));
if(isset($_POST['ta']))$signe_vitaux->setTa(trim(addslashes($_POST['ta'])) . " " . $_POST['ta1']);