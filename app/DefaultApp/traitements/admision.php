<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 4/27/2020
 * Time: 5:53 PM
 */
require_once "../../../vendor/autoload.php";
if (isset($_GET['type_chambre'])) {
    $type = $_POST['type'];
    $service = $_POST['service'];
    $liste = \app\DefaultApp\Models\Lit::listerParTypeLibre($type, $service);
    if (count($liste) > 0) {
        foreach ($liste as $lit) {
            ?>
            <option value="<?= $lit->getId() ?>"><?= strtoupper($lit->getNom()); ?></option>
            <?php
        }
    } else {
        ?>
        <option value="">Pas de lit disponible pour chambre <?= $type ?></option>
        <?php
    }

}

if (isset($_POST['ajouter_admision'])) {
    $type_admision = trim(addslashes($_POST['type_admision']));
    $id_patient = trim(addslashes($_POST['id_patient']));
    $id_medecin = trim(addslashes($_POST['id_medecin']));
    $id_anesthesiste = trim(addslashes($_POST['id_anesthesiste']));
    $admis_via = trim(addslashes($_POST['admis_via']));
    $date_prevue_admision = trim(addslashes($_POST['date_prevue_admision']));
    $dpa = trim(addslashes($_POST['dpa']));
    $admis_pour = trim(addslashes($_POST['admis_pour']));
    $no_confirmation = trim(addslashes($_POST['no_confirmation']));
    if (isset($_POST['lit'])) {
        $id_lit = trim(addslashes($_POST['lit']));
    } else {
        $id_lit = "n/a";
    }

    $nombre_jour_prevue = trim(addslashes($_POST['nombre_jour_prevue']));
    $intervention = trim(addslashes($_POST['intervention']));
    $date_prevue_intervention = trim(addslashes($_POST['date_prevue_intervention']));
    $heure_prevue_intervention = trim(addslashes($_POST['heure_prevue_intervention']));
    $info_aditionele = trim(addslashes($_POST['info_aditionele']));
    $motif = trim(addslashes($_POST['motif']));
    $nom_accp1 = trim(addslashes($_POST['nom_accp1']));
    $adresse_accp1 = trim(addslashes($_POST['adresse_accp1']));
    $telephone_accp1 = trim(addslashes($_POST['telephone_accp1']));
    $nom_accp2 = trim(addslashes($_POST['nom_accp2']));
    $adresse_accp2 = trim(addslashes($_POST['adresse_accp2']));
    $telephone_accp2 = trim(addslashes($_POST['telephone_accp2']));

    $admision = new \app\DefaultApp\Models\Admision();
    if (isset($_POST['id_admision'])) {
        $admision = $admision->findById($_POST['id_admision']);
    }

    $admision->setIdPatient($id_patient);
    $admision->setIdMedecin($id_medecin);
    $admision->setIdAnesthesiste($id_anesthesiste);
    $admision->setAdmisVia($admis_via);
    $admision->setDatePrevueAdmision($date_prevue_admision);
    $admision->setDpa($dpa);
    $admision->setAdmisPour($admis_pour);
    $admision->setNoConfirmation($no_confirmation);
    $admision->setIdLit($id_lit);
    $admision->setNombreJourPrevue($nombre_jour_prevue);
    $admision->setIntervention($intervention);
    $admision->setDatePrevueIntervention($date_prevue_intervention);
    $admision->setHeurePrevueIntervention($heure_prevue_intervention);
    $admision->setInfoAdditionel($info_aditionele);
    $admision->setMotif($motif);

    $admision->setAdresseAccp1($adresse_accp1);
    $admision->setNomAccp1($nom_accp1);
    $admision->setTelephoneAccp1($telephone_accp1);

    $admision->setAdresseAccp2($adresse_accp2);
    $admision->setNomAccp2($nom_accp2);
    $admision->setTelephoneAccp2($telephone_accp2);

    $admision->setServiceActuel($admis_via);
    $admision->setTypeAdmision($type_admision);
    $admision->setStatut("en cour");
    $admision->setStatutExeat(0);
    $admision->setDiagnostique("n/a");
    $admision->setDateEnregistrement(date("Y-m-d h:i:s"));
    $admision->setComplainte("n/a");
    $admision->setTrauma("n/a");
    $admision->setStatutIntervention("n/a");

    if(isset($_POST['complainte'])){
        $complainte=trim(addslashes($_POST['complainte']));
        $admision->setComplainte($complainte);
    }

    if(isset($_POST['trauma'])){
        $trauma=trim(addslashes($_POST['trauma']));
        $admision->setTrauma($trauma);
    }

    if(isset($_POST['a']))
    {
        $a=trim(addslashes($_POST['a']));
        $b=trim(addslashes($_POST['b']));
        $c=trim(addslashes($_POST['c']));
        $admision->setA($a);
        $admision->setB($b);
        $admision->setC($c);

    }


    if (isset($_POST['id_admision'])) {
        $m = $admision->update();
    } else {
        $m = $admision->add();
    }

    if ($m == "ok") {
        if ($type_admision == "admision" and \app\DefaultApp\Models\Service::nonService($admis_via) != "SSC") {
            $id_admision = \app\DefaultApp\Models\Admision::dernierId();
            $parcourAdm = new \app\DefaultApp\Models\AdmisionParcour();
            $parcourAdm->setIdAdmision($id_admision);
            $parcourAdm->setService($admis_via);
            $parcourAdm->setDateEntrer(date("Y-m-d h:i:s"));
            $parcourAdm->setDateSortie("n/a");
            $parcourAdm->setLit($id_lit);
            $mm = $parcourAdm->add();
            if ($mm == "ok") {
                $mx = \app\DefaultApp\Models\Lit::occuperLit($id_lit);
                if (isset($_POST['id_admision'])) {
                    echo $mx;
                } else {
                    $facture = new \app\DefaultApp\Models\Facture();
                    $facture->setIdAdmision($id_admision);
                    $facture->setNo(rand(0, 1000) . "" . rand(1001, 9999));
                    $facture->setStatut("n/a");
                    $facture->setDateEnregistrement(date("Y-m-d h:i:s"));
                    $facture->setDateModification(date("Y-m-d h:i:s"));
                    $facture->setTotalFacture(0);
                    $facture->setCategoriePrix("normal");
                    $facture->setDeduction(0);
                    $facture->setTotalAssurance(0);
                    $facture->setTotalPatient(0);
                    $facture->setBalance(0);
                    $facture->setTag("n/a");
                    $m = $facture->add();
                    if ($m == "ok") {
                        $id_facture = \app\DefaultApp\Models\Facture::dernierId();
                        $itmf = new \app\DefaultApp\Models\FactureItemDirect();
                        $itmf->setIdFacture($id_facture);
                        $itmf->setIdItem($id_lit);
                        $itmf->setCategorieItem("lit");
                        $itmf->setQuantite(1);
                        $itmf->setJour(date("Y-m-d"));
                        $itmf->setCouvert("oui");
                        $itmf->setQtSsh(0);
                        $itmf->setQtSsc(0);
                        $itmf->setQtSsu(1);
                        $itmf->setPrix(0);
                        $ma = $itmf->add();
                        echo $ma;
                    } else {
                        echo $m;
                    }
                }
            } else {
                echo $mm;
            }
        } else {
            echo $m;
        }
    } else {
        echo $m;
    }

}

