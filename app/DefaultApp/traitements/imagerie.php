<?php
date_default_timezone_set("America/Port-au-Prince");
require_once "../../../vendor/autoload.php";

if (isset($_POST['demmande_imagerie'])) {
    $imagerie=new \app\DefaultApp\Models\Imagerie();
    $con = \systeme\Application\Application::connection();
    $demmande = new \app\DefaultApp\Models\DemmandeImagerie();

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
    if(isset($_POST['id_admision'])){
        $demmande->setIdAdmision($_POST['id_admision']);
    }else{
        $demmande->setIdAdmision("n/a");
    }
    $m = $demmande->add();
    if ($m == "ok") {
        $id_demande = \app\DefaultApp\Models\DemmandeImagerie::dernierId();
        $listeImagerie = $imagerie->findAll();
        foreach ($listeImagerie as $img) {
            $id = $img->getId();
            if (isset($_POST[$id])) {
                $id_examen = $_POST[$id];
                $examensImg = new \app\DefaultApp\Models\ExamensDemandeImagerie();
                $examensImg->setIdDemande($id_demande);
                $examensImg->setIdImagerie($id_examen);
                $examensImg->setStatut("n/a");
                $examensImg->setResultat("n/a");
                $examensImg->setRemarque("n/a");
                $mm = $examensImg->add();
            }
        }
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
    $imagerie= new \app\DefaultApp\Models\Imagerie();
    $id_demande = $_POST['id_demande'];
    $id_examens=$_POST['id_examens'];
    $remarque=trim(addslashes($_POST['remarque']));
    if($remarque==""){
        $remarque="n/a";
    }

    $examensDemandeImagerie=\app\DefaultApp\Models\ExamensDemandeImagerie::rechercher($id_demande,$id_examens);
    if(isset($_FILES['fichier']['name'])){
        $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],"resultat_imagerie_$id_demande");
        if($fichier->Upload()){
            $examensDemandeImagerie->setResultat($fichier->getSrc());
            $examensDemandeImagerie->setRemarque($remarque);
            $m=$examensDemandeImagerie->update();
            echo $m;
        }else{
            echo "Imposible d'ecrire le resultat";
        }
    }else{
        echo "Choisir un ficier";
    }

}

if(isset($_POST['specimen'])){
    $id_demande=$_POST['id_demande'];
    $lep=\app\DefaultApp\Models\ExamensDemandeImagerie::listerParDemmande($id_demande);
    foreach ($lep as $l){
        if(isset($_POST['ex-'.$l->getIdImagerie()])){
            $id_examen=$l->getIdImagerie();
            $exdl=\app\DefaultApp\Models\ExamensDemandeImagerie::rechercher($id_demande,$id_examen);
            $exdl->setStatut(1);
            $m=$exdl->update();
            if($m=="ok"){
                $demmande = new \app\DefaultApp\Models\DemmandeImagerie();
                $demmande = $demmande->findById($id_demande);
                $id_admision = $demmande->getIdAdmision();
                $labo=new \app\DefaultApp\Models\Imagerie();
                $labo=$labo->findById($id_examen);
                if ($id_admision != "n/a") {
                    $admision=new \app\DefaultApp\Models\Admision();
                    $admision=$admision->findById($id_admision);
                    $service=$admision->getServiceActuel();
                    $facture=\app\DefaultApp\Models\Facture::rechercherParAdmision($id_admision);
                    $item_facture = new \app\DefaultApp\Models\FactureItemDirect();
                    $item_facture->setIdFacture($facture->getId());
                    $item_facture->setIdItem($id_examen);
                    $item_facture->setCategorieItem("imagerie");
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
    if(isset($m)){
        if($m=="ok"){
            echo "ok";
        }else{
            echo $m;
        }
    }else{
        echo "choisir au moins une examens";
    }
}
