<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 23/12/2018
 * Time: 13:44
 */
if(isset($_POST['type_tuberculose']))$tuberculose->setType(trim(addslashes($_POST['type_tuberculose'])));
if(isset($_POST['numero_enregistrement']))$tuberculose->setNoEnregistrement(trim(addslashes($_POST['numero_enregistrement'])));
if(isset($_POST['date_enregistrement']))$tuberculose->setDateEnregistrement(trim(addslashes($_POST['date_enregistrement'])));
if (isset($_POST['type_malade'])) $tuberculose->setTypeMaladie(implode(",", $_POST['type_malade']));
if (isset($_POST['clasification_maladie'])) $tuberculose->setClasificationMaladie(implode(",", $_POST['clasification_maladie']));
if (isset($_POST['base_diagnostic'])) $tuberculose->setBaseDiagnostic(implode(",", $_POST['base_diagnostic']));
if(isset($_POST['date_debut_traitement']))$tuberculose->setDateDebutTraitement(trim(addslashes($_POST['date_debut_traitement'])));
if (isset($_POST['regime_prescrit'])) $tuberculose->setRegime(implode(",", $_POST['regime_prescrit']));
if (isset($_POST['cas_contact'])) $tuberculose->setCasContact(trim(addslashes($_POST['cas_contact'])));
if(isset($_POST['nombre_contact']))$tuberculose->setNombreContact($_POST['nombre_contact']);
if(isset($_POST['no_reference']))$tuberculose->setNoReferenceIndex(trim(addslashes($_POST['no_reference'])));
if (isset($_POST['accompagnateur'])) $tuberculose->setAccompagnateur($_POST['accompagnateur']);
if(isset($_POST['nom_accompagnateur']))$tuberculose->setNomPrenomAccompagnateur(trim(addslashes($_POST['nom_accompagnateur'])));
if (isset($_POST['test_vih'])) $tuberculose->setTestVih(trim(addslashes($_POST['test_vih'])));
if(isset($_POST['date_vih']))$tuberculose->setDateTestVih(trim(addslashes($_POST['date_vih'])));
if (isset($_POST['resultat_vih'])) $tuberculose->setResultatTestVih($_POST['resultat_vih']);
if(isset($_POST['cd4']))$tuberculose->setCd4(implode(",", $_POST['cd4']));
if(isset($_POST['datecd4']))$tuberculose->setDateCd4(trim(addslashes($_POST['datecd4'])));
if (isset($_POST['arv'])) $tuberculose->setArv($_POST['arv']);
if(isset($_POST['autre_plan']))$tuberculose->setMedicamentArv(trim(addslashes($_POST['medicament_arv'])));
if(isset($_POST['autre_plan']))$tuberculose->setDateDebutArv(trim(addslashes($_POST['date_debut_arv'])));
if (isset($_POST['prophylaxie'])) $tuberculose->setProphylaxie(implode(",", $_POST['prophylaxie']));
if (isset($_POST['suplementaire_alimentaire'])) $tuberculose->setSuplementaireAlimentaire($_POST['suplementaire_alimentaire']);
if (isset($_POST['suplementaire_vitamineb'])) $tuberculose->setSuplementaireVitamineb($_POST['suplementaire_vitamineb']);

if(isset($_POST['date_arret_traitement'])){$date_arret_traitement = trim(addslashes($_POST['date_arret_traitement']));}else{$date_arret_traitement="";};
if (isset($_POST['statut_arret'])) {
    $statut_arret = implode(",", $_POST['statut_arret']);
} else {
    $statut_arret = "";
}
$tuberculose->setDateArret($date_arret_traitement);
$tuberculose->setStatutArret($statut_arret);
//fin turbeculose

//resultat expectoration
$resultatExp0 = null;
$resultatExp1 = null;
$resultatExp2 = null;
$resultatExp3 = null;
$resultatExp4 = null;
$resultatExp5 = null;

if(isset($_POST['date0']))if ($_POST['date0'] != "" and isset($_POST['bacilloscopie0'])) {
    $resultatExp0=new \app\CentreSante\Models\ResultatExpectoration();
    $resultatExp0->setMois($_POST['mois0']);
    $resultatExp0->setDate($_POST['date0']);
    $resultatExp0->setBascilloscope($_POST['bacilloscopie0']);
    $resultatExp0->setPoids(trim(addslashes($_POST['poids0'])));
}
if(isset($_POST['date1']))if ($_POST['date1'] != "" and isset($_POST['bacilloscopie1'])) {
    $resultatExp1=new \app\CentreSante\Models\ResultatExpectoration();
    $resultatExp1->setMois($_POST['mois1']);
    $resultatExp1->setDate($_POST['date1']);
    $resultatExp1->setBascilloscope($_POST['bacilloscopie1']);
    $resultatExp1->setPoids(trim(addslashes($_POST['poids1'])));
}
if(isset($_POST['date2']))if ($_POST['date2'] != "" and isset($_POST['bacilloscopie2'])) {
    $resultatExp2=new \app\CentreSante\Models\ResultatExpectoration();
    $resultatExp2->setMois($_POST['mois2']);
    $resultatExp2->setDate($_POST['date2']);
    $resultatExp2->setBascilloscope($_POST['bacilloscopie2']);
    $resultatExp2->setPoids(trim(addslashes($_POST['poids2'])));
}
if(isset($_POST['date3']))if ($_POST['date3'] != "" and isset($_POST['bacilloscopie3'])) {
    $resultatExp3=new \app\CentreSante\Models\ResultatExpectoration();
    $resultatExp3->setMois($_POST['mois3']);
    $resultatExp3->setMois($_POST['mois3']);
    $resultatExp3->setDate($_POST['date3']);
    $resultatExp3->setBascilloscope($_POST['bacilloscopie3']);
    $resultatExp3->setPoids(trim(addslashes($_POST['poids3'])));
}
if(isset($_POST['date4']))if ($_POST['date4'] != "" and isset($_POST['bacilloscopie4'])) {
    $resultatExp4=new \app\CentreSante\Models\ResultatExpectoration();
    $resultatExp4->setMois($_POST['mois4']);
    $resultatExp4->setDate($_POST['date4']);
    $resultatExp4->setBascilloscope($_POST['bacilloscopie4']);
    $resultatExp4->setPoids(trim(addslashes($_POST['poids4'])));
}
if(isset($_POST['date5']))if ($_POST['date5'] != "" and isset($_POST['bacilloscopie5'])) {
    $resultatExp5=new \app\CentreSante\Models\ResultatExpectoration();
    $resultatExp5->setMois($_POST['mois5']);
    $resultatExp5->setDate($_POST['date5']);
    $resultatExp5->setBascilloscope($_POST['bacilloscopie5']);
    $resultatExp5->setPoids(trim(addslashes($_POST['poids5'])));
}