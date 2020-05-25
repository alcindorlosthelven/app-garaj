<?php
require_once "../../../vendor/autoload.php";
$pt=new \app\DefaultApp\Models\Patient();
if (isset($_POST['postnatal'])) {
    $id_patient = $_POST['id_patient'];
    $medecin = $_POST['medecin'];
    $date = trim(addslashes($_POST['date']));
    $duree_gestation = trim(addslashes($_POST['duree_gestation']));
    $date_accouchement = trim(addslashes($_POST['date_accouchement']));
    $lieu = trim(addslashes($_POST['lieu']));
    $mode = trim(addslashes($_POST['mode']));
    $etat_general = trim(addslashes($_POST['etat_general']));
    $allaitement = trim(addslashes($_POST['allaitement']));
    $temperature = trim(addslashes($_POST['temperature']));
    $ta = trim(addslashes($_POST['ta']));
    $methodepf = trim(addslashes($_POST['methode_pf']));
    $traitement_medication_reference = trim(addslashes($_POST['tmr']));
    $examen_demande = trim(addslashes($_POST['exmamen_demande']));
    //etat organe
    $perine = trim(addslashes($_POST['perine']));
    $globeuterie = trim(addslashes($_POST['globe_uterin']));
    $lochies = trim(addslashes($_POST['lochies']));
    //-------fin
    $membre_inferieur = trim(addslashes($_POST['membre_inferieur']));

    //============EXAMEN PHYSIQUE=========================================================================
    $examenph = new \app\DefaultApp\Models\ExamenPhysique();
    require_once "t_examen_physique.php";
    //===========FIN EXAMEN PHYSIQUE========================================================================


    //===================consultation===============================
    $consultation = new \app\DefaultApp\Models\Consultation();
    $consultation->setIdPatient($id_patient);
    $consultation->setIdMedecin($medecin);
    $consultation->setDate($date);
    $consultation->setMotif("accouchement");
    $consultation->setStatut("oui");
    $consultation->setType("postnatal");
    $consultation->setDureeGestation($duree_gestation);
    $consultation->setDateAccouchement($date_accouchement);
    $consultation->setLieu($lieu);
    $consultation->setMode($mode);
    //===================fin consultation==================================

    //===========infos bb=====================
    $infosbb1=null;
    $infosbb2=null;
    $infosbb3=null;

    if (isset($_POST['infosbb1'])) {
        $infosbb1=new \app\DefaultApp\Models\InfosBebe();
        $sexebb1 = trim(addslashes($_POST['sexebb1']));
        $typenaissancebb1 = trim(addslashes($_POST['type_naissancebb1']));
        $poidsbb1 = trim(addslashes($_POST['poidsbb1']));
        $malformationbb1 = trim(addslashes($_POST['malformationbb1']));
        if($_POST['etatbb1']){$etatbb1 =implode(",",$_POST['etatbb1']);}else{$etatbb1="";};
        if($_POST['enconsultationbb1']){$enconsultationbb1 = implode(",",$_POST['enconsultationbb1']);}else{$enconsultationbb1="";};
        $decesbb1 = trim(addslashes($_POST['decesbb1']));
        $infosbb1->setSexe($sexebb1);
        $infosbb1->setTypeNaissance($typenaissancebb1);
        $infosbb1->setPoids($poidsbb1);
        $infosbb1->setMalformation($malformationbb1);
        $infosbb1->setEtatActuel($etatbb1);
        $infosbb1->setEnConsultation($enconsultationbb1);
        $infosbb1->setDecces($decesbb1);
    }

    if (isset($_POST['infosbb2'])) {
        $infosbb2=new \app\DefaultApp\Models\InfosBebe();
        $sexebb2 = trim(addslashes($_POST['sexebb2']));
        $typenaissancebb2 = trim(addslashes($_POST['type_naissancebb2']));
        $poidsbb2 = trim(addslashes($_POST['poidsbb2']));
        $malformationbb2 = trim(addslashes($_POST['malformationbb2']));
        if(isset($_POST['etatbb2'])){$etatbb2=implode(",",$_POST['etatbb2']);}else{$etatbb2="";}
        if(isset($_POST['enconsultationbb2'])){$enconsultationbb2=implode(",",$_POST['enconsultationbb2']);}else{$enconsultationbb2="";}
        $decesbb2 = trim(addslashes($_POST['decesbb2']));
        $infosbb2->setSexe($sexebb2);
        $infosbb2->setTypeNaissance($typenaissancebb2);
        $infosbb2->setPoids($poidsbb2);
        $infosbb2->setMalformation($malformationbb2);
        $infosbb2->setEtatActuel($etatbb2);
        $infosbb2->setEnConsultation($enconsultationbb2);
        $infosbb2->setDecces($decesbb2);
    }

    if (isset($_POST['infosbb3'])) {
        $infosbb3=new \app\DefaultApp\Models\InfosBebe();
        $sexebb3 = trim(addslashes($_POST['sexebb3']));
        $typenaissancebb3 = trim(addslashes($_POST['type_naissancebb3']));
        $poidsbb3 = trim(addslashes($_POST['poidsbb3']));
        $malformationbb3 = trim(addslashes($_POST['malformationbb3']));
        if(isset($_POST['etatbb3'])){$etatbb3 = implode(",",$_POST['etatbb3']);}else{$etatbb3="";};
        if(isset($_POST['enconsultationbb3'])){$enconsultationbb3 = implode(",",$_POST['enconsultationbb3']);}else{$enconsultationbb3="";};
        $decesbb3 = trim(addslashes($_POST['decesbb3']));
        $infosbb3->setSexe($sexebb3);
        $infosbb3->setTypeNaissance($typenaissancebb3);
        $infosbb3->setPoids($poidsbb3);
        $infosbb3->setMalformation($malformationbb3);
        $infosbb3->setEtatActuel($etatbb3);
        $infosbb3->setEnConsultation($enconsultationbb3);
        $infosbb3->setDecces($decesbb3);
    }
    //==================fin infos bb===============

    //==========etat organe==================================
    $etato = new \app\DefaultApp\Models\EtatOrgane();
    $etato->setGlobeUterin($globeuterie);
    $etato->setPerine($perine);
    $etato->setLochie($lochies);
    //==============fin etat organe==========================

    //=============infos mere=============================
    $inm = new \app\DefaultApp\Models\InfosMere();
    $inm->setEtatGeneral($etat_general);
    $inm->setAllaitement($allaitement);
    $inm->setMembreInferieur($membre_inferieur);
    $inm->setExamenResultat($examen_demande);
    $inm->setTraitementMedicationReference($traitement_medication_reference);
    $inm->setTa($ta);
    $inm->setMethodepfutiliser($methodepf);
    $inm->setTemperature($temperature);

    $pestataire = trim(addslashes($_POST['pestataire']));
    $rendevous = trim(addslashes($_POST['rendevous']));
    $inm->setPestatire($pestataire);
    $inm->setRendevous($rendevous);
    //=============fin enfos mere======================



    if(\app\DefaultApp\Models\Consultation::consultationExiste($id_patient,$date)){
        $cs=\app\DefaultApp\Models\Consultation::rechercherParDatePatient($date,$id_patient);
        $consultation->setId($cs->getId());
        $m=$consultation->modifier();
        if($m=="ok"){
            $infbbs=\app\DefaultApp\Models\InfosBebe::rechercher($cs->getId());
            $i1=null;
            $i2=null;
            $i3=null;
            if(count($infbbs)>0){
                if(array_key_exists(0,$infbbs))$i1=$infbbs[0];
                if(array_key_exists(1,$infbbs))$i2=$infbbs[1];
                if(array_key_exists(2,$infbbs))$i3=$infbbs[2];
            }
            if($infosbb1!=null){
                $infosbb1->setIdConsultation($cs->getId());
                if($i1!=null){$infosbb1->setId($i1->getId());$infosbb1->modifier();}else{$infosbb1->enregistrer();};
            }
            if($infosbb2!=null){
                $infosbb2->setIdConsultation($cs->getId());
                if($i2!=null){$infosbb2->setId($i2->getId());$infosbb2->modifier();}else{$infosbb2->enregistrer();};
            }
            if($infosbb3!=null){
                $infosbb3->setIdConsultation($cs->getId());
                if($i3!=null){$infosbb3->setId($i3->getId());$infosbb3->modifier();}else{$infosbb3->enregistrer();}
            }

            $im=\app\DefaultApp\Models\InfosMere::rechercherParConsulttion($cs->getId());
            $examenph->setId($im->getExamenPhysique());
            $etato->setId($im->getEtatOrgane());
            $me=$examenph->modifier();
            if($me=="ok"){
                $met=$etato->modifier();
                if($met=="ok"){
                    $inm->setIdConsultation($cs->getId());
                    $inm->setId($im->getId());
                    $inm->setExamenPhysique($im->getExamenPhysique());
                    $inm->setEtatOrgane($im->getEtatOrgane());
                    $mes=$inm->modifier();
                    echo $mes;
                }else{
                    echo $met;
                }
            }else{
                echo $me;
            }

        }else{
            echo $m;
        }
    }else{
        $m = $consultation->enregistrer();
        if($m=="ok"){
            $id_consultation = \app\DefaultApp\Models\Consultation::dernierId();
            if($infosbb1!=null){
                $infosbb1->setIdConsultation($id_consultation);
                $infosbb1->enregistrer();
            }
            if($infosbb2!=null){
                $infosbb2->setIdConsultation($id_consultation);
                $infosbb2->enregistrer();
            }
            if($infosbb3!=null){
                $infosbb3->setIdConsultation($id_consultation);
                $infosbb3->enregistrer();
            }
            $mex=$examenph->enregistrer();
            if($mex=="ok"){
                $id_examen_physique=\app\DefaultApp\Models\ExamenPhysique::dernierId();
                $metat=$etato->enregistrer();
                if($metat=="ok"){
                    $id_etat_organe=\app\DefaultApp\Models\EtatOrgane::dernierId();
                    $inm->setIdConsultation($id_consultation);
                    $inm->setExamenPhysique($id_examen_physique);
                    $inm->setEtatOrgane($id_etat_organe);
                    $mes = $inm->enregistrer();
                    echo $mes;
                }else{
                    echo $metat;
                }

            }else{
                echo $mex;
            }
        }else{
            echo $m;
        }
    }


}

