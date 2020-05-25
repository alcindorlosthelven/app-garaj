<?php
date_default_timezone_set("America/Port-au-Prince");
require_once "../../../vendor/autoload.php";
if (isset($_POST['ajouter_laboratoire'])) {
    $nom = trim(addslashes($_POST['nom']));
    $nom_alternatif = trim(addslashes($_POST['nom_alternatif']));
    $categorie = strtolower($_POST['categorie']);
    $unite = $_POST['unite'];
    $type = trim(addslashes($_POST['type_ex']));
    if ($categorie == "frottis" or $categorie == "culture") {
        $type = "autre";
    }
    $valeur_max = $_POST['valeur_max'];
    $valeur_min = $_POST['valeur_min'];
    $valeur_max = str_replace(",", ".", $valeur_max);
    $valeur_min = str_replace(",", ".", $valeur_min);

    if ($type != "min_max") {
        $valeur_min = 0;
        $valeur_max = 0;
    }
    $r = "#^[0-9]*.?[0-9]+$#";
    if (preg_match($r, $valeur_max)) {
        $valeur_max = number_format($valeur_max, 2, '.', '');
    } else {
        echo "valeur max incorrect...";
        return;
    }

    if (preg_match($r, $valeur_min)) {
        $valeur_min = number_format($valeur_min, 2, '.', '');
    } else {
        echo "valeur min incorrect...";
        return;
    }

    $prix = $_POST['prix'];
    $cout = $_POST['cout'];
    $devise = $_POST['devise'];

    $exament = new \app\DefaultApp\Models\Laboratoire();
    $exament->setNom($nom);
    $exament->setNomAlternatif($nom_alternatif);
    $exament->setCategorie($categorie);
    $exament->setValeurNormalMax($valeur_max);
    $exament->setValeurNormalMin($valeur_min);
    $exament->setUniteDeValeur($unite);
    $exament->setDevise($devise);
    $exament->setPrix($prix);
    $exament->setCout($cout);
    $exament->setTypeResultat($type);
    $m = $exament->add();
    echo $m;
}

if (isset($_POST['modifier_exament'])) {
    $exament = new \app\DefaultApp\Models\Laboratoire();
    $id = $_POST['id'];
    $exament = $exament->findById($id);
    $nom = trim(addslashes($_POST['nom']));
    $autrenom = trim(addslashes($_POST['autre_nom']));
    $prix = floatval($_POST['prix']);
    $cout = floatval($_POST['cout']);
    $devise = trim(addslashes($_POST['devise']));
    $exament->setNom($nom);
    $exament->setNomAlternatif($autrenom);
    $exament->setPrix($prix);
    $exament->setCout($cout);
    $exament->setDevise($devise);
    $m = $exament->update();
    echo $m;
}

if (isset($_POST['demmande_laboratoire'])) {
    $demmande = new \app\DefaultApp\Models\DemmandeLaboratoire();
    $con = \systeme\Application\Application::connection();
    $date = date("Y-m-d");
    $id_patient = $_POST['id_patient'];
    $id_medecin = $_POST['medecin'];

    if ($id_patient != "") {
        $demmande->setIdPatient($id_patient);
    } else {
        echo "Patient introuvable";
        return;
    }

    $lep1 = array();
    $demmande->setDate($date);
    $demmande->setIdMedecin($id_medecin);
    $demmande->setStatut("n/a");
    if (isset($_POST['id_admision'])) {
        $demmande->setIdAdmision($_POST['id_admision']);
    } else {
        $demmande->setIdAdmision("n/a");
    }
    $m = $demmande->add();
    if ($m == "ok") {
        $id_demande = \app\DefaultApp\Models\DemmandeLaboratoire::dernierId();
        $listeExamePrend = array();
        $groupe = new \app\DefaultApp\Models\GroupeExamensLaboratoire();
        $listeGroupe = $groupe->findAll();
        foreach ($listeGroupe as $grp) {
            $id_group = "g-" . $grp->getId();
            if (isset($_POST[$id_group])) {
                $dg = \app\DefaultApp\Models\TblGe::listerParGroupe($grp->getId());
                foreach ($dg as $dgg) {
                    $ide = $dgg->getIdExamen();
                    $listeExamePrend[] = $ide;
                    $lep1[] = $ide;
                }

                $id_group = $_POST[$id_group];
                $lep = new \app\DefaultApp\Models\Lep();
                $lep->setIdDemande($id_demande);
                $lep->setIdExamens($id_group);
                $lep->add();
            }
        }
        $lep = implode(",", $listeExamePrend);

        $listeLaboratoire = \app\DefaultApp\Models\Laboratoire::listeLaboratoire($lep);

        foreach ($listeLaboratoire as $labo) {
            $id = $labo->getId();
            if (isset($_POST[$id])) {
                $id_examen = $_POST[$id];
                $lep0 = new \app\DefaultApp\Models\Lep();
                $lep0->setIdDemande($id_demande);
                $lep0->setIdExamens($id_examen);
                $lep0->add();
                $lep1[] = $id_examen;
            }
        }
        foreach ($lep1 as $value) {
            $examensLabo = new \app\DefaultApp\Models\ExamensDemandeLaboratoire();
            $examensLabo->setIdDemande($id_demande);
            $examensLabo->setIdLaboratoire($value);
            $examensLabo->setStatut("n/a");
            $examensLabo->setResultat("n/a");
            $examensLabo->setRemarque("n/a");
            $mm = $examensLabo->add();
        }
        /* $tr=new \app\DefaultApp\Models\Transaction();
         $totalPrix=\app\DefaultApp\Models\DemandeLaboratoire::totalPrix($id_demande);
         $tr->setDate(date("Y-m-d"));
         $tr->setHeure(date("h:i:s"));
         $tr->setService("laboratoire");
         $tr->setPrix($totalPrix);
         $m=$tr->enregistrer();*/
        echo $mm;
    } else {
        echo $m;
    }

}

if (isset($_GET['voire_demande'])) {
    ?>
    <?php
    if (isset($_POST['numero'])) {
        $con = \app\DefaultApp\DefaultApp::connection();
        $id_demande = $_POST['numero'];
        $req = "SELECT *FROM lep WHERE id_demande='" . $id_demande . "'";
        $rs = $con->query($req);
        ?>
        <table class="table">
            <tr>
                <th>Nom Examen</th>
            </tr>

            <?php
            while ($data = $rs->fetch()) {
                if (substr($data['id_exament'], "0", "1") == "g") {
                    $id_groupe = substr($data['id_exament'], "2", "2");
                    $gr = \app\DefaultApp\Models\GroupeExament::rechercher($id_groupe);
                    $nom_ex = $gr->getNomGroupe();

                } else {
                    $ex = new \app\DefaultApp\Models\Exament();
                    $ex = \app\DefaultApp\Models\Exament::rechercher($data['id_exament']);
                    $nom_ex = $ex->getNom();
                }
                echo "<tr><td>$nom_ex</td></tr>";
            } ?>

        </table>
        <?php
    }
    ?>
    <?php
}

