<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 02/12/2018
 * Time: 12:26
 */
if(isset($_POST['age_menarches']))$antecedent->setAgeMenarches(trim(addslashes($_POST['age_menarches'])));
if(isset($_POST['age_premier_relation']))$antecedent->setAgePremierRelation(trim(addslashes($_POST['age_premier_relation'])));
if(isset($_POST['nombre_partenaire']))$antecedent->setNombrePartenaire(trim(addslashes($_POST['nombre_partenaire'])));
if(isset($_POST['dure_regle']))$antecedent->setDureRegle(trim(addslashes($_POST['dure_regle'])));
if(isset($_POST['dure_cycle']))$antecedent->setDureCycle(trim(addslashes($_POST['dure_cycle'])));
if(isset($_POST['ddr']))$antecedent->setDdr(trim(addslashes($_POST['ddr'])));
if(isset($_POST['dpa']))$antecedent->setDpa(trim(addslashes($_POST['dpa'])));
if(isset($_POST['dismenorrhe']))$antecedent->setDysmenorrhe(implode(",",$_POST['dismenorrhe']));
if(isset($_POST['g']))$antecedent->setG(trim(addslashes($_POST['g'])));
if(isset($_POST['p']))$antecedent->setP(trim(addslashes($_POST['p'])));
if(isset($_POST['a']))$antecedent->setA(trim(addslashes($_POST['a'])));
if(isset($_POST['ev']))$antecedent->setEv(trim(addslashes($_POST['ev'])));
if(isset($_POST['grossesse_multiple']))$antecedent->setGrossesseMultiple(trim(addslashes($_POST['grossesse_multiple'])));
if(isset($_POST['pre_eclampsie']))$antecedent->setPreEclampsie(trim(addslashes($_POST['pre_eclampsie'])));
if(isset($_POST['hemoragie_grossesse']))$antecedent->setHemoragieGrossesse(trim(addslashes($_POST['hemoragie_grossesse'])));

if(isset($_POST['grossesse_suivi1']))$antecedent->setGrossesseSuivi1(trim(addslashes($_POST['grossesse_suivi1'])));
if(isset($_POST['grossesse_suivi2']))$antecedent->setGrossesseSuivi2(trim(addslashes($_POST['grossesse_suivi2'])));
if(isset($_POST['grossesse_suivi3']))$antecedent->setGrossesseSuivi3(trim(addslashes($_POST['grossesse_suivi3'])));

if(isset($_POST['accouchement1']))$antecedent->setAccouchement1(trim(addslashes($_POST['accouchement1'])));
if(isset($_POST['accouchement2']))$antecedent->setAccouchement2(trim(addslashes($_POST['accouchement2'])));
if(isset($_POST['accouchement3']))$antecedent->setAccouchement3(trim(addslashes($_POST['accouchement3'])));

if(isset($_POST['naissance_vivant1']))$antecedent->setNaissanceVivant1(trim(addslashes($_POST['naissance_vivant1'])));
if(isset($_POST['naissance_vivant2']))$antecedent->setNaissanceVivant2(trim(addslashes($_POST['naissance_vivant2'])));
if(isset($_POST['naissance_vivant3']))$antecedent->setNaissanceVivant3(trim(addslashes($_POST['naissance_vivant3'])));


if(isset($_POST['atcd_cesarienne']))$antecedent->setAtcdCesarienne(trim(addslashes($_POST['atcd_cesarienne'])));
if(isset($_POST['indication1']))$antecedent->setIndication1(trim(addslashes($_POST['indication1'])));
if(isset($_POST['indication2']))$antecedent->setIndication2(trim(addslashes($_POST['indication2'])));
if(isset($_POST['date1']))$antecedent->setDate1(trim(addslashes($_POST['date1'])));
if(isset($_POST['date2']))$antecedent->setDate2(trim(addslashes($_POST['date2'])));

if(isset($_POST['date_dernier_depistage_col']))$antecedent->setDateDernierDepistageCol(trim(addslashes($_POST['date_dernier_depistage_col'])));
if(isset($_POST['methode_utiliser']))$antecedent->setMethodeUtiliser(trim(addslashes($_POST['methode_utiliser'])));
if(isset($_POST['resultat']))$antecedent->setResultat(trim(addslashes($_POST['resultat'])));
if(isset($_POST['palpation_mensuel']))$antecedent->setPalpationMensuelSeins(trim(addslashes($_POST['palpation_mensuel'])));
if(isset($_POST['mamographie']))$antecedent->setMammographie(trim(addslashes($_POST['mamographie'])));
if(isset($_POST['resultat_mammographie']))$antecedent->setResultatMammographie(trim(addslashes($_POST['resultat_mammographie'])));
if(isset($_POST['planification_familial']))$antecedent->setPlanificationFamiliale(trim(addslashes($_POST['planification_familial'])));
if(isset($_POST['methode_planification']))$antecedent->setMethodePlanification(trim(addslashes($_POST['methode_planification'])));
if(isset($_POST['menopause']))$antecedent->setMenopause(trim(addslashes($_POST['menopause'])));
if(isset($_POST['age_menopause']))$antecedent->setDateMenopause(trim(addslashes($_POST['age_menopause'])));