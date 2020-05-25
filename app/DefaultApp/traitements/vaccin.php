<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 23/12/2018
 * Time: 12:15
 */
$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_hepatite']))$vaccin->setType($_POST['type_hepatite']);
if(isset($_POST['date1_recu_hepatite_b']))$vaccin->setDateRecu1($_POST['date1_recu_hepatite_b']);
if(isset($_POST['date2_recu_hepatite_b']))$vaccin->setDateRecu2($_POST['date2_recu_hepatite_b']);
if(isset($_POST['date3_recu_hepatite_b']))$vaccin->setDateRecu3($_POST['date3_recu_hepatite_b']);
if(isset($_POST['recue_inconu_hepatite_b']))$vaccin->setRecuInconnu($_POST['recue_inconu_hepatite_b']);
if(isset($_POST['jamais_recu_hepatite_b']))$vaccin->setJamaisRecu($_POST['jamais_recu_hepatite_b']);
if(isset($_POST['dose_hepatite_b']))$vaccin->setDose($_POST['dose_hepatite_b']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;

$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_dt']))$vaccin->setType($_POST['type_dt']);
if(isset($_POST['date1_recu_dt']))$vaccin->setDateRecu1($_POST['date1_recu_dt']);
if(isset($_POST['date2_recu_dt']))$vaccin->setDateRecu2($_POST['date2_recu_dt']);
if(isset($_POST['date3_recu_dt']))$vaccin->setDateRecu3($_POST['date3_recu_dt']);
if(isset($_POST['recue_inconu_dt']))$vaccin->setRecuInconnu($_POST['recue_inconu_dt']);
if(isset($_POST['jamais_recu_dt']))$vaccin->setJamaisRecu($_POST['jamais_recu_dt']);
if(isset($_POST['dose_dt']))$vaccin->setDose($_POST['dose_dt']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;


$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_pneumovax']))$vaccin->setType($_POST['type_pneumovax']);
if(isset($_POST['date1_recu_pneumovax']))$vaccin->setDateRecu1($_POST['date1_recu_pneumovax']);
if(isset($_POST['date2_recu_pneumovax']))$vaccin->setDateRecu2($_POST['date2_recu_pneumovax']);
if(isset($_POST['date3_recu_pneumovax']))$vaccin->setDateRecu3($_POST['date3_recu_pneumovax']);
if(isset($_POST['recue_inconu_pneumovax']))$vaccin->setRecuInconnu($_POST['recue_inconu_pneumovax']);
if(isset($_POST['jamais_recu_pneumovax']))$vaccin->setJamaisRecu($_POST['jamais_recu_pneumovax']);
if(isset($_POST['dose_pneumovax']))$vaccin->setDose($_POST['dose_pneumovax']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;

//bcg
$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_bcg']))$vaccin->setType($_POST['type_bcg']);
if(isset($_POST['date1_recu_bcg']))$vaccin->setDateRecu1($_POST['date1_recu_bcg']);
if(isset($_POST['date2_recu_bcg']))$vaccin->setDateRecu2($_POST['date2_recu_bcg']);
if(isset($_POST['date3_recu_bcg']))$vaccin->setDateRecu3($_POST['date3_recu_bcg']);
if(isset($_POST['recue_inconu_bcg']))$vaccin->setRecuInconnu($_POST['recue_inconu_bcg']);
if(isset($_POST['jamais_recu_bcg']))$vaccin->setJamaisRecu($_POST['jamais_recu_bcg']);
if(isset($_POST['dose_bcg']))$vaccin->setDose($_POST['dose_bcg']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;


//polio
$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_polio']))$vaccin->setType($_POST['type_polio']);
if(isset($_POST['date1_recu_polio']))$vaccin->setDateRecu1($_POST['date1_recu_polio']);
if(isset($_POST['date2_recu_polio']))$vaccin->setDateRecu2($_POST['date2_recu_polio']);
if(isset($_POST['date3_recu_polio']))$vaccin->setDateRecu3($_POST['date3_recu_polio']);
if(isset($_POST['recue_inconu_polio']))$vaccin->setRecuInconnu($_POST['recue_inconu_polio']);
if(isset($_POST['jamais_recu_polio']))$vaccin->setJamaisRecu($_POST['jamais_recu_polio']);
if(isset($_POST['dose_polio']))$vaccin->setDose($_POST['dose_polio']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;

//dtper
//bcg
$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_dtper']))$vaccin->setType($_POST['type_dtper']);
if(isset($_POST['date1_recu_dtper']))$vaccin->setDateRecu1($_POST['date1_recu_dtper']);
if(isset($_POST['date2_recu_dtper']))$vaccin->setDateRecu2($_POST['date2_recu_dtper']);
if(isset($_POST['date3_recu_dtper']))$vaccin->setDateRecu3($_POST['date3_recu_dtper']);
if(isset($_POST['recue_inconu_dtper']))$vaccin->setRecuInconnu($_POST['recue_inconu_dtper']);
if(isset($_POST['jamais_recu_dtper']))$vaccin->setJamaisRecu($_POST['jamais_recu_dtper']);
if(isset($_POST['dose_dtper']))$vaccin->setDose($_POST['dose_dtper']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;


//rougeole
$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_rougeole']))$vaccin->setType($_POST['type_rougeole']);
if(isset($_POST['date1_recu_rougeole']))$vaccin->setDateRecu1($_POST['date1_recu_rougeole']);
if(isset($_POST['date2_recu_rougeole']))$vaccin->setDateRecu2($_POST['date2_recu_rougeole']);
if(isset($_POST['date3_recu_rougeole']))$vaccin->setDateRecu3($_POST['date3_recu_rougeole']);
if(isset($_POST['recue_inconu_rougeole']))$vaccin->setRecuInconnu($_POST['recue_inconu_rougeole']);
if(isset($_POST['jamais_recu_rougeole']))$vaccin->setJamaisRecu($_POST['jamais_recu_rougeole']);
if(isset($_POST['dose_rougeole']))$vaccin->setDose($_POST['dose_rougeole']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;

//rr
$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_rr']))$vaccin->setType($_POST['type_rr']);
if(isset($_POST['date1_recu_rr']))$vaccin->setDateRecu1($_POST['date1_recu_rr']);
if(isset($_POST['date2_recu_rr']))$vaccin->setDateRecu2($_POST['date2_recu_rr']);
if(isset($_POST['date3_recu_rr']))$vaccin->setDateRecu3($_POST['date3_recu_rr']);
if(isset($_POST['recue_inconu_rr']))$vaccin->setRecuInconnu($_POST['recue_inconu_rr']);
if(isset($_POST['jamais_recu_rr']))$vaccin->setJamaisRecu($_POST['jamais_recu_rr']);
if(isset($_POST['dose_rr']))$vaccin->setDose($_POST['dose_rr']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;

//pentavalent
$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_pentavalent']))$vaccin->setType($_POST['type_pentavalent']);
if(isset($_POST['date1_recu_pentavalent']))$vaccin->setDateRecu1($_POST['date1_recu_pentavalent']);
if(isset($_POST['date2_recu_pentavalent']))$vaccin->setDateRecu2($_POST['date2_recu_pentavalent']);
if(isset($_POST['date3_recu_pentavalent']))$vaccin->setDateRecu3($_POST['date3_recu_pentavalent']);
if(isset($_POST['recue_inconu_pentavalent']))$vaccin->setRecuInconnu($_POST['recue_inconu_pentavalent']);
if(isset($_POST['jamais_recu_pentavalent']))$vaccin->setJamaisRecu($_POST['jamais_recu_pentavalent']);
if(isset($_POST['dose_pentavalent']))$vaccin->setDose($_POST['dose_pentavalent']);
$vaccin->setIdPatient($id_patient);
$vaccins[]=$vaccin;

$vaccin=new \app\DefaultApp\Models\Vaccin();
if(isset($_POST['type_autre']))$vaccin->setType($_POST['type_autre']);
if(isset($_POST['date1_recu_autre']))$vaccin->setDateRecu1($_POST['date1_recu_autre']);
if(isset($_POST['date2_recu_autre']))$vaccin->setDateRecu2($_POST['date2_recu_autre']);
if(isset($_POST['date3_recu_autre']))$vaccin->setDateRecu3($_POST['date3_recu_autre']);
if(isset($_POST['recue_inconu_autre']))$vaccin->setRecuInconnu($_POST['recue_inconu_autre']);
if(isset($_POST['jamais_recu_autre']))$vaccin->setJamaisRecu($_POST['jamais_recu_autre']);
if(isset($_POST['dose_autre']))$vaccin->setDose($_POST['dose_autre']);
$vaccin->setIdPatient($id_patient);
if($_POST['type_autre']!="")$vaccins[]=$vaccin;