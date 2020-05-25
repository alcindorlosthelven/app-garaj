<?php
require_once "../../../vendor/autoload.php";
if (isset($_POST['ajouter_patient'])) {
    $patient=new \app\DefaultApp\Models\Patient();
    $photo = "";
    $nom = trim(addslashes($_POST['nom']));
    $prenom = trim(addslashes($_POST['prenom']));
    $nom_mere = trim(addslashes($_POST['nom_mere']));
    $date_naissance = trim(addslashes($_POST['date_naissance']));
    $sexe = trim(addslashes($_POST['sexe']));
    $identite = trim(addslashes($_POST['identite']));
    $telephone = trim(addslashes($_POST['telephone']));
    $profession = trim(addslashes($_POST['profession']));
    $email = trim(addslashes($_POST['email']));
    $religion = trim(addslashes($_POST['religion']));
    $adresse = trim(addslashes($_POST['adresse']));
    $couverture = trim(addslashes($_POST['couverture']));
    $remarque = trim(addslashes($_POST['remarque']));
    $noms = $nom . "-" . $prenom;
    $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],sha1($nom.$prenom));
    if($fichier->Upload()){
        $photo=$fichier->getSrc();
    }
    $patient->setPhoto($photo);
    $patient->setNom($nom);
    $patient->setPrenom($prenom);
    $patient->setNomMere($nom_mere);
    $patient->setDateNaissance($date_naissance);
    $patient->setSexe($sexe);
    $patient->setIdentite($identite);
    $patient->setTelephone($telephone);
    $patient->setProfession($profession);
    $patient->setEmail($email);
    $patient->setReligion($religion);
    $patient->setAdresse($adresse);
    $patient->setCouvertureChsm($couverture);
    $patient->setRemarque($remarque);
    $m=$patient->add();
    echo $m;
}

if (isset($_POST['modifier_patient'])) {
    $id_patient=$_POST['id_patient'];
    $patient=new \app\DefaultApp\Models\Patient();
    $patient=$patient->findById($id_patient);
    $nom = trim(addslashes($_POST['nom']));
    $prenom = trim(addslashes($_POST['prenom']));
    $nom_mere = trim(addslashes($_POST['nom_mere']));
    $date_naissance = trim(addslashes($_POST['date_naissance']));
    $sexe = trim(addslashes($_POST['sexe']));
    $identite = trim(addslashes($_POST['identite']));
    $telephone = trim(addslashes($_POST['telephone']));
    $profession = trim(addslashes($_POST['profession']));
    $email = trim(addslashes($_POST['email']));
    $religion = trim(addslashes($_POST['religion']));
    $adresse = trim(addslashes($_POST['adresse']));
    $couverture = trim(addslashes($_POST['couverture']));
    $remarque = trim(addslashes($_POST['remarque']));
    $noms = $nom . "-" . $prenom;

    if($_FILES['fichier']['name']!=="") {
        $fichier = new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'], sha1($nom . $prenom));
        if ($fichier->Upload()) {
            $patient->setPhoto($fichier->getSrc());
        }
    }

    $patient->setNom($nom);
    $patient->setPrenom($prenom);
    $patient->setNomMere($nom_mere);
    $patient->setDateNaissance($date_naissance);
    $patient->setSexe($sexe);
    $patient->setIdentite($identite);
    $patient->setTelephone($telephone);
    $patient->setProfession($profession);
    $patient->setEmail($email);
    $patient->setReligion($religion);
    $patient->setAdresse($adresse);
    $patient->setCouvertureChsm($couverture);
    $patient->setRemarque($remarque);
    $m=$patient->update();
    echo $m;
}

if(isset($_POST['ajouter_assurance']))
{
    $patient=$_POST['id_patient'];
    $nom_assurance=$_POST['assurance'];
    $institution=$_POST['institution'];
    $no_certificat=$_POST['no_certificat'];
    $no_police=$_POST['no_police'];
    $type=$_POST['type'];
    $nomPrimaire=trim(addslashes($_POST['nom_primaire']));
    $prenomPrimaire=trim(addslashes($_POST['prenom_primaire']));
    $identitePrimaire=trim(addslashes($_POST['cin']));
    $date_naissance_primaire=trim(addslashes($_POST['date_naissance']));

    $ass=new \app\DefaultApp\Models\AssurancePatient();
    $ass->setIdPatient($patient);
    $ass->setIdAssurance($nom_assurance);
    $ass->setInstitution($institution);
    $ass->setNoCertificat($no_certificat);
    $ass->setNoPolice($no_police);
    $ass->setType($type);
    $ass->setNomPrimaire($nomPrimaire);
    $ass->setPrenomPrimaire($prenomPrimaire);
    $ass->setIdentitePrimaire($identitePrimaire);
    $ass->setDateNaissancePrimaire($date_naissance_primaire);
    $ass->setActive("oui");
    $mes=$ass->ajouter();
    echo $mes;
}

if(isset($_POST['ajouter_personne_responsable'])){
    $id_patient=$_POST['id_patient'];
    $nom_pr=trim(addslashes($_POST['nompr']));
    $prenom_pr=trim(addslashes($_POST['prenompr']));
    $telephone_pr=trim(addslashes($_POST['telephonepr']));
    $relation_pr=trim(addslashes($_POST['relationpr']));

    $nom_pv=trim(addslashes($_POST['nompv']));
    $prenom_pv=trim(addslashes($_POST['prenompv']));
    $telephone_pv=trim(addslashes($_POST['telephonepv']));
    $relation_pv=trim(addslashes($_POST['relationpv']));

    $personnePrevenire=new \app\DefaultApp\Models\PersonnePrevenirPatient();
    $personnePrevenire->setIdPatient($id_patient);
    $personnePrevenire->setRelation($relation_pv);
    $personnePrevenire->setNom($nom_pv);
    $personnePrevenire->setPrenom($prenom_pv);
    $personnePrevenire->setTelephone($telephone_pv);

    $personneResponsable=new \app\DefaultApp\Models\PersonneReponsablePatient();
    $personneResponsable->setIdPatient($id_patient);
    $personneResponsable->setNom($nom_pr);
    $personneResponsable->setPrenom($prenom_pr);
    $personneResponsable->setTelephone($telephone_pr);
    $personneResponsable->setRelation($relation_pr);

    if(isset($_POST['modifier'])){
        $personnePrevenire->setId($_POST['id_personne_prevenire']);
        $personneResponsable->setId($_POST['id_personne_responsable']);
        $m=$personnePrevenire->update();
        $m1=$personneResponsable->update();
    }else{
        $m=$personnePrevenire->add();
        $m1=$personneResponsable->add();
    }

    echo $m1;
}

if(isset($_POST['exeat'])){
    $id_admision=$_POST['id_admision'];
    $admision=new \app\DefaultApp\Models\Admision();
    $admision=$admision->findById($id_admision);
    $admision->setStatutExeat(1);
    $m=$admision->update();
    echo $m;
}

if(isset($_POST['finaliser_exeat'])){
    $id_admision=$_POST['id_admision'];
    $admision=new \app\DefaultApp\Models\Admision();
    $admision=$admision->findById($id_admision);
    $admision->setStatutExeat(2);
    $m=$admision->update();
    echo $m;
}