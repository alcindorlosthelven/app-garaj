<?php


namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\Models\Client;

class ClientControlleur extends BaseControlleur
{

    public function lister(){
        $var['titre']="Lister client";
        $client=new Client();
        $listeClient=$client->findAll();
        $var['listeClient']=$listeClient;
        $this->render("client/lister",$var);
    }

    public function ajouter(){
        $var['titre']="Ajouter client";

        $this->render("client/ajouter",$var);
    }

    public function modifier($id){
        $var['titre']="Modifier client";
        $client=new Client();
        $client=$client->findById($id);
        if($client!=null){
            $var['client']=$client;
        }
        $this->render("client/modifier",$var);
    }

    public function fiche($id){
        $var['titre']="Fiche client";
        $client=new Client();
        $client=$client->findById($id);
        if($client!=null){
            $var['client']=$client;
        }
        $this->render("client/fiche",$var);
    }




}