if (isset($_POST['transfert_lit'])) {
    $id_admision = $_POST['id_admision'];
    $admision = new \app\DefaultApp\Models\Admision();
    $admision = $admision->findById($id_admision);
    $nouvel_lit = $_POST['nouvel_lit'];
    $lit_actuel = $_POST['lit_actuel'];
    if ($nouvel_lit == "$lit_actuel") {
        echo "imposible de fair le transfert";
        return;
    }

    $raison = trim(addslashes($_POST['raison']));
    $dernierParcour = \app\DefaultApp\Models\AdmisionParcour::dernierParcour($id_admision);
    $dernierParcour->setDateSortie(date("Y-m-d h:i:s"));
    $m = $dernierParcour->update();
    if ($m == "ok") {
        $dp = new \app\DefaultApp\Models\AdmisionParcour();
        $dp->setLit($nouvel_lit);
        $dp->setDateEntrer(date("Y-m-d h:i:s"));
        $dp->setDateSortie("n/a");
        $dp->setService($dernierParcour->getService());
        $dp->setIdAdmision($id_admision);
        $dp->setTransfert("oui");
        $dp->setRaisonTransfert($raison);
        $mp = $dp->add();
        if ($mp == "ok") {
            \app\DefaultApp\Models\Lit::occuperLit($nouvel_lit);
            \app\DefaultApp\Models\Lit::libererLit($lit_actuel);
            $admision->setIdLit($nouvel_lit);
            $mad = $admision->update();
            echo $mad;
        } else {
            echo $mp;
        }
    } else {
        echo $m;
    }
}