if (isset($_POST['btnfait'])) {
    $laboratoire = new \app\DefaultApp\Models\Laboratoire();
    $id_demande = $_POST['id_demande'];
    $lep = \app\DefaultApp\Models\Lep::listerParDemmande($id_demande);
    foreach ($lep as $datax) {
        $id_examen = $datax->getIdExamens();
        $laboratoire = $laboratoire->findById($id_examen);
        $nomEx = stripslashes($laboratoire->getNom());
        $categorie = $laboratoire->getCategorie();
        //urine routine
        if ($nomEx === "urines routines") {
            \app\DefaultApp\Models\ResultatUrineRoutine::supprimer($id_demande, $id_examen);
            $resultat_urine = new \app\DefaultApp\Models\ResultatUrineRoutine();
            $resultat_urine->setIdDemmande($id_demande);
            $resultat_urine->setIdExamens($id_examen);
            $msg = $resultat_urine->add();
            if ($msg == "ok") {
                $dernierIdUrine = \app\DefaultApp\Models\ResultatUrineRoutine::DernierId();
                //macroscopie
                if (isset($_POST['macro-' . $id_examen . "-couleur"])) {
                    $couleur = trim(addslashes($_POST['macro-' . $id_examen . "-couleur"]));
                    $aspect = trim(addslashes($_POST['macro-' . $id_examen . "-aspect"]));
                    $ph = trim(addslashes($_POST['macro-' . $id_examen . "-ph"]));
                    $reaction = trim(addslashes($_POST['macro-' . $id_examen . "-reaction"]));
                    $densite = trim(addslashes($_POST['macro-' . $id_examen . "-densite"]));
                    $albumine = trim(addslashes($_POST['macro-' . $id_examen . "-albumine"]));
                    $acetone = trim(addslashes($_POST['macro-' . $id_examen . "-acetone"]));
                    $leucocytes = trim(addslashes($_POST['macro-' . $id_examen . "-leucocytes"]));
                    $bilirubine = trim(addslashes($_POST['macro-' . $id_examen . "-bilirubine"]));
                    $nitrite = trim(addslashes($_POST['macro-' . $id_examen . "-nitrite"]));
                    $glucose = trim(addslashes($_POST['macro-' . $id_examen . "-glucose"]));
                    $sang = trim(addslashes($_POST['macro-' . $id_examen . "-sang"]));
                    $urobilinogene = trim(addslashes($_POST['macro-' . $id_examen . "-urobilinogene"]));

                    $macro = new \app\DefaultApp\Models\Macroscopie();
                    $macro->setCouleur($couleur);
                    $macro->setAspect($aspect);
                    $macro->setPh($ph);
                    $macro->setReaction($reaction);
                    $macro->setDensite($densite);
                    $macro->setAlbumine($albumine);
                    $macro->setAcetoneKetone($acetone);
                    $macro->setLeucocytes($leucocytes);
                    $macro->setBilirubine($bilirubine);
                    $macro->setNitrine($nitrite);
                    $macro->setGlucose($glucose);
                    $macro->setSang($sang);
                    $macro->setUrobilinogene($urobilinogene);
                    $macro->setIdResultat($dernierIdUrine);
                    $mmacro = $macro->add();
                    //microscopie
                    if ($mmacro == "ok") {
                        $id_macro = \app\DefaultApp\Models\Macroscopie::dernierId();
                        $depot = trim(addslashes($_POST['micro-' . $id_examen . "-depots"]));
                        $cylindres = trim(addslashes($_POST['micro-' . $id_examen . "-cylindre"]));
                        $hematies = trim(addslashes($_POST['micro-' . $id_examen . "-hematies"]));
                        $mucus = trim(addslashes($_POST['micro-' . $id_examen . "-mucus"]));
                        $globules = trim(addslashes($_POST['micro-' . $id_examen . "-globules"]));
                        $cellules = trim(addslashes($_POST['micro-' . $id_examen . "-cellules"]));
                        $bacteries = trim(addslashes($_POST['micro-' . $id_examen . "-bacteries"]));
                        $levures = trim(addslashes($_POST['micro-' . $id_examen . "-levures"]));
                        $cristaux = trim(addslashes($_POST['micro-' . $id_examen . "-cristaux"]));
                        $trichomonas = trim(addslashes($_POST['micro-' . $id_examen . "-trichomonas"]));
                        $autres = trim(addslashes($_POST['micro-' . $id_examen . "-autres"]));
                        $gravindex = trim(addslashes($_POST['micro-' . $id_examen . "-gravindex"]));

                        $micro = new \app\DefaultApp\Models\Microscopie();
                        $micro->setDepotsAmorphes($depot);
                        $micro->setCylindres($cylindres);
                        $micro->setHematies($hematies);
                        $micro->setMucus($mucus);
                        $micro->setGlobulesBlancs($globules);
                        $micro->setCellulesEpitheliales($cellules);
                        $micro->setBacteries($bacteries);
                        $micro->setLevures($levures);
                        $micro->setCristaux($cristaux);
                        $micro->setTrichomonas($trichomonas);
                        $micro->setAutre($autres);
                        $micro->setGravindex($gravindex);
                        $micro->setIdResultat($dernierIdUrine);
                        $mmicro = $micro->add();

                    }
                }
            }
        }
        //fin urine routine

        //selles routines
        elseif ($nomEx === "selles routines") {
            \app\DefaultApp\Models\ResultatSelle::supprimer($id_demande, $id_examen);
            $resultat_selle = new  \app\DefaultApp\Models\ResultatSelle();
            $resultat_selle->setIdDemande($id_demande);
            $resultat_selle->setIdExament($id_examen);
            $msg = $resultat_selle->add();
            if ($msg == "ok") {
                //tout se passe bien
                //on reucpere la dernier id;
                $dernierIdselle = \app\DefaultApp\Models\ResultatSelle::DernierId();
                //on recupere valeur de selle
                if (isset($_POST['selle-' . $id_examen . "-aspect"])) {
                    $aspect = trim(addslashes($_POST['selle-' . $id_examen . "-aspect"]));
                    $consistance = trim(addslashes($_POST['selle-' . $id_examen . "-consistance"]));
                    $parasite = trim(addslashes($_POST['selle-' . $id_examen . "-parasite"]));
                    $autre = trim(addslashes($_POST['selle-' . $id_examen . "-autre"]));

                    $sel = new \app\DefaultApp\Models\Selle();
                    $sel->setIdResultat($dernierIdselle);
                    $sel->setAspect($aspect);
                    $sel->setConsistance($consistance);
                    $sel->setParasites($parasite);
                    $sel->setAutres($autre);
                    $sel->setNom("selle");
                    $mm = $sel->add();
                }

            }
        }
        //fin selles routine

        //selles en serie
        elseif ($nomEx == "selles en serie") {
            //on enregistrer resultat urine routine
            \app\DefaultApp\Models\ResultatSelle::supprimer($id_demande, $id_examen);
            $resultat_selle = new \app\DefaultApp\Models\ResultatSelle();
            $resultat_selle->setIdDemande($id_demande);
            $resultat_selle->setIdExament($id_examen);
            $msg = $resultat_selle->add();
            if ($msg == "ok") {
                //tout se passe bien
                //on reucpere la dernier id;
                $dernierIdselle = \app\DefaultApp\Models\ResultatSelle::DernierId();
                //on recupere valeur de selle

                if (isset($_POST['selle1-' . $id_examen . "-aspect"])) {
                    //selle1
                    $aspect = trim(addslashes($_POST['selle1-' . $id_examen . "-aspect"]));
                    $consistance = trim(addslashes($_POST['selle1-' . $id_examen . "-consistance"]));
                    $parasite = trim(addslashes($_POST['selle1-' . $id_examen . "-parasite"]));
                    $autre = trim(addslashes($_POST['selle1-' . $id_examen . "-autre"]));

                    $sel = new \app\DefaultApp\Models\Selle();
                    $sel->setIdResultat($dernierIdselle);
                    $sel->setAspect($aspect);
                    $sel->setConsistance($consistance);
                    $sel->setParasites($parasite);
                    $sel->setAutres($autre);
                    $sel->setNom("selle1");
                    $mm = $sel->add();

                    //selle2
                    $aspect = trim(addslashes($_POST['selle2-' . $id_examen . "-aspect"]));
                    $consistance = trim(addslashes($_POST['selle2-' . $id_examen . "-consistance"]));
                    $parasite = trim(addslashes($_POST['selle2-' . $id_examen . "-parasite"]));
                    $autre = trim(addslashes($_POST['selle2-' . $id_examen . "-autre"]));
                    $sel = new \app\DefaultApp\Models\Selle();
                    $sel->setIdResultat($dernierIdselle);
                    $sel->setAspect($aspect);
                    $sel->setConsistance($consistance);
                    $sel->setParasites($parasite);
                    $sel->setAutres($autre);
                    $sel->setNom("selle2");
                    $mm = $sel->add();

                    //selle3
                    $aspect = trim(addslashes($_POST['selle3-' . $id_examen . "-aspect"]));
                    $consistance = trim(addslashes($_POST['selle3-' . $id_examen . "-consistance"]));
                    $parasite = trim(addslashes($_POST['selle3-' . $id_examen . "-parasite"]));
                    $autre = trim(addslashes($_POST['selle3-' . $id_examen . "-autre"]));
                    $sel = new \app\DefaultApp\Models\Selle();
                    $sel->setIdResultat($dernierIdselle);
                    $sel->setAspect($aspect);
                    $sel->setConsistance($consistance);
                    $sel->setParasites($parasite);
                    $sel->setAutres($autre);
                    $sel->setNom("selle3");
                    $mm = $sel->add();

                    //selle4
                    $bleu = trim(addslashes($_POST['selle4-' . $id_examen . "-bleu"]));
                    $sang = trim(addslashes($_POST['selle4-' . $id_examen . "-sang"]));
                    $remarque = trim(addslashes($_POST['selle4-' . $id_examen . "-remarque"]));
                    $sel = new \app\DefaultApp\Models\Selle();
                    $sel->setIdResultat($dernierIdselle);
                    $sel->setBleuDeMethylene($bleu);
                    $sel->setSangOcculte($sang);
                    $sel->setRemarque($remarque);
                    $sel->setNom("selle4");
                    $mm = $sel->add();
                }

            }
        }
        //fin selles en serie

        //crachat
        elseif ($nomEx == "crachat") {
            //on enregistrer resultat urine routine
            \app\DefaultApp\Models\ResultatCrachat::supprimer($id_demande, $id_examen);
            $resultat_crachat = new \app\DefaultApp\Models\ResultatCrachat();
            $resultat_crachat->setIdDemande($id_demande);
            $resultat_crachat->setIdExament($id_examen);
            $msg = $resultat_crachat->add();
            if ($msg == "ok") {
                //tout se passe bien
                //on reucpere la dernier id;
                $dernierIdcrachat = \app\DefaultApp\Models\ResultatCrachat::DernierId();
                //on recupere valeur de crachat
                if (isset($_POST['crachat-' . $id_examen . "-coloration"])) {
                    $coloration = trim(addslashes($_POST['crachat-' . $id_examen . "-coloration"]));
                    $remarque = trim(addslashes($_POST['crachat-' . $id_examen . "-remarque"]));

                    $cr = new \app\DefaultApp\Models\Crachat();
                    $cr->setIdResultat($dernierIdcrachat);
                    $cr->setColorationZeihlNeelsen($coloration);
                    $cr->setRemarque($remarque);
                    $cr->setNom("crachat");
                    $mm = $cr->add();
                }
            }
        }
        //fin crachat

        //crachat en serie
        elseif ($nomEx == "crachat en serie") {
            //on enregistrer resultat urine routine
            \app\DefaultApp\Models\ResultatCrachat::supprimer($id_demande, $id_examen);
            $resultat_crachat = new \app\DefaultApp\Models\ResultatCrachat();
            $resultat_crachat->setIdDemande($id_demande);
            $resultat_crachat->setIdExament($id_examen);
            $msg = $resultat_crachat->add();
            if ($msg == "ok") {
                //tout se passe bien
                //on reucpere la dernier id;
                $dernierIdcrachat = \app\DefaultApp\Models\ResultatCrachat::DernierId();
                //on recupere valeur de crachat
                if (isset($_POST['crachat1-' . $id_examen . "-coloration"])) {
                    $coloration = trim(addslashes($_POST['crachat1-' . $id_examen . "-coloration"]));
                    $remarque = trim(addslashes($_POST['crachat1-' . $id_examen . "-remarque"]));

                    $cr = new \app\DefaultApp\Models\Crachat();
                    $cr->setIdResultat($dernierIdcrachat);
                    $cr->setColorationZeihlNeelsen($coloration);
                    $cr->setRemarque($remarque);
                    $cr->setNom("crachat1");
                    $mm = $cr->add();

                    $coloration = trim(addslashes($_POST['crachat2-' . $id_examen . "-coloration"]));
                    $remarque = trim(addslashes($_POST['crachat2-' . $id_examen . "-remarque"]));

                    $cr = new \app\DefaultApp\Models\Crachat();
                    $cr->setIdResultat($dernierIdcrachat);
                    $cr->setColorationZeihlNeelsen($coloration);
                    $cr->setRemarque($remarque);
                    $cr->setNom("crachat2");
                    $mm = $cr->add();

                    $coloration = trim(addslashes($_POST['crachat3-' . $id_examen . "-coloration"]));
                    $remarque = trim(addslashes($_POST['crachat3-' . $id_examen . "-remarque"]));

                    $cr = new \app\DefaultApp\Models\Crachat();
                    $cr->setIdResultat($dernierIdcrachat);
                    $cr->setColorationZeihlNeelsen($coloration);
                    $cr->setRemarque($remarque);
                    $cr->setNom("crachat3");
                    $mm = $cr->add();
                }
            }

        }
        //fin crachat en serie

        //liquide pleural
        elseif ($nomEx == "liquide pleural") {
            //on enregistrer resultat urine routine
            \app\DefaultApp\Models\ResultatLiquidePleural::supprimer($id_demande, $id_examen);
            $resultat_pleural = new \app\DefaultApp\Models\ResultatLiquidePleural();
            $resultat_pleural->setIdDemande($id_demande);
            $resultat_pleural->setIdExament($id_examen);
            $msg = $resultat_pleural->add();
            if ($msg == "ok") {
                $dernierId = \app\DefaultApp\Models\ResultatLiquidePleural::DernierId();
                if (isset($_POST['pleural-' . $id_examen . "-source"])) {
                    $source = trim(addslashes($_POST['pleural-' . $id_examen . "-source"]));
                    $couleur = trim(addslashes($_POST['pleural-' . $id_examen . "-couleur"]));
                    $transparence = trim(addslashes($_POST['pleural-' . $id_examen . "-transparence"]));
                    $globule_blanc = trim(addslashes($_POST['pleural-' . $id_examen . "-globule_blanc"]));
                    $globule_rouge = trim(addslashes($_POST['pleural-' . $id_examen . "-globule_rouge"]));
                    $neutrophile = trim(addslashes($_POST['pleural-' . $id_examen . "-neutrophile"]));
                    $lymphocytes = trim(addslashes($_POST['pleural-' . $id_examen . "-lymphocyte"]));
                    $rivalta = trim(addslashes($_POST['pleural-' . $id_examen . "-rivalta"]));
                    $glucose = trim(addslashes($_POST['pleural-' . $id_examen . "-glucose"]));
                    $proteine = trim(addslashes($_POST['pleural-' . $id_examen . "-proteine"]));

                    $li = new \app\DefaultApp\Models\LiquidePleural();
                    $li->setIdResultat($dernierId);
                    $li->setSource($source);
                    $li->setCouleur($couleur);
                    $li->setTransparence($transparence);
                    $li->setGlobulesBlancs($globule_blanc);
                    $li->setGlobulesRouges($globule_rouge);
                    $li->setNeutrophiles($neutrophile);
                    $li->setLymphocytes($lymphocytes);
                    $li->setRivalta($rivalta);
                    $li->setGlucose($glucose);
                    $li->setProteines($proteine);
                    $msg = $li->add();
                }
            }
        }
        //fin liquide pleural

        //hemogramme complet
        elseif ($nomEx === "hemogramme complet") {
            \app\DefaultApp\Models\ResultatHemogramme::supprimer($id_demande, $id_examen);
            $resultat_hemogramme = new \app\DefaultApp\Models\ResultatHemogramme();
            $resultat_hemogramme->setIdDemande($id_demande);
            $resultat_hemogramme->setIdExament($id_examen);
            $msg = $resultat_hemogramme->add();
            if ($msg == "ok") {
                $dernierId = \app\DefaultApp\Models\ResultatHemogramme::DernierId();
                if (isset($_POST['hemo-' . $id_examen . "-hemoglobine"])) {
                    $hemoglobine = trim(addslashes($_POST['hemo-' . $id_examen . "-hemoglobine"]));
                    $hematocrite = trim(addslashes($_POST['hemo-' . $id_examen . "-hematocrite"]));
                    $globule_blanc = trim(addslashes($_POST['hemo-' . $id_examen . "-globule_blanc"]));
                    $globule_rouge = trim(addslashes($_POST['hemo-' . $id_examen . "-globules_rouge"]));
                    $neutrophile = trim(addslashes($_POST['hemo-' . $id_examen . "-neutrophiles"]));
                    $lymphocytes = trim(addslashes($_POST['hemo-' . $id_examen . "-lymphocyte"]));
                    $eosinophile = trim(addslashes($_POST['hemo-' . $id_examen . "-eosinophile"]));
                    $stabs = trim(addslashes($_POST['hemo-' . $id_examen . "-stabs"]));
                    $mcv = trim(addslashes($_POST['hemo-' . $id_examen . "-mcv"]));
                    $mchm_mgg = trim(addslashes($_POST['hemo-' . $id_examen . "-mchm_mgg"]));
                    $mchc = trim(addslashes($_POST['hemo-' . $id_examen . "-mchc"]));
                    $basophiles = trim(addslashes($_POST['hemo-' . $id_examen . "-basophiles"]));
                    $remarque = trim(addslashes($_POST['hemo-' . $id_examen . "-remarque"]));
                    $plaquettes = trim(addslashes($_POST['hemo-' . $id_examen . "-plaquettes"]));

                    $hemogramme = new \app\DefaultApp\Models\Hemogramme();
                    $hemogramme->setIdResultat($dernierId);
                    $hemogramme->setHemoglobine($hemoglobine);
                    $hemogramme->setHematocrite($hematocrite);
                    $hemogramme->setGlobuleRouges($globule_rouge);
                    $hemogramme->setGlobuleBlancs($globule_blanc);
                    $hemogramme->setNeutrophiles($neutrophile);
                    $hemogramme->setLymphocytes($lymphocytes);
                    $hemogramme->setEosinophile($eosinophile);
                    $hemogramme->setStabs($stabs);
                    $hemogramme->setMchc($mchc);
                    $hemogramme->setMcv($mcv);
                    $hemogramme->setMchmMgg($mchm_mgg);
                    $hemogramme->setBasophiles($basophiles);
                    $hemogramme->setRemarque($remarque);
                    $hemogramme->setPlaquettes($plaquettes);
                    $hemogramme->add();
                }
            }
        }
        //fin hemogramme complet

        //electrophorèse de l'hemoglobine
        elseif ($nomEx === "electrophorèse de l'hemoglobine") {
            \app\DefaultApp\Models\ResultatElectrophorese::supprimer($id_demande, $id_examen);
            $resultat_electro = new \app\DefaultApp\Models\ResultatElectrophorese();
            $resultat_electro->setIdDemande($id_demande);
            $resultat_electro->setIdExament($id_examen);
            $msg = $resultat_electro->add();
            if ($msg == "ok") {
                $dernierId = \app\DefaultApp\Models\ResultatElectrophorese::DernierId();
                $electro = new \app\DefaultApp\Models\Electrophorese();
                if (isset($_POST['electro-' . $id_examen . "-phenotype"])) {
                    $phenotype = trim(addslashes($_POST['electro-' . $id_examen . "-phenotype"]));
                    $hba = trim(addslashes($_POST['electro-' . $id_examen . "-hba"]));
                    $hba2 = trim(addslashes($_POST['electro-' . $id_examen . "-hba2"]));
                    $electro->setPhenotype($phenotype);
                    $electro->setHba($hba);
                    $electro->setHba2($hba2);
                    $electro->setIdResultat($dernierId);
                    $electro->add();
                }
            }
        }
        //fin electrophorèse de l'hemoglobine

        //pt ptt inr
        elseif ($nomEx === "pt ptt inr") {
            \app\DefaultApp\Models\ResultatPtpttinr::supprimer($id_demande, $id_examen);
            $resultat_pt = new \app\DefaultApp\Models\ResultatPtpttinr();
            $resultat_pt->setIdDemande($id_demande);
            $resultat_pt->setIdExament($id_examen);
            $msg = $resultat_pt->add();
            if ($msg == "ok") {
                $dernierId = \app\DefaultApp\Models\ResultatPtpttinr::DernierId();
                $pt = new \app\DefaultApp\Models\Ptpttinr();
                if (isset($_POST['pt-' . $id_examen . "-patient"])) {
                    $patient = trim(addslashes($_POST['pt-' . $id_examen . "-patient"]));
                    $temoin = trim(addslashes($_POST['pt-' . $id_examen . "-temoin"]));
                    $soit = trim(addslashes($_POST['pt-' . $id_examen . "-soit"]));
                    $inr = trim(addslashes($_POST['pt-' . $id_examen . "-inr"]));
                    $partial = trim(addslashes($_POST['pt-' . $id_examen . "-partial"]));
                    $pt->setPatient($patient);
                    $pt->setTemoin($temoin);
                    $pt->setSoit($soit);
                    $pt->setInr($inr);
                    $pt->setPartialThromboplastine($partial);
                    $pt->setIdResultat($dernierId);
                    $pt->add();
                }
            }
        }
        //pt ptt inr

        //frottis
        elseif ($categorie == "frottis") {
            //on enregistrer resultat urine routine
            \app\DefaultApp\Models\ResultatFrottis::supprimer($id_demande, $id_examen);
            $resultat_frottis = new \app\DefaultApp\Models\ResultatFrottis();
            $resultat_frottis->setIdDemande($id_demande);
            $resultat_frottis->setIdExament($id_examen);
            $msg = $resultat_frottis->add();

            if ($msg == "ok") {
                $dernierId = \app\DefaultApp\Models\ResultatFrottis::DernierId();
                if (isset($_POST['frottis-' . $id_examen . "-gramm"])) {
                    $frottis_gramm = trim(addslashes($_POST['frottis-' . $id_examen . "-gramm"]));
                    $goutes_pendantes = trim(addslashes($_POST['frottis-' . $id_examen . "-goute"]));
                    $fro = new \app\DefaultApp\Models\Frottis();
                    $fro->setIdResultat($dernierId);
                    $fro->setGouttesPendantes($goutes_pendantes);
                    $fro->setFrottisGramm($frottis_gramm);
                    $m = $fro->add();
                }
            }
        }
        //fin frottis

        //culture
        elseif ($categorie == "culture") {
            //on enregistrer resultat urine routine
            \app\DefaultApp\Models\ResultatCulture::supprimer($id_demande, $id_examen);
            $resultat_culture = new \app\DefaultApp\Models\ResultatCulture();
            $resultat_culture->setIdDemande($id_demande);
            $resultat_culture->setIdExament($id_examen);
            $msg = $resultat_culture->add();
            if ($msg == "ok") {
                $id_c = \app\DefaultApp\Models\ResultatCulture::DernierId();
                $cul = new \app\DefaultApp\Models\Culture();
                $cul->setIdResultat($id_c);
                if (isset($_POST['culture-' . $id_examen . "-source"])) {
                    $cul->setSource(trim(addslashes($_POST['culture-' . $id_examen . "-source"])));
                    $cul->setResultatFinal((trim(addslashes($_POST['culture-' . $id_examen . "-resultat"]))));

                    $cul->setC1((trim(addslashes($_POST['culture-' . $id_examen . "-c1"]))));
                    $cul->setv1((trim(addslashes($_POST['culture-' . $id_examen . "-v1"]))));

                    $cul->setC2((trim(addslashes($_POST['culture-' . $id_examen . "-c2"]))));
                    $cul->setv2((trim(addslashes($_POST['culture-' . $id_examen . "-v2"]))));

                    $cul->setC3((trim(addslashes($_POST['culture-' . $id_examen . "-c3"]))));
                    $cul->setv3((trim(addslashes($_POST['culture-' . $id_examen . "-v3"]))));

                    $cul->setC4((trim(addslashes($_POST['culture-' . $id_examen . "-c4"]))));
                    $cul->setv4((trim(addslashes($_POST['culture-' . $id_examen . "-v4"]))));

                    $cul->setC5((trim(addslashes($_POST['culture-' . $id_examen . "-c5"]))));
                    $cul->setv5((trim(addslashes($_POST['culture-' . $id_examen . "-v5"]))));

                    $cul->setC6((trim(addslashes($_POST['culture-' . $id_examen . "-c6"]))));
                    $cul->setv6((trim(addslashes($_POST['culture-' . $id_examen . "-v6"]))));

                    $cul->setC7((trim(addslashes($_POST['culture-' . $id_examen . "-c7"]))));
                    $cul->setv7((trim(addslashes($_POST['culture-' . $id_examen . "-v7"]))));

                    $cul->setC8((trim(addslashes($_POST['culture-' . $id_examen . "-c8"]))));
                    $cul->setv8((trim(addslashes($_POST['culture-' . $id_examen . "-v8"]))));

                    $cul->setC9((trim(addslashes($_POST['culture-' . $id_examen . "-c9"]))));
                    $cul->setv9((trim(addslashes($_POST['culture-' . $id_examen . "-v9"]))));

                    $cul->setC10((trim(addslashes($_POST['culture-' . $id_examen . "-c10"]))));
                    $cul->setv10((trim(addslashes($_POST['culture-' . $id_examen . "-v10"]))));

                    $cul->setC11((trim(addslashes($_POST['culture-' . $id_examen . "-c11"]))));
                    $cul->setv11((trim(addslashes($_POST['culture-' . $id_examen . "-v11"]))));

                    $cul->setC12((trim(addslashes($_POST['culture-' . $id_examen . "-c12"]))));
                    $cul->setv12((trim(addslashes($_POST['culture-' . $id_examen . "-v12"]))));

                    $cul->setC13((trim(addslashes($_POST['culture-' . $id_examen . "-c13"]))));
                    $cul->setv13((trim(addslashes($_POST['culture-' . $id_examen . "-v13"]))));

                    $cul->setC14((trim(addslashes($_POST['culture-' . $id_examen . "-c14"]))));
                    $cul->setv14((trim(addslashes($_POST['culture-' . $id_examen . "-v14"]))));

                    $cul->setC15((trim(addslashes($_POST['culture-' . $id_examen . "-c15"]))));
                    $cul->setv15((trim(addslashes($_POST['culture-' . $id_examen . "-v15"]))));

                    $cul->setC16((trim(addslashes($_POST['culture-' . $id_examen . "-c16"]))));
                    $cul->setv16((trim(addslashes($_POST['culture-' . $id_examen . "-v16"]))));
                    $m = $cul->add();
                }

            }
        }
        //fin culture

        //sinon
        else {
            $examen = "examen-" . $id_examen;
            $remarque = "remarque-" . $id_examen;
            if (isset($_POST[$examen])) {
                if (trim($_POST[$examen]) == "") {

                } else {
                    \app\DefaultApp\Models\ResultatLabo::supprimer($id_demande, $id_examen);
                    $resultatLabo = new \app\DefaultApp\Models\ResultatLabo();
                    $resultatLabo->setIdDemande($id_demande);
                    $resultatLabo->setIdExamens($id_examen);
                    $resultatLabo->setResultat(trim(addslashes($_POST[$examen])));
                    $resultatLabo->setGroupe("n/a");
                    $resultatLabo->setRemarque(trim(addslashes($_POST[$remarque])));
                    $resultatLabo->add();
                    $exlabo = new \app\DefaultApp\Models\ExamensDemandeLaboratoire();
                    $exlabo = $exlabo->rechercher($id_demande, $id_examen);
                    if ($exlabo !== null) {
                        $exlabo->setResultat(trim(addslashes($_POST[$examen])));
                        $exlabo->setRemarque(trim(addslashes($_POST[$remarque])));
                        $exlabo->setStatut(1);
                        $exlabo->update();
                    }
                }
            }
        }
        //fin sinon
    }


    if (isset($_POST['resultat'])) {
        echo "
    <script>
    alert('Modifier avec succes');
    document.location.href='ecrire-resultat-$id_demande';
    </script>
    ";
    }

    if (isset($_POST['fait'])) {
        echo "
     <script>
      alert('fait avec succes');
      document.location.href='ecrire-resultat-$id_demande';
     </script>
     ";
    }

}

