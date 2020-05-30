<?php


namespace app\DefaultApp\Controlleurs;
use app\DefaultApp\Models\Achat;
use app\DefaultApp\Models\Fournisseur;

class AchatControlleur extends BaseControlleur
{

    public function ajouter($id){
        $var['titre']="Achat";
        $fournisseur=new Fournisseur();
        $fournisseur=$fournisseur->findById($id);
        if($fournisseur!=null){
            $var['fournisseur']=$fournisseur;
            $dernierAchat=Achat::rechercherParFournisseurNonFinaliser($fournisseur->getId(),date("Y-m-d"));
            if($dernierAchat!=null){
                $var['dernierAchat']=$dernierAchat;
            }
        }else{
            $achat=new Achat();
            $achat=$achat->findById($id);
            if($achat!=null){
                $fournisseur=new Fournisseur();
                $fournisseur=$fournisseur->findById($achat->getIdFournisseur());
                if($fournisseur!=null){
                    $var['fournisseur']=$fournisseur;
                    $var['dernierAchat']=$achat;
                }
            }
        }
        $this->render("achat/ajouter",$var);
    }

    public function factureAchat($id){

        $var['titre']="Achat";
        $fournisseur=new Fournisseur();
        $fournisseur=$fournisseur->findById($id);
        if($fournisseur!=null){
            $var['fournisseur']=$fournisseur;
            $dernierAchat=Achat::rechercherParFournisseurNonFinaliser($fournisseur->getId(),date("Y-m-d"));
            if($dernierAchat!=null){
                $var['dernierAchat']=$dernierAchat;
            }
        }else{
            $achat=new Achat();
            $achat=$achat->findById($id);
            if($achat!=null){
                $fournisseur=new Fournisseur();
                $fournisseur=$fournisseur->findById($achat->getIdFournisseur());
                if($fournisseur!=null){
                    $var['fournisseur']=$fournisseur;
                    $var['dernierAchat']=$achat;
                }
            }
        }
        $this->render("achat/ajouter",$var);
    }

    public function lister(){
        $var['titre']="Liste des Achats";
        $achat=new Achat();
        $listeAchat=$achat->findAll();
        $var['listeAchat']=$listeAchat;
        $this->render("achat/lister",$var);
    }

}