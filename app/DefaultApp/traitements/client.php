<?php
require "../../../vendor/autoload.php";
if (isset($_POST['ajouter'])) {
    $client = new \app\DefaultApp\Models\Client();
    $client->remplire($_POST);
    if(isset($_FILES['fichier']['name'])){
        $fichier=new \app\DefaultApp\Models\Fichier($_FILES['fichier']['name'],"photo_".$client->getNom()."".$client->getPrenom());
        if($fichier->Upload()){
            $client->setPhoto($fichier->getSrc());
        }
    }
    $m = $client->add();
    echo $m;
}

if (isset($_POST['modifier'])) {
    $client = new \app\DefaultApp\Models\Client();
    $id_client=$_POST['id'];
    $client=$client->findById($id_client);
    $client->remplire($_POST);
    $m = $client->update();
    echo $m;
}

