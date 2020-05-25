<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 26/03/2018
 * Time: 20:18
 */
require "../../../vendor/autoload.php";
if (isset($_POST['enregistrer_employer'])) {

    $emp=new \app\DefaultApp\Models\Employer();
    $emp->remplire($_POST);
    $data_entrer = trim(addslashes($_POST['date_entrer']));
    $emp->setDateEntrerEnTravail($data_entrer);
    $password = trim(addslashes($_POST['password']));
    $confirmer_password = trim(addslashes($_POST['confirmer_password']));
    if($password!==$confirmer_password){
        echo "verifier les mot de passe";
        return;
    }
    $photo="";
    $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],strtolower($emp->getPrenom()."".$emp->getNom()));
    if($fichier->Upload()){
        $photo=$fichier->getSrc();
        $emp->setPhoto($photo);
    }
    $conjointe = new \app\DefaultApp\Models\ConjointeEmployer();
    $pu=new \app\DefaultApp\Models\PersonnePrevenirEmployer();
    $emp->setActif("non");
    //conjointe
    $nom_conjointe = trim(addslashes($_POST['nom_conjointe']));
    $prenom_conjointe = trim(addslashes($_POST['prenom_conjointe']));
    $relation_conjointe = trim(addslashes($_POST['relation_conjointe']));
    $telephone_conjointe = trim(addslashes($_POST['telephone_conjointe']));
    $conjointe->setNom($nom_conjointe);
    $conjointe->setPrenom($prenom_conjointe);
    $conjointe->setRelation($relation_conjointe);
    $conjointe->setTelephone($telephone_conjointe);

    //personne a prevenire
    $nom_pu = trim(addslashes($_POST['nom_pu']));
    $prenom_pu = trim(addslashes($_POST['prenom_pu']));
    $relation_pu = trim(addslashes($_POST['relation_pu']));
    $telephone_pu = trim(addslashes($_POST['telephone_pu']));
    $pu->setNom($nom_pu);
    $pu->setPrenom($prenom_pu);
    $pu->setRelation($relation_pu);
    $pu->setTelephone($telephone_pu);

    $mp=$emp->add();
    if($mp==="ok"){
        $id=\app\DefaultApp\Models\Employer::dernierId();
        $conjointe->setIdEmployer($id);
        $pu->setIdEmployer($id);
        $mpu=$pu->add();
        $mc=$conjointe->add();
        if($mc==="ok"){
            $historique=new \app\DefaultApp\Models\Historique();
            $historique->setUser("");
            $historique->setAction("Ajouter employer");
            $m=$historique->add();
        }
        echo $mc;
    }else{
        echo $mp;
    }

}

if (isset($_POST['modifier_employer'])) {
    $nom = trim(addslashes($_POST['nom']));
    $prenom = trim(addslashes($_POST['prenom']));
    $date_naissance = trim(addslashes($_POST['date_naissance']));
    $nif = trim(addslashes($_POST['nif']));
    $cin = trim(addslashes($_POST['cin']));
    $adresse = trim(addslashes($_POST['adresse']));
    $telephone = trim(addslashes($_POST['telephone']));
    $email = trim(addslashes($_POST['email']));
    $religion = trim(addslashes($_POST['religion']));
    $statut_matrimonial = trim(addslashes($_POST['statut_matrimonial']));
    $id_employer=$_POST['id_employer'];
    $role = trim(addslashes($_POST['role']));
    $data_entrer = trim(addslashes($_POST['date_entrer']));
    $poste = trim(addslashes($_POST['poste']));
    $service = trim(addslashes($_POST['service']));
    $type_contrat = trim(addslashes($_POST['type_contrat']));
    $identifiant=trim(addslashes($_POST['identifiant']));

    $emp = new \app\DefaultApp\Models\Employer();
    $emp=$emp->findById($id_employer);
    if($emp==null){
        echo "Employer non trouver";
        return;
    }

    if(isset($_FILES['fichier']['name'])){
        $photo="";
        $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],strtolower($nom.$prenom));
        if($fichier->Upload()){
            $photo=$fichier->getSrc();
            $emp->setPhoto($photo);
        }
    }


    $emp->setNom($nom);
    $emp->setPrenom($prenom);
    $emp->setDateNaissance($date_naissance);
    $emp->setNif($nif);
    $emp->setCin($cin);
    $emp->setAdresse($adresse);
    $emp->setTelephone($telephone);
    $emp->setEmail($email);
    $emp->setReligion($religion);
    $emp->setStatutMatrimonial($statut_matrimonial);
    $emp->setDateEntrerEnTravail($data_entrer);
    $emp->setPoste($poste);
    $emp->setService($service);
    $emp->setTypeContrat($type_contrat);
    $emp->setIdentifiant($identifiant);

    $emp->setRole($role);
    $mes=$emp->update();
    if($mes=="ok"){
        $nom_conjointe = trim(addslashes($_POST['nom_conjointe']));
        $prenom_conjointe = trim(addslashes($_POST['prenom_conjointe']));
        $relation_conjointe = trim(addslashes($_POST['relation_conjointe']));
        $telephone_conjointe = trim(addslashes($_POST['telephone_conjointe']));
        $id_conjointe=$_POST['id_conjointe'];

        $conjointe = new \app\DefaultApp\Models\ConjointeEmployer();
        $conjointe=$conjointe->findById($id_conjointe);
        if($conjointe!=null){
            $conjointe->setNom($nom_conjointe);
            $conjointe->setPrenom($prenom_conjointe);
            $conjointe->setRelation($relation_conjointe);
            $conjointe->setTelephone($telephone_conjointe);
            $conjointe->update();
        }

        //personne a prevenire
        $nom_pu = trim(addslashes($_POST['nom_pu']));
        $prenom_pu = trim(addslashes($_POST['prenom_pu']));
        $relation_pu = trim(addslashes($_POST['relation_pu']));
        $telephone_pu = trim(addslashes($_POST['telephone_pu']));

        $id_pu=$_POST['id_personne'];
        $pu = new \app\DefaultApp\Models\PersonnePrevenirEmployer();
        $pu=$pu->findById($id_pu);
        if($pu!==null){
            $pu->setNom($nom_pu);
            $pu->setPrenom($prenom_pu);
            $pu->setRelation($relation_pu);
            $pu->setTelephone($telephone_pu);
            $pu->update();
        }

        $historique=new \app\DefaultApp\Models\Historique();
        $historique->setUser("");
        $historique->setAction("Ajouter employer");
        $m=$historique->add();
        echo $m;
    }else{
        echo $mes;
    }

  }