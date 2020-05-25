<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 24/03/2018
 * Time: 21:28
 */

namespace app\DefaultApp\Controlleurs;

use app\DefaultApp\Models\Utilisateur;

class UtilisateurControlleur extends BaseControlleur
{

    public function ajouter()
    {

        try{
            $variable = array();
            $variable['titre'] = "Utilisateur / Ajouter";
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $utlisateur = new Utilisateur();
                $utlisateur->setNom($_POST['nom']);
                $utlisateur->setPrenom($_POST['prenom']);
                $utlisateur->setPseudo($_POST['pseudo']);
                $utlisateur->setRole($_POST['role']);
                $utlisateur->setActive("oui");
                $motdepasse = $_POST['motdepasse'];
                $confirmer = $_POST['confirmermotdepasse'];

                if ($motdepasse != $confirmer) {
                    $variable['erreur'] = "Verifier les mot de passe";
                } else {
                    $utlisateur->setMotdepasse($motdepasse);
                    $message = $utlisateur->Enregistrer();
                    if ($message === 'ok') {
                        $variable['success'] = "Fait avec sucess";
                    } else {
                        $variable['erreur'] = $message;
                    }
                }

            }

            $this->render("utilisateur/ajouter", $variable);
        }catch (\Exception $ex){
            echo $ex->getMessage();
        }
    }

    public function modifier()
    {

        $variable = array();
        $variable['titre'] = "Utilisateur / modifier";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $utlisateur = $this->getModel("utilisateur");
            $utlisateur->setNom($_POST['nom']);
            $utlisateur->setPrenom($_POST['prenom']);
            $utlisateur->setPseudo($_POST['pseudo']);
            $utlisateur->setRole($_POST['role']);
            $utlisateur->setActive("oui");
            $motdepasse = $_POST['motdepasse'];
            $confirmer = $_POST['confirmermotdepasse'];

            if ($motdepasse != $confirmer) {
                $variable['erreur'] = "Verifier les mot de passe";
            } else {
                $utlisateur->setMotdepasse($motdepasse);

                $message = $utlisateur->Enregistrer();
                if ($message == 'Enregistrer avec sucess') {
                    $variable['success'] = $message;
                } else {
                    $variable['erreur'] = $message;
                }
            }

        }

        $this->render("utilisateur/modifier", $variable);
    }

    public function lister()
    {
        $listeUtilisateur = $this->getModel("utilisateur")->Lister();
        $variable = array("titre" => "Utilisateur / Lister", "listeUtilisateur" => $listeUtilisateur);
        $this->render("utilisateur/lister", $variable);
    }

    public function blocker($id)
    {
        Utilisateur::blocker($id);
        header("location: lister-utilisateur");
    }

    public function deblocker($id)
    {
        Utilisateur::deblocker($id);
        header("location: lister-utilisateur");
    }

    public function supprimer($id)
    {
        Utilisateur::Supprimer($id);
        header("location: lister-utilisateur");
    }

    public function module()
    {
        $variable['titre'] = "Module";
        if (isset($_POST['module'])) {
            $md = new Module();
            $listeModule = $md->findAll();
            if (isset($_POST['id_module'])) {
                $modules = $_POST['id_module'];
                foreach ($listeModule as $md) {
                    if (in_array($md->getId(), $modules)) {
                        $md->setActif('oui');
                    } else {
                        $md->setActif('non');
                    }
                    $md->update();
                }

                $variable['succes'] = "Fait avec success";
            } else {
                foreach ($listeModule as $md) {

                    $md->setActif('non');
                    $md->update();
                }
                $variable['succes'] = "Fait avec success";
            }
        }
        $this->render("module/index", $variable);
    }
}