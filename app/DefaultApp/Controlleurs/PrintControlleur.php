<?php


namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\Models\Achat;
use app\DefaultApp\Models\Client;
use app\DefaultApp\Models\Fournisseur;
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

    public function imprimerAchat($id_achat){
        $var['titre']="";
        $achat=new Achat();
        $achat=$achat->findById($id_achat);
        if($achat!=null){
            $fournisseur=new Fournisseur();
            $fournisseur=$fournisseur->findById($achat->getIdFournisseur());
            if($fournisseur!=null){
                $var['fournisseur']=$fournisseur;
                $var['dernierAchat']=$achat;
            }
        }

        $this->render("print/invoice_achat",$var);
    }

}