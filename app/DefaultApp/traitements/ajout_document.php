<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 19/03/2019
 * Time: 13:36
 */
require_once "../../../vendor/autoload.php";

if(isset($_POST['ajout_employer'])){
    $id_employer = $_POST['id_employer'];
    $nom = trim(addslashes($_POST['nom']));
    $emp=new \app\DefaultApp\Models\Employer();
    $emp=$emp->findById($id_employer);
    if($emp===null){
        echo "dossier employer introuvable";
        return;
    }

    $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],sha1($nom."_".$emp->getNom().$emp->getPrenom()));

    $documentEmployer = new \app\DefaultApp\Models\DocumentEmployer();
    $documentEmployer->setIdEmployer($id_employer);
    $documentEmployer->setNom($nom);
    if($fichier->Upload()){
        $documentEmployer->setImage($fichier->getSrc());
        $m = $documentEmployer->add();
        if ($m == "ok") {
            ?>
            <table style="width:100%" class="table table-bordered ">
                <tr>
                    <th>Nom</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                $listeDocument = \app\DefaultApp\Models\DocumentEmployer::listerParEnployer($id_employer);
                if (count($listeDocument) > 0) {
                    foreach ($listeDocument as $dc) {
                        ?>
                        <tr>
                            <td><?= stripslashes($dc->getNom()); ?></td>
                            <td><a href="<?= $dc->getImage(); ?>" class="btn btn-warning btn-xs">Afficher</a></td>
                            <td><a class="btn btn-primary btn-xs bt_sup" data-id="<?= $dc->getId(); ?>" data-id_medecin="<?= $id_employer ?>"></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php
        } else {
            echo $m;
        }
    }else{
        echo "IMposible d'ajouter le document";
        return;
    }


}

if(isset($_GET['supe'])){
    $id = $_GET['id'];
    $id_employer = $_GET['id_employer'];
    $dc=new \app\DefaultApp\Models\DocumentEmployer();
    $dc->deleteById($id);
    ?>
    <table style="width:100%" class="table table-bordered ">
        <tr>
            <th>Nom</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        $listeDocument = \app\DefaultApp\Models\DocumentEmployer::listerParEnployer($id_employer);
        if (count($listeDocument) > 0) {
            foreach ($listeDocument as $dc) {
                ?>
                <tr>
                    <td><?= $dc->getNom(); ?></td>
                    <td><a href="<?= $dc->getImage(); ?>" class="btn btn-warning btn-xs">Afficher</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <?php
}

if(isset($_POST['ajout_patient'])){
    $id_patient = $_POST['id_patient'];
    $nom = trim(addslashes($_POST['nom']));

    $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name']);
    if($fichier->Upload()){
        $image=$fichier->getSrc();
    }else{
        echo "echek d'upload le document";
        return;
    }

    $documentPatient = new app\DefaultApp\Models\DocumentPatient();
    $documentPatient->setIdPatient($id_patient);
    $documentPatient->setNom($nom);
    $documentPatient->setImage($image);
    $m = $documentPatient->enregistrer();
    if ($m == "ok") {
        ?>
        <table style="width:100%" class="table table-bordered ">
            <tr>
                <th>Nom</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $listeDocument = app\DefaultApp\Models\DocumentPatient::lister($id_patient);
            if (count($listeDocument) > 0) {
                foreach ($listeDocument as $dc) {
                    ?>
                    <tr>
                        <td><?= $dc->getNom(); ?></td>
                        <td><a href="<?= $dc->getImage(); ?>" class="btn btn-warning btn-xs">Afficher</a></td>
                        <td></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <?php
    } else {
        echo $m;
    }
}

if(isset($_GET['supep'])){
    $id = $_GET['id'];
    $id_patient = $_GET['id_patient'];
    app\DefaultApp\Models\DocumentPatient::supprimer($id);
    ?>
    <table style="width:100%" class="table table-bordered ">
        <tr>
            <th>Nom</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        $listeDocument = app\DefaultApp\Models\DocumentPatient::lister($id_patient);
        if (count($listeDocument) > 0) {
            foreach ($listeDocument as $dc) {
                ?>
                <tr>
                    <td><?= $dc->getNom(); ?></td>
                    <td><a href="<?= $dc->getImage(); ?>" class="btn btn-warning btn-xs">Afficher</a></td>
                    <td><a class="btn btn-primary btn-xs bt_sup" data-id="<?= $dc->getId(); ?>" data-id_medecin="<?= $id_patient ?>"></a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <?php
}