if (isset($_POST['premiere_adulte'])) {
    $id_patient = $_POST['id_patient'];
    $patient=$pt->findById($id_patient);
    if(isset($_POST['vaccination']))$patient->setVaccination(implode(",",$_POST['vaccination']));
    if(isset($_POST['electro']))$patient->setElectrophorese(trim(addslashes($_POST['electro'])));

    if($patient==null){echo "Patient introuvable";return;}

    $medecin = $_POST['medecin'];
    $date = trim(addslashes($_POST['date']));
    $dateca = trim(addslashes($_POST['dateca']));
    $resultatca = trim(addslashes($_POST['resultatca']));
    $datepros = trim(addslashes($_POST['datepros']));
    $resultatpros = trim(addslashes($_POST['resultatpros']));

    //partie infirmiere
    //==========antecedent heredo-collateraux============
    $antecedent_heredo="";
    $ah = "";
    require_once "antecedent_heredo.php";
    $antecedent_heredo = $ah;
    //=================fin antecedent heredo-collateraux===========

    //======antecedent personell=============;
    $antecedent_personel = "";
    require_once "antecedent_personel.php";
    $antecedent_personel .= "$vantp";
    //========fin antecedent personel================

    $groupe_sanguin = trim(addslashes($_POST['groupe_sanguin']));


    if (isset($_POST['electro'])) {
        $electrophorese = trim(addslashes($_POST['electro']));
    } else {
        $electrophorese = "";
    }
    if ($electrophorese == "autre") {
        $electrophorese = trim(addslashes($_POST['electro1']));
    }
    if (isset($_POST['vaccination'])) {
        $vaccination = implode(",", $_POST['vaccination']);
    } else {
        $vaccination = "";
    }
    $depistage = new \app\DefaultApp\Models\Depistage();

    if ($dateca != "" and $resultatca != "") {
        $dpsc = \app\DefaultApp\Models\Depistage::rechercher($patient->getDepistageCol());
        $depistage->setNom("depistage ca du col");
        $depistage->setDate($dateca);
        $depistage->setResultat($resultatca);
        if ($dpsc == null) {
            $md = $depistage->enregistrer();
            if ($md == "ok") {
                $id_depistage_col = \app\DefaultApp\Models\Depistage::dernierId();
            } else {
                echo $md;
            }
        } else {
            $md = $depistage->modifier();
            if ($md == "ok") {
                $id_depistage_col = $patient->getDepistageCol();
            } else {
                $id_depistage_col = null;
                echo $md;
            }
        }

    } else {
        $id_depistage_col = null;
    }

    if ($datepros != "" and $resultatpros != "") {
        $dpscp = \app\DefaultApp\Models\Depistage::rechercher($patient->getDepistageProstate());
        $depistage->setNom("depistage ca de la prostate");
        $depistage->setDate($datepros);
        $depistage->setResultat($resultatpros);
        if ($dpscp == null) {
            $mdp = $depistage->enregistrer();
            if ($mdp == "ok") {
                $id_prostage = \app\DefaultApp\Models\Depistage::dernierId();
            } else {
                $id_prostage = null;
                echo $mdp;
            }
        } else {
            $mdp = $depistage->modifier();
            if ($mdp == "ok") {
                $id_prostage = $patient->getDepistageProstate();
            } else {
                $id_prostage = null;
                echo $mdp;

            }
        }


    } else {
        $id_prostage = null;
    }

    //les antecedents
    $antecedent = new \app\DefaultApp\Models\Antecedent();
    $id_antecedent_heredo = null;
    $id_antecedent_person = null;
    if ($antecedent_heredo != "") {
        $heredo = \app\DefaultApp\Models\Antecedent::rechercher($patient->getAntecedentHeredo());
        $antecedent->setNom("heredo-collateraux");
        $antecedent->setValeur($antecedent_heredo);
        if ($heredo == null) {
            $ma = $antecedent->enregistrer();
            if ($ma == "ok") {
                $id_antecedent_heredo = \app\DefaultApp\Models\Antecedent::dernierId();
            } else {
                $id_antecedent_heredo = null;
            }
        } else {
            $antecedent->setId($patient->getAntecedentHeredo());
            $mo = $antecedent->modifier();
            if ($mo == "ok") {
                $id_antecedent_heredo = $patient->getAntecedentHeredo();
            } else {
                echo $mo;
            }
        }

    }
    if ($antecedent_personel != "") {

        $perso = \app\DefaultApp\Models\Antecedent::rechercher($patient->getAntecedentPersonel());
        $antecedent->setNom("personnels/habitudes");
        $antecedent->setValeur($antecedent_personel);
        $antecedent->setMedicamentActuels($medicament_actuel);
        $antecedent->setRemarque($remarque);
        if ($perso == null) {
            $maa = $antecedent->enregistrer();
            if ($maa == "ok") {
                $id_antecedent_person = \app\DefaultApp\Models\Antecedent::dernierId();
            } else {
                $id_antecedent_person = null;
            }
        } else {
            $antecedent->setId($patient->getAntecedentPersonel());
            $mo = $antecedent->modifier();
            if ($mo == "ok") {
                $id_antecedent_person = $patient->getAntecedentPersonel();
            } else {
                echo $mo;
            }
        }
    }
    //fin des antecedents

    $patient = $pt->findById($id_patient);
    $patient->setElectrophorese($electrophorese);
    $patient->setGroupeSanguin($groupe_sanguin);
  /*  $patient->setDepistageCol($id_depistage_col);
    $patient->setDepistageProstate($id_prostage);
    $patient->setAntecedentPersonel($id_antecedent_person);
    $patient->setAntecedentHeredo($id_antecedent_heredo);*/
    $patient->setVaccination($vaccination);

    //==============EXAMEN PHYSIQUE==================================
    $examenph = new \app\DefaultApp\Models\ExamenPhysique();
    require_once "t_examen_physique.php";
    //=============FIN EXAMEN PHYSIQUE==============================

    //parti consultation

    $motif = "";$var = "";
    $diagnostique = ""
    ;$vard = "";
    //============motif consultation=======
    require_once "motif_consultation.php";
    //==============fin motif consultation=======================

    //=========diagnostic=======================================
    require_once "diagnostic.php";
    //===============fin diagnostic================================

    //====================consultation==================
    $consultation = new \app\DefaultApp\Models\Consultation();
    $consultation->setIdPatient($id_patient);
    $consultation->setIdMedecin($medecin);
    $consultation->setDate($date);
    $consultation->setMotif($motif);
    $consultation->setDiagnostiqueImpression($diagnostique);
    $consultation->setStatut("oui");
    $consultation->setType("premiere_adulte");
    if(isset($_POST['date_subsequent']))$consultation->setDateSubsequent(trim(addslashes($_POST['date_subsequent'])));
    if(isset($_POST['diag_subsequent']))$consultation->setDiagnosticSubsequent(trim(addslashes($_POST['diag_subsequent'])));
    if(isset($_POST['evolution_subsequent']))$consultation->setEvolutionSubsequent(trim(addslashes($_POST['evolution_subsequent'])));
    if(isset($_POST['recomentation_subsequent']))$consultation->setRecomendationSubsequent(trim(addslashes($_POST['recomentation_subsequent'])));

    if (isset($_POST['reference'])) {
        $reference = implode(",", $_POST['reference']);
    } else {
        $reference = "";
    }
    $consultation->setReference($reference);
    if(isset($_POST['autre_plan']))$consultation->setAutrePlan(trim(addslashes($_POST['autre_plan'])));
    if(isset($_POST['date_prochaine_visite']))$consultation->setDateProchaineVisite(trim(addslashes($_POST['date_prochaine_visite'])));
    //==============fin partie consultation=====================================

    //partie signe vitaux
    //===============signe vitaux================================
    $signe_vitaux = new \app\DefaultApp\Models\SigneVitaux();
    $signe_vitaux->setIdPatient($id_patient);
    require_once "signe_vitaux.php";
    //==================fin signe vitaux=================

    //tuberculose
    $tuberculose = new \app\DefaultApp\Models\Tuberculose();
    $tuberculose->setIdPatient($id_patient);
    require_once "tuberculose.php";
    //fin tuberculose
    //fin resultat expectoration

    //prescription
    if(isset($_POST['prescription'])){$prescription = trim(addslashes($_POST['prescription']));}else{$prescription="";};
    $pres = new \app\DefaultApp\Models\Prescription();
    $pres->setDate(date("Y-m-d"));
    $pres->setIdPatient($id_patient);
    $pres->setIdMedecin($medecin);
    $pres->setDescription($prescription);
    //fin prescription


    if(\app\DefaultApp\Models\Consultation::consultationExiste($id_patient,$date)){
        $cons=\app\DefaultApp\Models\Consultation::rechercherParDatePatient($date,$id_patient);
        $consultation->setId($cons->getId());
        $consultation->setExamenPhysique($cons->getExamenPhysique());
        $mc=$consultation->modifier();
        if($mc=="ok") {
            $examenph->setId($consultation->getExamenPhysique());

            $ms = $examenph->modifier();
            if ($ms == "ok") {
                $sv = \app\DefaultApp\Models\SigneVitaux::rechercher($consultation->getId());
                $signe_vitaux->setId($sv->getId());
                $signe_vitaux->setIdConsultation($consultation->getId());
                $mssv = $signe_vitaux->modifier();
                if ($mssv == "ok") {
                    $tuberculose->setIdConsultation($consultation->getId());
                    $tu = \app\DefaultApp\Models\Tuberculose::rechercherParConsultation($consultation->getId());
                    $tuberculose->setId($tu->getId());
                    $mtub = $tuberculose->modifier();
                    if ($mtub == "ok") {
                        if ($resultatExp0 != null) {
                            $resultatExp0->setIdTuberculose($tuberculose->getId());
                            $resultatExp0->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),0));
                            if($resultatExp0->getId()==""){
                                $resultatExp0->enregistrer();
                            }else{
                                $resultatExp0->modifier();
                            }

                        }
                        if ($resultatExp1 != null) {
                            $resultatExp1->setIdTuberculose($tuberculose->getId());
                            $resultatExp1->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),1));
                            if($resultatExp1->getId()==""){
                                $resultatExp1->enregistrer();
                            }else{
                                $resultatExp1->modifier();
                            }

                        }
                        if ($resultatExp2 != null) {
                            $resultatExp2->setIdTuberculose($tuberculose->getId());
                            $resultatExp2->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),2));
                            if($resultatExp2->getId()==""){
                                $resultatExp2->enregistrer();
                            }else{
                                $resultatExp2->modifier();
                            }

                        }
                        if ($resultatExp3 != null) {
                            $resultatExp3->setIdTuberculose($tuberculose->getId());
                            $resultatExp3->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),3));
                            if($resultatExp3->getId()==""){
                                $resultatExp3->enregistrer();
                            }else{
                                $resultatExp3->modifier();
                            }

                        }
                        if ($resultatExp4 != null) {
                            $resultatExp4->setIdTuberculose($tuberculose->getId());
                            $resultatExp4->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),4));
                            if($resultatExp4->getId()==""){
                                $resultatExp4->enregistrer();
                            }else{
                                $resultatExp4->modifier();
                            }

                        }
                        if ($resultatExp5 != null) {
                            $resultatExp5->setIdTuberculose($tuberculose->getId());
                            $resultatExp5->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),5));
                            if($resultatExp5->getId()==""){
                                $resultatExp5->enregistrer();
                            }else{
                                $resultatExp5->modifier();
                            }

                        }
                        $mpat = $patient->update();
                        echo $mpat;
                    } else {
                        echo $mtub;
                    }
                } else {
                    echo $mssv;
                }
            } else {
                echo $ms;
            }
        }else{
            echo $mc;
        }

    }else{
        $mm=$examenph->enregistrer();
        if($mm=="ok"){
            $id_examen_physique = \app\DefaultApp\Models\ExamenPhysique::dernierId();
            $consultation->setExamenPhysique($id_examen_physique);
            $m = $consultation->enregistrer();
            if($m=="ok"){
                $id_consultation = \app\DefaultApp\Models\Consultation::dernierId();
                $signe_vitaux->setIdConsultation($id_consultation);
                $ms = $signe_vitaux->enregistrer();
                if($ms=="ok"){
                    $tuberculose->setIdConsultation($id_consultation);
                    $mtub = $tuberculose->enregistrer();
                    if($mtub=="ok"){
                        $id_tuberculose = \app\DefaultApp\Models\Tuberculose::dernierId();
                        if($resultatExp0!=null){$resultatExp0->setIdTuberculose($id_tuberculose);$resultatExp0->enregistrer();}
                        if($resultatExp1!=null){$resultatExp1->setIdTuberculose($id_tuberculose);$resultatExp1->enregistrer();}
                        if($resultatExp2!=null){$resultatExp2->setIdTuberculose($id_tuberculose);$resultatExp2->enregistrer();}
                        if($resultatExp3!=null){$resultatExp3->setIdTuberculose($id_tuberculose);$resultatExp3->enregistrer();}
                        if($resultatExp4!=null){$resultatExp4->setIdTuberculose($id_tuberculose);$resultatExp4->enregistrer();}
                        if($resultatExp5!=null){$resultatExp5->setIdTuberculose($id_tuberculose);$resultatExp5->enregistrer();}
                        $mpat = $patient->update();
                        echo $mpat;
                    }else{
                        echo $mtub;
                    }
                }else{
                    echo $ms;
                }
            }else{
                echo $m;
            }
        }else{
            echo $mm;
        }
    }

    return;


}