if (isset($_POST['specimen'])) {
    $id_demande = $_POST['id_demande'];
    $lep = \app\DefaultApp\Models\Lep::listerParDemmande($id_demande);
    foreach ($lep as $l) {
        if (isset($_POST['ex-' . $l->getIdExamens()])) {
            $id_examen = $l->getIdExamens();
            $labo=new \app\DefaultApp\Models\Laboratoire();
            $labo=$labo->findById($id_examen);
            $exdl = \app\DefaultApp\Models\ExamensDemandeLaboratoire::rechercher($id_demande, $id_examen);
            $exdl->setStatut(1);
            $m = $exdl->update();
            if($m=="ok"){
                $demmande = new \app\DefaultApp\Models\DemmandeLaboratoire();
                $demmande = $demmande->findById($id_demande);
                $id_admision = $demmande->getIdAdmision();
                if ($id_admision != "n/a") {
                    $admision=new \app\DefaultApp\Models\Admision();
                    $admision=$admision->findById($id_admision);
                    $service=$admision->getServiceActuel();
                    $facture=\app\DefaultApp\Models\Facture::rechercherParAdmision($id_admision);

                    $item_facture = new \app\DefaultApp\Models\FactureItemDirect();
                    $item_facture->setIdFacture($facture->getId());
                    $item_facture->setIdItem($id_examen);
                    $item_facture->setCategorieItem("laboratoire");
                    $item_facture->setQuantite(1);
                    $item_facture->setPrix($labo->getPrix());
                    $item_facture->setIdBdc("n/a");
                    $item_facture->setJour(date("Y-m-d"));
                    $item_facture->setCouvert("oui");

                    $ser = new \app\DefaultApp\Models\Service();
                    $ser = $ser->findById($service);
                    $nom_service = $ser->getSigle();

                    if ($nom_service == "SSH") {
                        $item_facture->setQtSsh(1);
                        $item_facture->setQtSsc(0);
                        $item_facture->setQtSsu(0);
                    }
                    if ($nom_service == "SSU") {
                        $item_facture->setQtSsh(0);
                        $item_facture->setQtSsc(0);
                        $item_facture->setQtSsu(1);
                    }
                    if ($nom_service == "SSC") {
                        $item_facture->setQtSsh(0);
                        $item_facture->setQtSsc(1);
                        $item_facture->setQtSsu(0);
                    }
                    $m=$item_facture->add();
                }
            }
        }
    }
    if (isset($m)) {
        if ($m == "ok") {
            $demmande->setStatut("encour");
            $demmande->update();
            echo "ok";
        } else {
            echo $m;
        }
    } else {
        echo "choisir au moins une examens";
    }
}

