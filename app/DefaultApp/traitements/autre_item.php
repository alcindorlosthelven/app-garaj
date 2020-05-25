<?php
require_once "../../../vendor/autoload.php";
if(isset($_POST['ajouter_categorie']))
{

  $categorie=trim(addslashes($_POST['categorie']));
  $cat=new app\DefaultApp\Models\CategorieAutreItem();
  $cat->setCategorie($categorie);
  $m=$cat->ajouter();
  echo $m;
}

if(isset($_POST['modifier_categorie']))
{

    $id=$_POST['id'];
    $categorie=trim(addslashes($_POST['categorie']));
    $ancienCategorie=trim(addslashes($_POST['ancien_categorie']));
    $cat=new app\DefaultApp\Models\CategorieAutreItem();
    $cat->setCategorie($categorie);
    $cat->setId($id);
    $m=$cat->modifier();
    if($m=="ok"){
        $mm=app\DefaultApp\Models\Stock::updateCategorie($categorie,$ancienCategorie);
        echo $mm;
    }else{
        echo $m;
    }

}

if(isset($_POST['autre_item']))
{
    try{
        $categorie=trim(addslashes($_POST['categorie']));
        $nom=trim(addslashes($_POST['nom']));
        $nom_alt=trim(addslashes($_POST['nom_alternatif']));
        $unite=trim(addslashes($_POST['unite']));
        $description=trim(addslashes($_POST['description']));

        $prix=$_POST['prix'];
        $cout=$_POST['cout'];

        $prix=\app\DefaultApp\DefaultApp::formatComptable($prix);
        $cout=\app\DefaultApp\DefaultApp::formatComptable($cout);

        $au=new app\DefaultApp\Models\AutreItem();
        $au->setCategorie($categorie);
        $au->setNom($nom);
        $au->setNomAlternatif($nom_alt);
        $au->setUnite($unite);
        $au->setPrix($prix);
        $au->setCout($cout);
        $au->setBdc("non");
        $au->setDescription($description);
        $m=$au->ajouter();
        echo $m;
    }catch (Exception $ex){
        echo $ex->getMessage();
    }

}

if(isset($_POST['autre_item_m']))
{
    try{
        $id=$_POST['id'];
        $categorie=trim(addslashes($_POST['categorie']));
        $nom=trim(addslashes($_POST['nom']));
        $nom_alt=trim(addslashes($_POST['nom_alternatif']));
        $unite=trim(addslashes($_POST['unite']));
        $description=trim(addslashes($_POST['description']));

        $prix=$_POST['prix'];
        $cout=$_POST['cout'];

        $prix=\app\DefaultApp\DefaultApp::formatComptable($prix);
        $cout=\app\DefaultApp\DefaultApp::formatComptable($cout);

        $au=new app\DefaultApp\Models\AutreItem();
        $au->setCategorie($categorie);
        $au->setNom($nom);
        $au->setNomAlternatif($nom_alt);
        $au->setUnite($unite);
        $au->setPrix($prix);
        $au->setCout($cout);
        $au->setDescription($description);
        $au->setId($id);
        $m=$au->modifier();
        echo $m;
    }catch (Exception $ex){
        echo $ex->getMessage();
    }

}