if(isset($_POST['obgyn']))
{

    $id_patient = $_POST['id_patient'];
    $patient=$pt->findById($id_patient);
    if($patient==null){echo "Patient introuvable";return;}
    if(isset($_POST['vaccination']))$patient->setVaccination(implode(",",$_POST['vaccination']));
    if(isset($_POST['electro']))$patient->setElectrophorese(trim(addslashes($_POST['electro'])));


    if(isset($_POST['medecin'])){$medecin = $_POST['medecin'];}else{$medecin="";};
    if(isset($_POST['date'])){$date = trim(addslashes($_POST['date']));}else{$date="";};

    //===========antecedent heredo===========""
    $antecedent_heredo="";
    $ah = "";
    require "antecedent_heredo.php";
    $antecedent_heredo = $ah;
    //=========fin antecedent heredo==========

    //==========antecedent personell==========
    $antecedent_personel = "";
    require "antecedent_personel.php";
    $antecedent_personel .= "$vantp";
    //==========fin antecedent personel=========

    //les antecedents
    $antecedent = new \app\DefaultApp\Models\Antecedent();
    $id_antecedent_heredo = null;
    $id_antecedent_person = null;
    if ($antecedent_heredo != "") {
        $heredo = \app\DefaultApp\Models\Antecedent::rechercher($patient->getAntecedentHeredo());
        $antecedent->setNom("heredo-collateraux");
        $antecedent->setValeur($antecedent_heredo);
        if ($heredo == null) {
            $ma = $antecedent->enregistrer();
            if ($ma == "ok") {
                $id_antecedent_heredo = \app\DefaultApp\Models\Antecedent::dernierId();
            } else {
                $id_antecedent_heredo = null;
            }
        } else {
            $antecedent->setId($patient->getAntecedentHeredo());
            $mo = $antecedent->modifier();
            if ($mo == "ok") {
                $id_antecedent_heredo = $patient->getAntecedentHeredo();
            } else {
                echo $mo;
            }
        }

    }
    if ($antecedent_personel != "") {
        $perso = \app\DefaultApp\Models\Antecedent::rechercher($patient->getAntecedentPersonel());
        $antecedent->setNom("personnels/habitudes");
        $antecedent->setValeur($antecedent_personel);
        $antecedent->setMedicamentActuels($medicament_actuel);
        $antecedent->setRemarque($remarque);
        if(isset($_POST['statut_vih']))$antecedent->setStatutVih(trim(addslashes($_POST['statut_vih'])));
        if(isset($_POST['enrole']))$antecedent->setEnroleeEnsoins(trim(addslashes($_POST['enrole'])));
        if(isset($_POST['traitement_arv']))$antecedent->setTraitementArv(trim(addslashes($_POST['traitement_arv'])));
        if ($perso == null) {
            $maa = $antecedent->enregistrer();
            if ($maa == "ok") {
                $id_antecedent_person = \app\DefaultApp\Models\Antecedent::dernierId();
            } else {
                $id_antecedent_person = null;
            }
        } else {
            $antecedent->setId($patient->getAntecedentPersonel());
            $mo = $antecedent->modifier();
            if ($mo == "ok") {
                $id_antecedent_person = $patient->getAntecedentPersonel();
            } else {
                echo $mo;
            }
        }
    }

    //===========antecedent obstetrico===========
    $antecedent=new \app\DefaultApp\Models\Antecedent();
    require "antecedent_ob.php";
    if($antecedent!=null){
        $ob=\app\DefaultApp\Models\Antecedent::rechercher($patient->getAntecedentObstetrico());
        if($ob==null){
            $antecedent->setNom("obstetrico");
            $man=$antecedent->enregistrer();
            if($man=="ok"){
                $id_obstetrico=\app\DefaultApp\Models\Antecedent::dernierId();
            }else{
                echo $man;
            }
        }else{
            $antecedent->setId($ob->getId());
            $antecedent->setNom("obstetrico");
            $mm=$antecedent->modifier();
            if($mm=="ok"){
                $id_obstetrico=$ob->getId();
            }else{
                echo $mm;
            }
        }
    }

    //==========fin antecedent obstretico=========
    $patient->setAntecedentObstetrico($id_obstetrico);
    $patient->setAntecedentPersonel($id_antecedent_person);
    $patient->setAntecedentHeredo($id_antecedent_heredo);



    $motif = "";$var = "";
    $diagnostique = "";
    $vard = ",";
    //============motif consultation=======
    require_once "motif_consultation.php";
    //==============fin motif consultation=======================

    //=========diagnostic=======================================
    require_once "diagnostic.php";
    //===============fin diagnostic================================

    //partie signe vitaux
    //===============signe vitaux================================
    $signe_vitaux = new \app\DefaultApp\Models\SigneVitaux();
    $signe_vitaux->setIdPatient($id_patient);
    require_once "signe_vitaux.php";
    //==================fin signe vitaux=================


    //====================consultation==================
    $consultation = new \app\DefaultApp\Models\Consultation();
    $consultation->setIdPatient($id_patient);
    $consultation->setIdMedecin($medecin);
    $consultation->setDate($date);
    $consultation->setMotif($motif);
    $consultation->setDiagnostiqueImpression($diagnostique);
    $consultation->setStatut("oui");
    $consultation->setType("obgyn");
    if(isset($_POST['date_subsequent']))$consultation->setDateSubsequent(trim(addslashes($_POST['date_subsequent'])));
    if(isset($_POST['diag_subsequent']))$consultation->setDiagnosticSubsequent(trim(addslashes($_POST['diag_subsequent'])));
    if(isset($_POST['evolution_subsequent']))$consultation->setEvolutionSubsequent(trim(addslashes($_POST['evolution_subsequent'])));
    if(isset($_POST['recomentation_subsequent']))$consultation->setRecomendationSubsequent(trim(addslashes($_POST['recomentation_subsequent'])));
    if (isset($_POST['reference'])) {
        $reference = implode(",", $_POST['reference']);
    } else {
        $reference = "";
    }

    $consultation->setReference($reference);
    if(isset($_POST['autre_plan']))$consultation->setAutrePlan(trim(addslashes($_POST['autre_plan'])));
    if(isset($_POST['date_prochaine_visite']))$consultation->setDateProchaineVisite(trim(addslashes($_POST['date_prochaine_visite'])));
    if(isset($_POST['patient_vue_pour']))$consultation->setPatientPourConsultation(implode(",",$_POST['patient_vue_pour']));
    if(isset($_POST['source_reference']))$consultation->setSourceReference(implode(",",$_POST['source_reference']));
    //==============fin partie consultation=====================================

    //==============EXAMEN PHYSIQUE==================================
    $examenph = new \app\DefaultApp\Models\ExamenPhysique();
    require_once "t_examen_physique.php";
    //=============FIN EXAMEN PHYSIQUE==============================

    //=============vaccin========================
    $vaccins=array();
    require_once "vaccin.php";
    //============fin vaccin========================

    //=================EVALUATION SECONDAIRE ET PLANIFICATION=================================
    $evaluation_secondaire=new \app\DefaultApp\Models\EvaluationSecondaire();
    $evaluation_secondaire->setIdPatient($id_patient);
    if(isset($_POST['semaine_gestation']))$evaluation_secondaire->setSemaineGestation(trim(addslashes($_POST['semaine_gestation'])));
    if(isset($_POST['facteur_risque']))$evaluation_secondaire->setFacteurRisque(implode(",",$_POST['facteur_risque']));
    if(isset($_POST['vih_positif']))$evaluation_secondaire->setVihPositif(implode(",",$_POST['vih_positif']));
    if(isset($_POST['taux_cd4']))$evaluation_secondaire->setTauxCd4(trim(addslashes($_POST['taux_cd4'])));
    if(isset($_POST['patient_arv']))$evaluation_secondaire->setArv(trim(addslashes($_POST['patient_arv'])));
    if(isset($_POST['date_debut_arv']))$evaluation_secondaire->setDateDebutArv(trim(addslashes($_POST['date_debut_arv'])));
    if(isset($_POST['date_prophylaxie']))$evaluation_secondaire->setDateProphylaxie(trim(addslashes($_POST['date_prophylaxie'])));
    if(isset($_POST['consuling_pre_test']))$evaluation_secondaire->setCounsiltingPreTest(trim(addslashes($_POST['consuling_pre_test'])));
    if(isset($_POST['consuling_post_test']))$evaluation_secondaire->setCounsiltingPostTest(trim(addslashes($_POST['consuling_post_test'])));
    if(isset($_POST['date_pre_test']))$evaluation_secondaire->setDatePreTest(trim(addslashes($_POST['date_pre_test'])));
    if(isset($_POST['date_post_test']))$evaluation_secondaire->setDatePostTest(trim(addslashes($_POST['date_post_test'])));
    if(isset($_POST['reference_partenaire']))$evaluation_secondaire->setReferencePartenaire(trim(addslashes($_POST['reference_partenaire'])));
    if(isset($_POST['resultat_partenaire']))$evaluation_secondaire->setResultatPartenaire(trim(addslashes($_POST['resultat_partenaire'])));
    if(isset($_POST['motif_depistage']))$evaluation_secondaire->setMotifDepistage(trim(addslashes($_POST['motif_depistage'])));
    //================FIN EVALUATION SECONDAIRE ET PLANIFICATION================================

    //===============PLANIFICATION======================================
    $planification_f=new \app\DefaultApp\Models\PlanificationFamiliale();
    $planification_f->setIdPatient($id_patient);
    if(isset($_POST['date_debut_planification']))$planification_f->setDateDebut(trim(addslashes($_POST['date_debut_planification'])));
    if(isset($_POST['date_arret_planification']))$planification_f->setDateFin(trim(addslashes($_POST['date_arret_planification'])));
    if(isset($_POST['utilisation_courant']))$planification_f->setUtilisationCourant(trim(addslashes($_POST['utilisation_courant'])));
    if(isset($_POST['counseling_pf']))$planification_f->setCounselingPf(trim(addslashes($_POST['counseling_pf'])));
    if(isset($_POST['methode_pf_administrer']))$planification_f->setMethodePf(implode(",",$_POST['methode_pf_administrer']));
    //==============FIN PLANIFICATION===========================

    //==============PLAN ACCOUCHEMENT====================================
    $plan_accouchement=new \app\DefaultApp\Models\PlanAccouchement();
    $plan_accouchement->setIdPatient($id_patient);
    if(isset($_POST['date_prochaine_visite']))$plan_accouchement->setDateProchaineVisite(trim(addslashes($_POST['date_prochaine_visite'])));
    if(isset($_POST['suivi_prenatal']))$plan_accouchement->setSuiviPrenatal(trim(addslashes($_POST['suivi_prenatal'])));
    if(isset($_POST['dispensation_arv']))$plan_accouchement->setDispensationArv(trim(addslashes($_POST['dispensation_arv'])));
    if(isset($_POST['etucation_individuelle']))$plan_accouchement->setEducationIndividuel(trim(addslashes($_POST['etucation_individuelle'])));

    if(isset($_POST['education_accompagnateur']))$plan_accouchement->setEducationAccompagnateur(trim(addslashes($_POST['education_accompagnateur'])));
    if(isset($_POST['visite_domiciliaire']))$plan_accouchement->setVisiteDomiciliaire(trim(addslashes($_POST['visite_domiciliaire'])));

    if(isset($_POST['club_mere']))$plan_accouchement->setClubMere(trim(addslashes($_POST['club_mere'])));
    if(isset($_POST['dpa']))$plan_accouchement->setDpa(trim(addslashes($_POST['dpa'])));
    if(isset($_POST['lieu']))$plan_accouchement->setLieu(trim(addslashes($_POST['lieu'])));

    if(isset($_POST['arv_enfant']))$plan_accouchement->setArvEnfant(trim(addslashes($_POST['arv_enfant'])));
    if(isset($_POST['presisez_arv_enfant']))$plan_accouchement->setPrecisezArvEnfant(trim(addslashes($_POST['presisez_arv_enfant'])));

    if(isset($_POST['presence_matrone']))$plan_accouchement->setPresenceMatrone(trim(addslashes($_POST['presence_matrone'])));
    if(isset($_POST['presisez_matrone']))$plan_accouchement->setPrecisezMatrone(trim(addslashes($_POST['presisez_matrone'])));

    if(isset($_POST['planification_accompagnateur']))$plan_accouchement->setPlanificationAccompagnateur(trim(addslashes($_POST['planification_accompagnateur'])));
    if(isset($_POST['nom_accompagnateur']))$plan_accouchement->setNomAccompagnateur(trim(addslashes($_POST['nom_accompagnateur'])));

    //=================FIN PLAN ACCOUCHEMENT==============================

    if(isset($_POST['electro']))$patient->setElectrophorese($_POST['electro']);
    if(isset($_POST['groupe_sanguin']))$patient->setGroupeSanguin($_POST['groupe_sanguin']);
    if(isset($_POST['vaccination']))$patient->setVaccination(implode(",",$_POST['vaccination']));


    if(\app\DefaultApp\Models\Consultation::consultationExiste($id_patient,$date)) {
        $cons = \app\DefaultApp\Models\Consultation::rechercherParDatePatient($date, $id_patient);
        $consultation->setId($cons->getId());
        $consultation->setExamenPhysique($cons->getExamenPhysique());
        $mc = $consultation->modifier();
        if($mc=="ok"){
            $examenph->setId($consultation->getExamenPhysique());
            $me=$examenph->modifier();
            if($me=="ok"){
                $signe_vitaux->setIdConsultation($cons->getId());
                $sv=\app\DefaultApp\Models\SigneVitaux::rechercher($cons->getId());
                $signe_vitaux->setId($sv->getId());
                $ms=$signe_vitaux->modifier();
                if($ms=="ok"){
                    for($i=0;$i<count($vaccins);$i++){
                        $vaccins[$i]->setIdConsultation($cons->getId());
                    }
                    $vc = \app\DefaultApp\Models\Vaccin::rechercherParConsultation($cons->getId());
                    for ($i = 0; $i < count($vaccins); $i++) {
                        $vaccins[$i]->setId($vc[$i]->getId());
                    }

                    $mvac=\app\DefaultApp\Models\Vaccin::modifiers($vaccins);
                    if($mvac=="ok"){
                        $es=\app\DefaultApp\Models\EvaluationSecondaire::rechercherParConsultation($cons->getId());
                        $evaluation_secondaire->setId($es->getId());
                        $evaluation_secondaire->setIdConsultation($cons->getId());

                        $pf=\app\DefaultApp\Models\PlanificationFamiliale::rechercherParConsultation($cons->getId());
                        $planification_f->setId($pf->getId());
                        $planification_f->setIdConsultation($cons->getId());

                        $pa=\app\DefaultApp\Models\PlanAccouchement::rechercherParConsultation($cons->getId());
                        $plan_accouchement->setId($pa->getId());
                        $plan_accouchement->setIdConsultation($cons->getId());
                        $mev=$evaluation_secondaire->modifier();
                        if($mev=="ok"){
                            $mpf=$planification_f->modifier();
                            if($mpf=="ok"){
                                $mpa=$plan_accouchement->modifier();
                                if($mpa=="ok"){
                                    $mp=$patient->modifier();
                                    echo $mp;
                                }else{
                                    echo $mpa;
                                }
                            }else{
                                echo $mpf;
                            }
                        }else{
                            echo $mev;
                        }

                    }else{
                        echo $mvac;
                    }
                }else{
                    echo $ms;
                }
            }else{
                echo $me;
            }
        }else{
            echo $mc;
        }

    }else{
        $mm=$examenph->enregistrer();
        if($mm=="ok"){
            $id_examen_physique = \app\DefaultApp\Models\ExamenPhysique::dernierId();
            $consultation->setExamenPhysique($id_examen_physique);
            $m = $consultation->enregistrer();
            if($m=="ok"){
                $id_consultation = \app\DefaultApp\Models\Consultation::dernierId();
                $signe_vitaux->setIdConsultation($id_consultation);
                $ms = $signe_vitaux->enregistrer();
                if($ms=="ok"){
                    //=====vaccins=========================
                    for($i=0;$i<count($vaccins);$i++){
                        $vaccins[$i]->setIdConsultation($id_consultation);
                    }
                    $mvac=\app\DefaultApp\Models\Vaccin::enregistrers($vaccins);

                    if($mvac=="ok"){
                        $evaluation_secondaire->setIdConsultation($id_consultation);
                        $mev=$evaluation_secondaire->enregistrer();
                        if($mev=="ok"){
                            $planification_f->setIdConsultation($id_consultation);
                            $mp=$planification_f->enregistrer();
                            if($mp=="ok"){
                                $plan_accouchement->setIdConsultation($id_consultation);
                                $mpa=$plan_accouchement->enregistrer();
                                if($mpa=="ok"){
                                    $mp=$patient->modifier();
                                    echo $mp;
                                }else{
                                    echo $mpa;
                                }
                            }else{
                                echo $mp;
                            }
                        }else{
                            echo $mev;
                        }
                    }else{
                        echo $mvac;
                    }

                }else{
                    echo $ms;
                }
            }else{
                echo $m;
            }
        }else{
            echo $mm;
        }
    }



}