if (isset($_POST['btnfait2'])) {
    $con = \app\DefaultApp\DefaultApp::connection();
    $id_demande = $_POST['id_demande'];
    $id_groupes = $_POST['id_groupe'];
    $ok = "";
    $tidg = explode(",", $id_groupes);
    foreach ($tidg as $value) {
        $id_groupe = $value;

        $req = "select id_examen from tbl_ge where id_groupe='" . $id_groupe . "'";
        $rs = $con->query($req);


        while ($datax = $rs->fetch()) {
            $id_examen = $datax['id_examen'];
            $examen = "examen-" . $id_examen;
            $remarque = "remarque-" . $id_examen;

            if (isset($_POST[$examen])) {
                $nomEx = \app\DefaultApp\Models\Exament::nomExament($id_examen);
                $categorie = \app\DefaultApp\Models\Exament::categorie($id_examen);

                if ($nomEx == "urine routines") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatUrineRoutine::supprimer($id_demande, $id_examen);
                    $resultat_urine = new \app\DefaultApp\Models\ResultatUrineRoutine();
                    $resultat_urine->setIdDemande($id_demande);
                    $resultat_urine->setIdExament($id_examen);
                    $msg = $resultat_urine->enregistrer();
                    if ($msg == "ok") {
                        //tout se passe bien
                        //on reucpere la dernier id;
                        $dernierIdUrine = \app\DefaultApp\Models\ResultatUrineRoutine::DernierId();
                        //recuper_microscopie et macroscopie
                        //macroscopie
                        $couleur = trim(addslashes($_POST['macro-' . $id_examen . "-couleur"]));
                        $aspect = trim(addslashes($_POST['macro-' . $id_examen . "-aspect"]));
                        $ph = trim(addslashes($_POST['macro-' . $id_examen . "-ph"]));
                        $reaction = trim(addslashes($_POST['macro-' . $id_examen . "-reaction"]));
                        $densite = trim(addslashes($_POST['macro-' . $id_examen . "-densite"]));
                        $albumine = trim(addslashes($_POST['macro-' . $id_examen . "-albumine"]));
                        $acetone = trim(addslashes($_POST['macro-' . $id_examen . "-acetone"]));
                        $leucocytes = trim(addslashes($_POST['macro-' . $id_examen . "-leucocytes"]));
                        $bilirubine = trim(addslashes($_POST['macro-' . $id_examen . "-bilirubine"]));
                        $nitrite = trim(addslashes($_POST['macro-' . $id_examen . "-nitrite"]));
                        $glucose = trim(addslashes($_POST['macro-' . $id_examen . "-glucose"]));
                        $sang = trim(addslashes($_POST['macro-' . $id_examen . "-sang"]));
                        $urobilinogene = trim(addslashes($_POST['macro-' . $id_examen . "-urobilinogene"]));

                        $macro = new \app\DefaultApp\Models\Macroscopie();
                        $macro->setCouleur($couleur);
                        $macro->setAspect($aspect);
                        $macro->setPh($ph);
                        $macro->setReaction($reaction);
                        $macro->setDensite($densite);
                        $macro->setAlbumine($albumine);
                        $macro->setAcetoneKetone($acetone);
                        $macro->setLeucocytes($leucocytes);
                        $macro->setBilirubine($bilirubine);
                        $macro->setNitrine($nitrite);
                        $macro->setGlucose($glucose);
                        $macro->setSang($sang);
                        $macro->setUrobilinogene($urobilinogene);
                        $macro->setIdResultat($dernierIdUrine);


                        $mmacro = $macro->enregistrer();
                        //microscopie
                        if ($mmacro == "ok") {
                            $id_macro = \app\DefaultApp\Models\Macroscopie::dernierId();
                            $depot = trim(addslashes($_POST['micro-' . $id_examen . "-depots"]));
                            $cylindres = trim(addslashes($_POST['micro-' . $id_examen . "-cylindre"]));
                            $hematies = trim(addslashes($_POST['micro-' . $id_examen . "-hematies"]));
                            $mucus = trim(addslashes($_POST['micro-' . $id_examen . "-mucus"]));
                            $globules = trim(addslashes($_POST['micro-' . $id_examen . "-globules"]));
                            $cellules = trim(addslashes($_POST['micro-' . $id_examen . "-cellules"]));
                            $bacteries = trim(addslashes($_POST['micro-' . $id_examen . "-bacteries"]));
                            $levures = trim(addslashes($_POST['micro-' . $id_examen . "-levures"]));
                            $cristaux = trim(addslashes($_POST['micro-' . $id_examen . "-cristaux"]));
                            $trichomonas = trim(addslashes($_POST['micro-' . $id_examen . "-trichomonas"]));
                            $autres = trim(addslashes($_POST['micro-' . $id_examen . "-autres"]));
                            $gravindex = trim(addslashes($_POST['micro-' . $id_examen . "-gravindex"]));

                            $micro = new \app\DefaultApp\Models\Microscopie();
                            $micro->setDepotsAmorphes($depot);
                            $micro->setCylindres($cylindres);
                            $micro->setHematies($hematies);
                            $micro->setMucus($mucus);
                            $micro->setGlobulesBlancs($globules);
                            $micro->setCellulesEpitheliales($cellules);
                            $micro->setBacteries($bacteries);
                            $micro->setLevures($levures);
                            $micro->setCristaux($cristaux);
                            $micro->setTrichomonas($trichomonas);
                            $micro->setAutre($autres);
                            $micro->setGravindex($gravindex);
                            $micro->setIdResultat($dernierIdUrine);
                            $mmicro = $micro->enregistrer();
                            echo $mmicro;
                            if ($mmicro == "ok") {

                            }
                        }


                    }

                } elseif ($nomEx == "selles routines") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatSelle::supprimer($id_demande, $id_examen);
                    $resultat_selle = new  \app\DefaultApp\Models\ResultatSelle();
                    $resultat_selle->setIdDemande($id_demande);
                    $resultat_selle->setIdExament($id_examen);
                    $msg = $resultat_selle->enregistrer();
                    if ($msg == "ok") {
                        //tout se passe bien
                        //on reucpere la dernier id;
                        $dernierIdselle = \app\DefaultApp\Models\ResultatSelle::DernierId();
                        //on recupere valeur de selle
                        $aspect = trim(addslashes($_POST['selle-' . $id_examen . "-aspect"]));
                        $consistance = trim(addslashes($_POST['selle-' . $id_examen . "-consistance"]));
                        $parasite = trim(addslashes($_POST['selle-' . $id_examen . "-parasite"]));
                        $autre = trim(addslashes($_POST['selle-' . $id_examen . "-autre"]));

                        $sel = new \app\DefaultApp\Models\Selle();
                        $sel->setIdResultat($dernierIdselle);
                        $sel->setAspect($aspect);
                        $sel->setConsistance($consistance);
                        $sel->setParasites($parasite);
                        $sel->setAutres($autre);
                        $sel->setNom("selle");
                        $mm = $sel->enregistrer();
                        echo $mm;

                    }
                } elseif ($nomEx == "selles en serie") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatSelle::supprimer($id_demande, $id_examen);
                    $resultat_selle = new \app\DefaultApp\Models\ResultatSelle();
                    $resultat_selle->setIdDemande($id_demande);
                    $resultat_selle->setIdExament($id_examen);
                    $msg = $resultat_selle->enregistrer();
                    if ($msg == "ok") {
                        //tout se passe bien
                        //on reucpere la dernier id;
                        $dernierIdselle = \app\DefaultApp\Models\ResultatSelle::DernierId();
                        //on recupere valeur de selle

                        //selle1
                        $aspect = trim(addslashes($_POST['selle1-' . $id_examen . "-aspect"]));
                        $consistance = trim(addslashes($_POST['selle1-' . $id_examen . "-consistance"]));
                        $parasite = trim(addslashes($_POST['selle1-' . $id_examen . "-parasite"]));
                        $autre = trim(addslashes($_POST['selle1-' . $id_examen . "-autre"]));

                        $sel = new \app\DefaultApp\Models\Selle();
                        $sel->setIdResultat($dernierIdselle);
                        $sel->setAspect($aspect);
                        $sel->setConsistance($consistance);
                        $sel->setParasites($parasite);
                        $sel->setAutres($autre);
                        $sel->setNom("selle1");
                        $mm = $sel->enregistrer();

                        //selle2
                        $aspect = trim(addslashes($_POST['selle2-' . $id_examen . "-aspect"]));
                        $consistance = trim(addslashes($_POST['selle2-' . $id_examen . "-consistance"]));
                        $parasite = trim(addslashes($_POST['selle2-' . $id_examen . "-parasite"]));
                        $autre = trim(addslashes($_POST['selle2-' . $id_examen . "-autre"]));
                        $sel = new \app\DefaultApp\Models\Selle();
                        $sel->setIdResultat($dernierIdselle);
                        $sel->setAspect($aspect);
                        $sel->setConsistance($consistance);
                        $sel->setParasites($parasite);
                        $sel->setAutres($autre);
                        $sel->setNom("selle2");
                        $mm = $sel->enregistrer();

                        //selle3
                        $aspect = trim(addslashes($_POST['selle3-' . $id_examen . "-aspect"]));
                        $consistance = trim(addslashes($_POST['selle3-' . $id_examen . "-consistance"]));
                        $parasite = trim(addslashes($_POST['selle3-' . $id_examen . "-parasite"]));
                        $autre = trim(addslashes($_POST['selle3-' . $id_examen . "-autre"]));
                        $sel = new \app\DefaultApp\Models\Selle();
                        $sel->setIdResultat($dernierIdselle);
                        $sel->setAspect($aspect);
                        $sel->setConsistance($consistance);
                        $sel->setParasites($parasite);
                        $sel->setAutres($autre);
                        $sel->setNom("selle3");
                        $mm = $sel->enregistrer();

                        //selle4
                        $bleu = trim(addslashes($_POST['selle4-' . $id_examen . "-bleu"]));
                        $sang = trim(addslashes($_POST['selle4-' . $id_examen . "-sang"]));
                        $remarque = trim(addslashes($_POST['selle4-' . $id_examen . "-remarque"]));
                        $sel = new \app\DefaultApp\Models\Selle();
                        $sel->setIdResultat($dernierIdselle);
                        $sel->setBleuDeMethylene($bleu);
                        $sel->setSangOcculte($sang);
                        $sel->setRemarque($remarque);
                        $sel->setNom("selle4");
                        $mm = $sel->enregistrer();
                        echo $mm;

                    }
                } elseif ($nomEx == "crachat") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatCrachat::supprimer($id_demande, $id_examen);
                    $resultat_crachat = new \app\DefaultApp\Models\ResultatCrachat();
                    $resultat_crachat->setIdDemande($id_demande);
                    $resultat_crachat->setIdExament($id_examen);
                    $msg = $resultat_crachat->enregistrer();
                    if ($msg == "ok") {
                        //tout se passe bien
                        //on reucpere la dernier id;
                        $dernierIdcrachat = \app\DefaultApp\Models\ResultatCrachat::DernierId();
                        //on recupere valeur de crachat
                        $coloration = trim(addslashes($_POST['crachat-' . $id_examen . "-coloration"]));
                        $remarque = trim(addslashes($_POST['crachat-' . $id_examen . "-remarque"]));

                        $cr = new \app\DefaultApp\Models\Crachat();
                        $cr->setIdResultat($dernierIdcrachat);
                        $cr->setColorationZeihlNeelsen($coloration);
                        $cr->setRemarque($remarque);
                        $cr->setNom("crachat");
                        $mm = $cr->enregistrer();
                        echo $mm;

                    }
                } elseif ($nomEx == "crachat en serie") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatCrachat::supprimer($id_demande, $id_examen);
                    $resultat_crachat = new \app\DefaultApp\Models\ResultatCrachat();
                    $resultat_crachat->setIdDemande($id_demande);
                    $resultat_crachat->setIdExament($id_examen);
                    $msg = $resultat_crachat->enregistrer();
                    if ($msg == "ok") {
                        //tout se passe bien
                        //on reucpere la dernier id;
                        $dernierIdcrachat = \app\DefaultApp\Models\ResultatCrachat::DernierId();
                        //on recupere valeur de crachat

                        $coloration = trim(addslashes($_POST['crachat1-' . $id_examen . "-coloration"]));
                        $remarque = trim(addslashes($_POST['crachat1-' . $id_examen . "-remarque"]));

                        $cr = new \app\DefaultApp\Models\Crachat();
                        $cr->setIdResultat($dernierIdcrachat);
                        $cr->setColorationZeihlNeelsen($coloration);
                        $cr->setRemarque($remarque);
                        $cr->setNom("crachat1");
                        $mm = $cr->enregistrer();

                        $coloration = trim(addslashes($_POST['crachat2-' . $id_examen . "-coloration"]));
                        $remarque = trim(addslashes($_POST['crachat2-' . $id_examen . "-remarque"]));

                        $cr = new \app\DefaultApp\Models\Crachat();
                        $cr->setIdResultat($dernierIdcrachat);
                        $cr->setColorationZeihlNeelsen($coloration);
                        $cr->setRemarque($remarque);
                        $cr->setNom("crachat2");
                        $mm = $cr->enregistrer();

                        $coloration = trim(addslashes($_POST['crachat3-' . $id_examen . "-coloration"]));
                        $remarque = trim(addslashes($_POST['crachat3-' . $id_examen . "-remarque"]));

                        $cr = new \app\DefaultApp\Models\Crachat();
                        $cr->setIdResultat($dernierIdcrachat);
                        $cr->setColorationZeihlNeelsen($coloration);
                        $cr->setRemarque($remarque);
                        $cr->setNom("crachat3");
                        $mm = $cr->enregistrer();

                        echo $mm;

                    }

                } elseif ($nomEx == "liquide pleural") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatLiquidePleural::supprimer($id_demande, $id_examen);
                    $resultat_pleural = new \app\DefaultApp\Models\ResultatLiquidePleural();
                    $resultat_pleural->setIdDemande($id_demande);
                    $resultat_pleural->setIdExament($id_examen);
                    $msg = $resultat_pleural->enregistrer();
                    if ($msg == "ok") {
                        $dernierId = \app\DefaultApp\Models\ResultatLiquidePleural::DernierId();
                        $source = trim(addslashes($_POST['pleural-' . $id_examen . "-source"]));
                        $couleur = trim(addslashes($_POST['pleural-' . $id_examen . "-couleur"]));
                        $transparence = trim(addslashes($_POST['pleural-' . $id_examen . "-transparence"]));
                        $globule_blanc = trim(addslashes($_POST['pleural-' . $id_examen . "-globule_blanc"]));
                        $globule_rouge = trim(addslashes($_POST['pleural-' . $id_examen . "-globule_rouge"]));
                        $neutrophile = trim(addslashes($_POST['pleural-' . $id_examen . "-neutrophile"]));
                        $lymphocytes = trim(addslashes($_POST['pleural-' . $id_examen . "-lymphocyte"]));
                        $rivalta = trim(addslashes($_POST['pleural-' . $id_examen . "-rivalta"]));
                        $glucose = trim(addslashes($_POST['pleural-' . $id_examen . "-glucose"]));
                        $proteine = trim(addslashes($_POST['pleural-' . $id_examen . "-proteine"]));

                        $li = new \app\DefaultApp\Models\LiquidePleural();
                        $li->setIdResultat($dernierId);
                        $li->setSource($source);
                        $li->setCouleur($couleur);
                        $li->setTransparence($transparence);
                        $li->setGlobulesBlancs($globule_blanc);
                        $li->setGlobulesRouges($globule_rouge);
                        $li->setNeutrophiles($neutrophile);
                        $li->setLymphocytes($lymphocytes);
                        $li->setRivalta($rivalta);
                        $li->setGlucose($glucose);
                        $li->setProteines($proteine);

                        $msg = $li->enregistrer();
                        echo $msg;

                    }
                } elseif ($categorie == "frottis") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatFrottis::supprimer($id_demande, $id_examen);
                    $resultat_frottis = new \app\DefaultApp\Models\ResultatFrottis();
                    $resultat_frottis->setIdDemande($id_demande);
                    $resultat_frottis->setIdExament($id_examen);
                    $msg = $resultat_frottis->enregistrer();

                    if ($msg == "ok") {
                        $dernierId = \app\DefaultApp\Models\ResultatFrottis::DernierId();
                        $frottis_gramm = trim(addslashes($_POST['frottis-' . $id_examen . "-gramm"]));
                        $goutes_pendantes = trim(addslashes($_POST['frottis-' . $id_examen . "-goute"]));
                        $fro = new \app\DefaultApp\Models\Frottis();
                        $fro->setIdResultat($dernierId);
                        $fro->setGouttesPendantes($goutes_pendantes);
                        $fro->setFrottisGramm($frottis_gramm);
                        $m = $fro->enregistrer();
                        echo $m;
                    }
                } elseif ($categorie == "culture") {
                    //on enregistrer resultat urine routine
                    \app\DefaultApp\Models\ResultatCulture::supprimer($id_demande, $id_examen);
                    $resultat_culture = new \app\DefaultApp\Models\ResultatCulture();
                    $resultat_culture->setIdDemande($id_demande);
                    $resultat_culture->setIdExament($id_examen);
                    $msg = $resultat_culture->enregistrer();

                    if ($msg == "ok") {
                        $id_c = \app\DefaultApp\Models\ResultatCulture::DernierId();
                        $cul = new \app\DefaultApp\Models\Culture();
                        $cul->setIdResultat($id_c);
                        $cul->setSource(trim(addslashes($_POST['culture-' . $id_examen . "-source"])));
                        $cul->setResultatFinal((trim(addslashes($_POST['culture-' . $id_examen . "-resultat"]))));

                        $cul->setC1((trim(addslashes($_POST['culture-' . $id_examen . "-c1"]))));
                        $cul->setv1((trim(addslashes($_POST['culture-' . $id_examen . "-v1"]))));

                        $cul->setC2((trim(addslashes($_POST['culture-' . $id_examen . "-c2"]))));
                        $cul->setv2((trim(addslashes($_POST['culture-' . $id_examen . "-v2"]))));

                        $cul->setC3((trim(addslashes($_POST['culture-' . $id_examen . "-c3"]))));
                        $cul->setv3((trim(addslashes($_POST['culture-' . $id_examen . "-v3"]))));

                        $cul->setC4((trim(addslashes($_POST['culture-' . $id_examen . "-c4"]))));
                        $cul->setv4((trim(addslashes($_POST['culture-' . $id_examen . "-v4"]))));

                        $cul->setC5((trim(addslashes($_POST['culture-' . $id_examen . "-c5"]))));
                        $cul->setv5((trim(addslashes($_POST['culture-' . $id_examen . "-v5"]))));

                        $cul->setC6((trim(addslashes($_POST['culture-' . $id_examen . "-c6"]))));
                        $cul->setv6((trim(addslashes($_POST['culture-' . $id_examen . "-v6"]))));

                        $cul->setC7((trim(addslashes($_POST['culture-' . $id_examen . "-c7"]))));
                        $cul->setv7((trim(addslashes($_POST['culture-' . $id_examen . "-v7"]))));

                        $cul->setC8((trim(addslashes($_POST['culture-' . $id_examen . "-c8"]))));
                        $cul->setv8((trim(addslashes($_POST['culture-' . $id_examen . "-v8"]))));

                        $cul->setC9((trim(addslashes($_POST['culture-' . $id_examen . "-c9"]))));
                        $cul->setv9((trim(addslashes($_POST['culture-' . $id_examen . "-v9"]))));

                        $cul->setC10((trim(addslashes($_POST['culture-' . $id_examen . "-c10"]))));
                        $cul->setv10((trim(addslashes($_POST['culture-' . $id_examen . "-v10"]))));

                        $cul->setC11((trim(addslashes($_POST['culture-' . $id_examen . "-c11"]))));
                        $cul->setv11((trim(addslashes($_POST['culture-' . $id_examen . "-v11"]))));

                        $cul->setC12((trim(addslashes($_POST['culture-' . $id_examen . "-c12"]))));
                        $cul->setv12((trim(addslashes($_POST['culture-' . $id_examen . "-v12"]))));

                        $cul->setC13((trim(addslashes($_POST['culture-' . $id_examen . "-c13"]))));
                        $cul->setv13((trim(addslashes($_POST['culture-' . $id_examen . "-v13"]))));

                        $cul->setC14((trim(addslashes($_POST['culture-' . $id_examen . "-c14"]))));
                        $cul->setv14((trim(addslashes($_POST['culture-' . $id_examen . "-v14"]))));

                        $cul->setC15((trim(addslashes($_POST['culture-' . $id_examen . "-c15"]))));
                        $cul->setv15((trim(addslashes($_POST['culture-' . $id_examen . "-v15"]))));

                        $cul->setC16((trim(addslashes($_POST['culture-' . $id_examen . "-c16"]))));
                        $cul->setv16((trim(addslashes($_POST['culture-' . $id_examen . "-v16"]))));

                        $m = $cul->enregistrer();
                        echo $m;
                    }
                } else {
                    $examen = "examen-" . $id_examen;
                    $remarque = "remarque-" . $id_examen;

                    if (isset($_POST[$examen])) {

                        if (trim($_POST[$examen]) == "") {
                            echo $examen;
                        } else {

                            $rq3 = "DELETE FROM resultat_labo WHERE demande='" . $id_demande . "' AND examen='" . $id_examen . "' AND groupe=''";
                            $con->query($rq3);
                            $req = "INSERT INTO resultat_labo (demande,examen,resultat,groupe,remarque) VALUES ('" . $id_demande . "','" . $id_examen . "','" . trim(addslashes($_POST[$examen])) . "','','" . trim(addslashes($_POST[$remarque])) . "')";
                            $con->query($req);

                            $rra = "UPDATE tbl_examen_demande_laboratoire SET statut='pret',resultat='" . trim(addslashes($_POST[$examen])) . "',remarque='" . trim(addslashes($_POST[$remarque])) . "'
                   WHERE id_demande='" . $id_demande . "' AND id_exament='" . $id_examen . "'";
                            $con->query($rra);
                        }
                    }
                }

            }

        }
    }
    if ($ok == "ok") {
        $rqe4 = "UPDATE tbl_labo_patient SET statut2='pending' WHERE id='" . $id_demande . "'";
        $con->query($rqe4);
    }

    if (isset($_POST['resultat'])) {
        echo "
    <script>
    alert('Modifier avec succes');
    document.location.href='patient.php?section=resultat_labo&id_demande=$id_demande'; 
    </script>
    ";
    }

    if (isset($_POST['fait'])) {
        echo "
    <script>
    alert('fait avec succes');
    document.location.href='ecrire-resultat-$id_demande';
    </script>
    ";
    }

}


