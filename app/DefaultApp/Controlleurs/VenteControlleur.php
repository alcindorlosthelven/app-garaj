<?php


namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\Models\Client;
use app\DefaultApp\Models\Vente;

class VenteControlleur extends BaseControlleur
{

    public function ajouter($id){
        $var['titre']="Ajouter Vente";
        $client=new Client();
        $client=$client->findById($id);
        if($client!=null){
            $var['client']=$client;
        }
        $this->render("vente/ajouter",$var);
    }

    public function factureVente($id){

        $var['titre']="Fiche Vente";
        $vente=new Vente();
        $vente=$vente->findById($id);

        if($vente!=null){
            $client=new Client();
            $client=$client->findById($vente->getIdClient());
            if($client!=null){
                $var['client']=$client;
                $var['dernierVente']=$vente;
            }
        }

        $this->render("vente/facture_vente",$var);
    }


    public function lister(){
        $var['titre']="Liste des ventes";
        $vente=new Vente();
        $listeVente=$vente->findAll();
        $var['listeVente']=$listeVente;
        $this->render("vente/lister",$var);
    }

}