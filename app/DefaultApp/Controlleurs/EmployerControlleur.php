<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 3/25/2020
 * Time: 11:02 AM
 */

namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\Models\Employer;
use app\DefaultApp\Models\Service;
use systeme\Application\Application;

class EmployerControlleur extends BaseControlleur
{

    public function index()
    {
        $variables['titre'] = "Employer";
        $employer = new Employer();
        $listeEmployer = $employer->findAll();

        if (isset($_GET['activer'])) {
            $id = $_GET['activer'];
            $m = Employer::activer($id);
            ?>
            <script>alert("fait avec success");location.href="lister-employer";</script>
            <?php
        }

        if (isset($_POST['desactiver'])) {
            $id = $_GET['desactiver'];
            $raison = trim(addslashes($_POST['raison']));
            $m = Employer::desactiver($id, $raison);
            ?>
            <script>alert("fait avec success");location.href="lister-employer";</script>
            <?php
        }


        $variables['listeEmployer'] = $listeEmployer;
        $this->render("employer/index", $variables);
    }

    public function ajouter()
    {
        $variables['titre'] = "Ajouter Employer";
        $service = new Service();
        $listeService = $service->findAll();
        $variables['listeService'] = $listeService;
        $this->render("employer/ajouter", $variables);
    }

    public function modifier($id)
    {
        $variables['titre'] = "Modifier Employer";
        $service = new Service();
        $employer=new Employer();
        $employer=$employer->findById($id);
        $listeService = $service->findAll();
        $variables['listeService'] = $listeService;

        if($employer!=null){
            $variables['employer']=$employer;
        }

        $this->render("employer/modifier", $variables);
    }

    public function fiche($id)
    {
        $variables['titre'] = "Fiche Employer";
        $employer=new Employer();
        $employer=$employer->findById($id);
        $service=new Service();
        $listeService = $service->findAll();
        $variables['listeService'] = $listeService;
        if($employer!=null){
            $variables['employer']=$employer;
        }

        $this->render("employer/fiche", $variables);
    }


}