if(isset($_POST['pediatrie'])){

    $id_patient = $_POST['id_patient'];
    $patient=$pt->findById($id_patient);
    if(isset($_POST['vaccination']))$patient->setVaccination(implode(",",$_POST['vaccination']));
    if(isset($_POST['electro']))$patient->setElectrophorese(trim(addslashes($_POST['electro'])));


    if($patient==null){echo "Patient introuvable";return;}
    if(isset($_POST['medecin'])){$medecin = $_POST['medecin'];}else{$medecin="";};
    if(isset($_POST['date'])){$date = trim(addslashes($_POST['date']));}else{$date="";};


    //=============vaccin========================
    $vaccins=array();
    require_once "vaccin.php";
    //============fin vaccin========================

    //===============supplementation===============
    $sups=array();
    require_once "supplementation.php";
    //===============fin supplementation===============


    $motif = "";$var = "";
    $diagnostique = "";
    $vard = ",";
    //============motif consultation=======
    require_once "motif_consultation.php";
    //==============fin motif consultation=======================

    //=========diagnostic=======================================
    require_once "diagnostic.php";
    //===============fin diagnostic================================

    //==============EXAMEN PHYSIQUE==================================
    $examenph = new \app\DefaultApp\Models\ExamenPhysique();
    require_once "t_examen_physique.php";
    //=============FIN EXAMEN PHYSIQUE==============================

    //partie signe vitaux
    //===============signe vitaux================================
    $signe_vitaux = new \app\DefaultApp\Models\SigneVitaux();
    $signe_vitaux->setIdPatient($id_patient);
    require_once "signe_vitaux.php";
    //==================fin signe vitaux=================

    //tuberculose
    $tuberculose = new \app\DefaultApp\Models\Tuberculose();
    $tuberculose->setIdPatient($id_patient);
    require_once "tuberculose.php";
    //fin tuberculose
    //fin resultat expectoration



    //====================consultation==================
    $consultation = new \app\DefaultApp\Models\Consultation();
    $consultation->setIdPatient($id_patient);
    $consultation->setIdMedecin($medecin);
    $consultation->setDate($date);
    $consultation->setMotif($motif);
    $consultation->setDiagnostiqueImpression($diagnostique);
    $consultation->setStatut("oui");
    $consultation->setType("pediatrie");
    if(isset($_POST['date_subsequent']))$consultation->setDateSubsequent(trim(addslashes($_POST['date_subsequent'])));
    if(isset($_POST['diag_subsequent']))$consultation->setDiagnosticSubsequent(trim(addslashes($_POST['diag_subsequent'])));
    if(isset($_POST['evolution_subsequent']))$consultation->setEvolutionSubsequent(trim(addslashes($_POST['evolution_subsequent'])));
    if(isset($_POST['recomentation_subsequent']))$consultation->setRecomendationSubsequent(trim(addslashes($_POST['recomentation_subsequent'])));
    if (isset($_POST['reference'])) {
        $reference = implode(",", $_POST['reference']);
    } else {
        $reference = "";
    }

    $consultation->setReference($reference);
    if(isset($_POST['autre_plan']))$consultation->setAutrePlan(trim(addslashes($_POST['autre_plan'])));
    if(isset($_POST['date_prochaine_visite']))$consultation->setDateProchaineVisite(trim(addslashes($_POST['date_prochaine_visite'])));
    if(isset($_POST['patient_vue_pour']))$consultation->setPatientPourConsultation(implode(",",$_POST['patient_vue_pour']));
    if(isset($_POST['source_reference']))$consultation->setSourceReference(implode(",",$_POST['source_reference']));

    if(isset($_POST['scolarise']))$consultation->setScolariser(trim(addslashes($_POST['scolarise'])));
    if(isset($_POST['classe']))$consultation->setClasse(trim(addslashes($_POST['classe'])));
    if(isset($_POST['hospitalisation_anterieur']))$consultation->setHospitalisationAnterieur(trim(addslashes($_POST['hospitalisation_anterieur'])));
    if(isset($_POST['cause_hospitalisation_anterieur']))$consultation->setCause(trim(addslashes($_POST['cause_hospitalisation_anterieur'])));
    if(isset($_POST['allaitement_maternel']))$consultation->setAlimentMaternel(trim(addslashes($_POST['allaitement_maternel'])));
    if(isset($_POST['duree_allaitement']))$consultation->setDureAliment(trim(addslashes($_POST['duree_allaitement'])));

    if(isset($_POST['preparation_nourisson']))$consultation->setPreparationNourisson(trim(addslashes($_POST['preparation_nourisson'])));
    if(isset($_POST['lait_preparation']))$consultation->setLaitPreparation(trim(addslashes($_POST['lait_preparation'])));

    if(isset($_POST['allimentation_mixte']))$consultation->setAlimentationMixte(trim(addslashes($_POST['allimentation_mixte'])));
    if(isset($_POST['diversification_alimentaire']))$consultation->setDiversificationAlimentaire(trim(addslashes($_POST['diversification_alimentaire'])));
    if(isset($_POST['age_diversification']))$consultation->setAgeDiversification(trim(addslashes($_POST['age_diversification'])));

    if(isset($_POST['motricite_global']))$consultation->setMotriciteGlobal(trim(addslashes($_POST['motricite_global'])));
    if(isset($_POST['motricite_fine']))$consultation->setMotriciteFine(trim(addslashes($_POST['motricite_fine'])));
    if(isset($_POST['comprehension']))$consultation->setLanguageComprehension(trim(addslashes($_POST['comprehension'])));
    if(isset($_POST['contact_social']))$consultation->setContactSocial(trim(addslashes($_POST['contact_social'])));
    if(isset($_POST['support_nut']))$consultation->setSupportNutritionnel(trim(addslashes($_POST['support_nut'])));
    if(isset($_POST['valeur_nut']))$consultation->setValeurNutritionnel(implode(",",$_POST['valeur_nut']));


    //==============fin partie consultation=====================================



    if(\app\DefaultApp\Models\Consultation::consultationExiste($id_patient,$date)) {
        $cons = \app\DefaultApp\Models\Consultation::rechercherParDatePatient($date, $id_patient);
        $consultation->setId($cons->getId());
        $consultation->setExamenPhysique($cons->getExamenPhysique());
        $mc = $consultation->modifier();
        if($mc=="ok"){
            $examenph->setId($consultation->getExamenPhysique());
            $me=$examenph->modifier();
            if($me=="ok"){
                $signe_vitaux->setIdConsultation($cons->getId());
                $sv=\app\DefaultApp\Models\SigneVitaux::rechercher($cons->getId());
                $signe_vitaux->setId($sv->getId());
                $ms=$signe_vitaux->modifier();
                if($ms=="ok"){

                    for($i=0;$i<count($vaccins);$i++){
                        $vaccins[$i]->setIdConsultation($cons->getId());
                    }
                    $vc = \app\DefaultApp\Models\Vaccin::rechercherParConsultation($cons->getId());
                    for ($i = 0; $i < count($vaccins); $i++) {
                        $vaccins[$i]->setId($vc[$i]->getId());
                    }

                    $mvac=\app\DefaultApp\Models\Vaccin::modifiers($vaccins);
                    if($mvac=="ok"){
                        for($i=0;$i<count($sups);$i++){
                            $sups[$i]->setIdConsultation($cons->getId());
                        }
                        $sp = \app\DefaultApp\Models\Supplementation::rechercherParConsultation($cons->getId());
                        for ($i = 0; $i < count($sups); $i++) {
                            $sups[$i]->setId($sp[$i]->getId());
                        }
                        $msup=\app\DefaultApp\Models\Supplementation::modifiers($sups);
                        if($msup=="ok"){
                            $tuberculose->setIdConsultation($cons->getId());
                            $tu = \app\DefaultApp\Models\Tuberculose::rechercherParConsultation($cons->getId());
                            $tuberculose->setId($tu->getId());
                            $mtub = $tuberculose->modifier();
                            if ($mtub == "ok") {
                                if ($resultatExp0 != null) {
                                    $resultatExp0->setIdTuberculose($tuberculose->getId());
                                    $resultatExp0->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),0));
                                    if($resultatExp0->getId()==""){
                                        $resultatExp0->enregistrer();
                                    }else{
                                        $resultatExp0->modifier();
                                    }

                                }
                                if ($resultatExp1 != null) {
                                    $resultatExp1->setIdTuberculose($tuberculose->getId());
                                    $resultatExp1->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),1));
                                    if($resultatExp1->getId()==""){
                                        $resultatExp1->enregistrer();
                                    }else{
                                        $resultatExp1->modifier();
                                    }

                                }
                                if ($resultatExp2 != null) {
                                    $resultatExp2->setIdTuberculose($tuberculose->getId());
                                    $resultatExp2->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),2));
                                    if($resultatExp2->getId()==""){
                                        $resultatExp2->enregistrer();
                                    }else{
                                        $resultatExp2->modifier();
                                    }

                                }
                                if ($resultatExp3 != null) {
                                    $resultatExp3->setIdTuberculose($tuberculose->getId());
                                    $resultatExp3->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),3));
                                    if($resultatExp3->getId()==""){
                                        $resultatExp3->enregistrer();
                                    }else{
                                        $resultatExp3->modifier();
                                    }

                                }
                                if ($resultatExp4 != null) {
                                    $resultatExp4->setIdTuberculose($tuberculose->getId());
                                    $resultatExp4->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),4));
                                    if($resultatExp4->getId()==""){
                                        $resultatExp4->enregistrer();
                                    }else{
                                        $resultatExp4->modifier();
                                    }

                                }
                                if ($resultatExp5 != null) {
                                    $resultatExp5->setIdTuberculose($tuberculose->getId());
                                    $resultatExp5->setId(\app\DefaultApp\Models\ResultatExpectoration::idParTuberculose($tuberculose->getId(),5));
                                    if($resultatExp5->getId()==""){
                                        $resultatExp5->enregistrer();
                                    }else{
                                        $resultatExp5->modifier();
                                    }

                                }
                                $mpat = $patient->modifier();
                                echo $mpat;
                            } else {
                                echo $mtub;
                            }
                        }else{
                            echo $msup;
                        }
                    }else{
                        echo $mvac;
                    }
                }else{
                    echo $ms;
                }
            }else{
                echo $me;
            }
        }else{
            echo $mc;
        }

    }else{
        $mm=$examenph->enregistrer();
        if($mm=="ok"){
            $id_examen_physique = \app\DefaultApp\Models\ExamenPhysique::dernierId();
            $consultation->setExamenPhysique($id_examen_physique);
            $m = $consultation->enregistrer();
            if($m=="ok"){
                $id_consultation = \app\DefaultApp\Models\Consultation::dernierId();
                $signe_vitaux->setIdConsultation($id_consultation);
                $ms = $signe_vitaux->enregistrer();
                if($ms=="ok"){
                    //=====vaccins=========================
                    for($i=0;$i<count($vaccins);$i++){
                        $vaccins[$i]->setIdConsultation($id_consultation);
                    }
                    $mvac=\app\DefaultApp\Models\Vaccin::enregistrers($vaccins);
                    if($mvac=="ok"){
                        //=====supplementation=========================
                        for($i=0;$i<count($sups);$i++){
                            $sups[$i]->setIdConsultation($id_consultation);
                        }

                      $msup=\app\DefaultApp\Models\Supplementation::enregistrers($sups);
                       if($msup=="ok"){
                           $tuberculose->setIdConsultation($id_consultation);
                           $mtub = $tuberculose->enregistrer();
                           if($mtub=="ok"){
                               $id_tuberculose = \app\DefaultApp\Models\Tuberculose::dernierId();
                               if($resultatExp0!=null){$resultatExp0->setIdTuberculose($id_tuberculose);$resultatExp0->enregistrer();}
                               if($resultatExp1!=null){$resultatExp1->setIdTuberculose($id_tuberculose);$resultatExp1->enregistrer();}
                               if($resultatExp2!=null){$resultatExp2->setIdTuberculose($id_tuberculose);$resultatExp2->enregistrer();}
                               if($resultatExp3!=null){$resultatExp3->setIdTuberculose($id_tuberculose);$resultatExp3->enregistrer();}
                               if($resultatExp4!=null){$resultatExp4->setIdTuberculose($id_tuberculose);$resultatExp4->enregistrer();}
                               if($resultatExp5!=null){$resultatExp5->setIdTuberculose($id_tuberculose);$resultatExp5->enregistrer();}
                               $mpat = $patient->modifier();
                               echo $mpat;
                           }else{
                               echo $mtub;
                           }
                       }else{
                           echo $msup;
                       }

                    }else{
                        echo $mvac;
                    }

                }else{
                    echo $ms;
                }
            }else{
                echo $m;
            }
        }else{
            echo $mm;
        }
    }
}

