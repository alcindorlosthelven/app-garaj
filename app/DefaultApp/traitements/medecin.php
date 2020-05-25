<?php
require_once "../../../vendor/autoload.php";
if (isset($_POST['ajouter'])) {
    $code_medecin = "m-" . rand(100, 1000) . "-" . rand(1001, 9999);
    $no_licence = trim(addslashes($_POST['no_licence']));
    $nom = trim(addslashes($_POST['nom']));
    $prenom = trim(addslashes($_POST['prenom']));
    $sexe = trim(addslashes($_POST['sexe']));
    $specialite = trim(addslashes(implode(",",$_POST['specialite'])));


    $type = trim(addslashes($_POST['type']));
    $catetorie=trim(addslashes($_POST['categorie']));
    if($catetorie==="autre"){
        $specialite=str_replace(",","",$specialite);
    }

    $identite = trim(addslashes($_POST['identite']));
    $telephone = trim(addslashes($_POST['telephone']));
    $extension = trim(addslashes($_POST['extension']));
    $email = trim(addslashes($_POST['email']));
    $adresse_clinique = trim(addslashes($_POST['adresse_clinique']));
    $telephone_clinique = trim(addslashes($_POST['telephone_clinique']));

    $identifiant = trim(addslashes($_POST['identifiant']));
    $password = trim(addslashes($_POST['password']));
    $cpassword = trim(addslashes($_POST['cpassword']));

    if($password!==$cpassword){
        echo "Verifier les mot de passe";
        return;
    }

    $personeM=new \app\DefaultApp\Models\PersonelMedical();
    $personeM->setSpecialite($specialite);
    $personeM->setCode($code_medecin);
    $personeM->setLicence($no_licence);
    $personeM->setNom($nom);
    $personeM->setPrenom($prenom);
    $personeM->setSexe($sexe);
    $personeM->setType($type);
    $personeM->setIdentite($identite);
    $personeM->setTelephone($telephone);
    $personeM->setCategorie($catetorie);
    $personeM->setExtension($extension);
    $personeM->setEmail($email);
    $personeM->setAdresseClinique($adresse_clinique);
    $personeM->setTelephoneClinique($telephone_clinique);
    $personeM->setEmail($email);
    $personeM->setIdentifiant($identifiant);
    $personeM->setPassword(sha1($password));
    $personeM->setActif("non");
    $photo="";
    $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],date("dmyhis"));
    if($fichier->Upload()){
        $photo=$fichier->getSrc();
    }
    $personeM->setPhoto($photo);
    $m=$personeM->add();
    echo $m;
}

if (isset($_POST['modifier'])) {
    $id=$_POST['id'];
    $personeM=new \app\DefaultApp\Models\PersonelMedical();
    $personeM=$personeM->findById($id);

    if($personeM==null){
        echo "Imposible de trouver le personel médical pour faire la modification";
        return;
    }


    $no_licence = trim(addslashes($_POST['no_licence']));
    $nom = trim(addslashes($_POST['nom']));
    $prenom = trim(addslashes($_POST['prenom']));
    $sexe = trim(addslashes($_POST['sexe']));
    $specialite = trim(addslashes(implode(",",$_POST['specialite'])));
    $type = trim(addslashes($_POST['type']));
    $catetorie=trim(addslashes($_POST['categorie']));
    if($catetorie==="autre"){
        $specialite=str_replace(",","",$specialite);
    }

    $identite = trim(addslashes($_POST['identite']));
    $telephone = trim(addslashes($_POST['telephone']));
    $extension = trim(addslashes($_POST['extension']));
    $email = trim(addslashes($_POST['email']));
    $adresse_clinique = trim(addslashes($_POST['adresse_clinique']));
    $telephone_clinique = trim(addslashes($_POST['telephone_clinique']));

    $personeM->setSpecialite($specialite);
    $personeM->setLicence($no_licence);
    $personeM->setNom($nom);
    $personeM->setPrenom($prenom);
    $personeM->setSexe($sexe);
    $personeM->setType($type);
    $personeM->setIdentite($identite);
    $personeM->setTelephone($telephone);
    $personeM->setCategorie($catetorie);
    $personeM->setExtension($extension);
    $personeM->setEmail($email);
    $personeM->setAdresseClinique($adresse_clinique);
    $personeM->setTelephoneClinique($telephone_clinique);
    $personeM->setEmail($email);

    if(isset($_FILES['fichier']['name']) and $_FILES['fichier']['name']!=="") {
        $photo = "";
        $fichier = new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'], date("dmyhis"));
        if ($fichier->Upload()) {
            $photo = $fichier->getSrc();
        }
        $personeM->setPhoto($photo);
    }
    $m=$personeM->update();
    echo $m;
}

if (isset($_POST['ajouter_document'])) {

    $id = $_POST['id_pm'];
    $nom = trim(addslashes($_POST['nom']));
    $pm=new \app\DefaultApp\Models\PersonelMedical();
    $pm=$pm->findById($id);

    if($pm===null){
        echo "dossier personel médical introuvable";
        return;
    }

    $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],sha1($nom."_".$pm->getNom().$pm->getPrenom()));

    $document = new \app\DefaultApp\Models\DocumentPersonelMedical();
    $document->setIdPersonelMedical($id);
    $document->setNom($nom);
    if($fichier->Upload()){
        $document->setImage($fichier->getSrc());
        $m = $document->add();
        if ($m == "ok") {
            ?>
            <table style="width:100%" class="table table-bordered ">
                <tr>
                    <th>Nom</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                $listeDocument = \app\DefaultApp\Models\DocumentPersonelMedical::listerParPersonelMedical($id);
                if (count($listeDocument) > 0) {
                    foreach ($listeDocument as $dc) {
                        ?>
                        <tr>
                            <td><?= stripslashes($dc->getNom()); ?></td>
                            <td><a href="<?= $dc->getImage(); ?>" class="btn btn-warning btn-xs">Afficher</a></td>
                            <td><a class="btn btn-primary btn-xs bt_sup" data-id="<?= $dc->getId(); ?>" data-idpm="<?= $id ?>">Supprimer</a></td>
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

if (isset($_GET['supprimer_document'])) {
    $id = $_GET['id'];
    $id_pm = $_GET['id_pm'];
    $dpm=new \app\DefaultApp\Models\DocumentPersonelMedical();
    $dpm=$dpm->deleteById($id);
    ?>
    <table style="width:100%" class="table table-bordered ">
        <tr>
            <th>Nom</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        $listeDocument = \app\DefaultApp\Models\DocumentPersonelMedical::listerParPersonelMedical($id_pm);
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
}
?>