if (isset($_POST['transfert_service'])) {
    $id_admision = $_POST['id_admision'];
    $admision = new \app\DefaultApp\Models\Admision();
    $admision = $admision->findById($id_admision);
    $nouvel_lit = $_POST['nouveau_lit'];
    $lit_actuel = $_POST['lit_actuel'];
    if ($nouvel_lit == "$lit_actuel") {
        echo "imposible de fair le transfert, choisir un autre lit";
        return;
    }
    $service_actuel = $_POST['service_actuel'];
    $nouveau_service = $_POST['nouveau_service'];
    if ($service_actuel == $nouveau_service) {
        echo "Imposible de faire le transfert , Choisir un autre service";
        return;
    }

    $raison = trim(addslashes($_POST['raison']));
    $dernierParcour = \app\DefaultApp\Models\AdmisionParcour::dernierParcour($id_admision);
    $dernierParcour->setDateSortie(date("Y-m-d h:i:s"));

    $m = $dernierParcour->update();
    if ($m == "ok") {
        $dp = new \app\DefaultApp\Models\AdmisionParcour();
        $dp->setLit($nouvel_lit);
        $dp->setDateEntrer(date("Y-m-d h:i:s"));
        $dp->setDateSortie("n/a");
        $dp->setService($nouveau_service);
        $dp->setIdAdmision($id_admision);
        $dp->setTransfert("oui");
        $dp->setRaisonTransfert($raison);
        $mp = $dp->add();
        if ($mp == "ok") {
            \app\DefaultApp\Models\Lit::occuperLit($nouvel_lit);
            \app\DefaultApp\Models\Lit::libererLit($lit_actuel);
            $admision->setIdLit($nouvel_lit);
            $admision->setServiceActuel($nouveau_service);
            $mad = $admision->update();
            echo $mad;
        } else {
            echo $mp;
        }
    } else {
        echo $m;
    }
}

if (isset($_POST['update_ssc'])) {
    $id_admision = $_POST['id_admision'];
    $admision = new \app\DefaultApp\Models\Admision();

    $admision = $admision->findById($id_admision);

    $lit = $_POST['nouvel_lit'];
    $intervention = trim(addslashes($_POST['intervention']));
    $date_prevue_intervention = trim(addslashes($_POST['date_prevue_intervention']));
    $heure_prevue_intervention = trim(addslashes($_POST['heure_prevue_intervention']));
    $info_aditionele = trim(addslashes($_POST['info_aditionele']));

    $admision->setIdLit($lit);
    $admision->setInfoAdditionel($info_aditionele);
    $admision->setIntervention($intervention);
    $admision->setDatePrevueIntervention($date_prevue_intervention);
    $admision->setHeurePrevueIntervention($heure_prevue_intervention);
    $admision->setStatutIntervention("enregistrer");
    $admision->setStatutExeat(0);
    $m = $admision->update();
    if ($m == "ok") {
        $parcourAdm = new \app\DefaultApp\Models\AdmisionParcour();
        $parcourAdm->setIdAdmision($id_admision);
        $parcourAdm->setService($admision->getServiceActuel());
        $parcourAdm->setDateEntrer(date("Y-m-d h:i:s"));
        $parcourAdm->setDateSortie("n/a");
        $parcourAdm->setLit($lit);
        $mm = $parcourAdm->add();
        if ($mm == "ok") {
            $mx = \app\DefaultApp\Models\Lit::occuperLit($lit);
            $facture = new \app\DefaultApp\Models\Facture();
            $facture->setIdAdmision($id_admision);
            $facture->setNo(rand(0, 1000) . "" . rand(1001, 9999));
            $facture->setStatut("n/a");
            $facture->setDateEnregistrement(date("Y-m-d h:i:s"));
            $facture->setDateModification(date("Y-m-d h:i:s"));
            $facture->setTotalFacture(0);
            $facture->setCategoriePrix("normal");
            $facture->setDeduction(0);
            $facture->setTotalAssurance(0);
            $facture->setTotalPatient(0);
            $facture->setBalance(0);
            $facture->setTag("n/a");
            $m = $facture->add();
            if ($m == "ok") {
                $id_facture = \app\DefaultApp\Models\Facture::dernierId();
                $itmf = new \app\DefaultApp\Models\FactureItemDirect();
                $itmf->setIdFacture($id_facture);
                $itmf->setIdItem($lit);
                $itmf->setCategorieItem("lit");
                $itmf->setQuantite(1);
                $itmf->setJour(date("Y-m-d"));
                $itmf->setCouvert("oui");
                $itmf->setQtSsh(0);
                $itmf->setQtSsc(1);
                $itmf->setQtSsu(0);
                $itmf->setPrix(0);
                $ma = $itmf->add();
                echo $ma;
            } else {
                echo $m;
            }
        }

    } else {
        echo $m;
    }


}