if(isset($_POST['urgence'])){
    $date=$_POST['date'];
    $id_patient=$_POST['id_patient'];
    $medecin=trim(addslashes($_POST['medecin']));
    $complainte=trim(addslashes(htmlentities($_POST['complainte'])));
    $diagnostique=trim(addslashes(htmlentities($_POST['diagnostique'])));
    $a="";
    $b="";
    $c="";
    if(isset($_POST['a']))$a=$_POST['a'];
    if(isset($_POST['b']))$b=$_POST['b'];
    if(isset($_POST['c']))$c=$_POST['c'];
    $arriver_en=$a." , ".$b." , ".$c;

    $consultation=new \app\DefaultApp\Models\Consultation();
    $consultation->setType("urgence");
    $consultation->setIdMedecin($medecin);
    $consultation->setIdPatient($id_patient);
    $consultation->setDiagnostiqueImpression($diagnostique);
    $consultation->setComplainte($complainte);
    $consultation->setArriverEn($arriver_en);
    $consultation->setDate($date);
    $consultation->setStatut("oui");

    if(\app\DefaultApp\Models\Consultation::consultationExiste($id_patient,$date)) {
        $c=\app\DefaultApp\Models\Consultation::rechercherParDatePatient($date,$id_patient);
        $consultation->setId($c->getId());
        $m = $consultation->modifier();
        echo $m;

    }else{
        $m = $consultation->enregistrer();
        echo $m;
    }

}

