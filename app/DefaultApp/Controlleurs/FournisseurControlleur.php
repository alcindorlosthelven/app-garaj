<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 3/27/2020
 * Time: 3:22 PM
 */

namespace app\DefaultApp\Controlleurs;

use app\DefaultApp\Models\Fournisseur;
use app\DefaultApp\Models\FournisseurContact;
use systeme\Application\Application;

class FournisseurControlleur extends BaseControlleur
{

    public function index(){
        $variables['titre']="Fournisseur";

        $this->render("fournisseur/index",$variables);
    }

    public function ajouter(){
        $variables['titre']="Ajouter Fournisseur";
        $fournisseur=new Fournisseur();
        if(isset($_POST['ajouter'])){
            $nom=trim(addslashes($_POST['nom']));
            $adresse=trim(addslashes($_POST['adresse']));
            $telephone=trim(addslashes($_POST['telephone']));
            $email=trim(addslashes($_POST['email']));
            $statut=trim(addslashes($_POST['statut']));

            $fournisseur->setNom($nom);
            $fournisseur->setAdresse($adresse);
            $fournisseur->setTelephone($telephone);
            $fournisseur->setEmail($email);
            $fournisseur->setStatut($statut);
            $m=$fournisseur->add();
            if($m=='ok'){
                $id_assurance = Fournisseur::dernierId();
                for ($i = 0; $i < count($_POST['nomp']); $i++) {
                    $ca = new FournisseurContact();
                    $ca->setIdFournisseur($id_assurance);
                    $ca->setNom($_POST['nomp'][$i]);
                    $ca->setEmail($_POST['emailp'][$i]);
                    $ca->setPoste($_POST['postep'][$i]);
                    $ca->setTelephone($_POST['telephonep'][$i]);
                    $mm=$ca->add();
                }

                if($mm=="ok"){
                    $variables['success']="Fait avec success";
                }else{
                    $variables['erreur']=$mm;
                }
            }else{
                $variables['erreur']=$m;
            }
        }

        $this->render("fournisseur/ajouter",$variables);
    }

    public function modifier($id){
        $variables['titre']="Modifier Fournisseur";
        $fournisseur=new Fournisseur();
        $fournisseurContact=new FournisseurContact();
        $fournisseur=$fournisseur->findById($id);

        if($fournisseur!=null){
            $variables['fournisseur']=$fournisseur;
            $contactA=$fournisseurContact->findAll($fournisseur->getId());
            $variables['contactA']=$contactA;
        }

        if(isset($_POST['modifier'])){

            $nom=trim(addslashes($_POST['nom']));
            $adresse=trim(addslashes($_POST['adresse']));
            $telephone=trim(addslashes($_POST['telephone']));
            $email=trim(addslashes($_POST['email']));

            $fournisseur->setNom($nom);
            $fournisseur->setAdresse($adresse);
            $fournisseur->setTelephone($telephone);
            $fournisseur->setEmail($email);

            $m=$fournisseur->update();
            if($m=='ok'){
                FournisseurContact::supprimerParFournisseur($id);
                for ($i = 0; $i < count($_POST['nomp']); $i++) {
                    $ca = new FournisseurContact();
                    $ca->setIdFournisseur($id);
                    $ca->setNom($_POST['nomp'][$i]);
                    $ca->setEmail($_POST['emailp'][$i]);
                    $ca->setPoste($_POST['postep'][$i]);
                    $ca->setTelephone($_POST['telephonep'][$i]);
                    $mm=$ca->add();
                }

                if($mm=="ok"){
                    $variables['success']="Fait avec success";
                }else{
                    $variables['erreur']=$mm;
                }
            }else{
                $variables['erreur']=$m;
            }
        }

        $this->render("fournisseur/modifier",$variables);
    }

    public function lister(){
        $variables['titre']="Lister Fournisseur";
        $fournisseur=new Fournisseur();
        $listeAssurance=$fournisseur->findAll();
        $variables['listeFournisseur']=$listeAssurance;

        if(isset($_GET['activer'])){
            $id=$_GET['activer'];
            $fournisseur=$fournisseur->findById($id);
            if($fournisseur!=null){
                $fournisseur->setStatut("actif");
                $fournisseur->update();
                Application::redirection("lister_fournisseur");
            }
        }

        if(isset($_GET['desactiver'])){
            $id=$_GET['desactiver'];
            $fournisseur=$fournisseur->findById($id);
            if($fournisseur!=null){
                $fournisseur->setStatut("inactif");
                $fournisseur->update();
                Application::redirection("lister_fournisseur");
            }
        }


        $this->render("fournisseur/lister",$variables);
    }

    public function fiche($id){
        $variables['titre']="Fiche Fournisseur";
        $fournisseur=new Fournisseur();
        $fournisseurContact=new FournisseurContact();
        $fournisseur=$fournisseur->findById($id);

        if($fournisseur!=null){
            $variables['fournisseur']=$fournisseur;
            $contactA=$fournisseurContact->findAll($fournisseur->getId());
            $variables['contactA']=$contactA;

        }
        $this->render("fournisseur/fiche",$variables);
    }



}