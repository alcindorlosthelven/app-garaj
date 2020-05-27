<?php


namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\Models\Client;
use app\DefaultApp\Models\Vente;
use systeme\Controlleur\Controlleur;

class PrintControlleur extends Controlleur
{

    protected $nom_template="print";
    public function imprimer($id_vente){
        $var['titre']="";
        $vente=new Vente();
        $vente=$vente->findById($id_vente);
        if($vente!=null){
            $client=new Client();
            $client=$client->findById($vente->getIdClient());
            if($client!=null){
                $var['client']=$client;
                $var['vente']=$vente;
            }
        }

        $this->render("print/invoice",$var);
    }

}