if (isset($_POST['ajouter_groupe'])) {
    $groupe = trim(addslashes($_POST['groupe']));
    if ($groupe == "") {
        echo "entrer un nom de groupe";
        return;
    }

    $gp = new \app\DefaultApp\Models\GroupeExamensLaboratoire();
    $gp->setNomGroupe($groupe);
    $gp->setCout(0);
    $gp->setPrixVente(0);
    $m = $gp->add();
    echo $m;
}

if (isset($_POST['modifier_groupe'])) {
    $ge = new \app\DefaultApp\Models\GroupeExamensLaboratoire();
    $labo = new \app\DefaultApp\Models\Laboratoire();
    $id_groupe = $_POST['id'];
    $nom_groupe = trim(addslashes($_POST['nom_groupe']));
    //on modifie le groupe exament
    $groupe_ex = $ge->findById($id_groupe);
    $groupe_ex->setNomGroupe($nom_groupe);
    $m = $groupe_ex->update();

    if ($m == "ok") {
        $lexamens = $labo->findAll();
        foreach ($lexamens as $ex) {
            if (isset($_POST[$ex->getId()])) {
                if (!\app\DefaultApp\Models\GroupeExamensLaboratoire::siExamenGroupe($ex->getId(), $id_groupe)) {
                    \app\DefaultApp\Models\GroupeExamensLaboratoire::insertGe($ex->getId(), $id_groupe);
                }
            } else {
                \app\DefaultApp\Models\GroupeExamensLaboratoire::deleteGe($ex->getId(), $id_groupe);
            }
        }
        //on modifie le prix de vente
        $m = \app\DefaultApp\Models\GroupeExamensLaboratoire::modifierPrix($id_groupe);
        echo $m;
    }
}