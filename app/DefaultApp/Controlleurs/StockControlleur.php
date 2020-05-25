<?php
/**
 * Created by PhpStorm.
 * User: alcin
 * Date: 4/24/2020
 * Time: 2:02 PM
 */

namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\DefaultApp;
use app\DefaultApp\Models\Stock;

class StockControlleur extends BaseControlleur
{

    public function index(){
        $var['titre']="Stock";

        $this->render("stock/generale/lister",$var);
    }

    public function ajouter(){
        $var['titre']="Nouveau Article";

        $this->render("stock/generale/ajouter",$var);
    }

    public function modifier($id){
        $var=array();
        $st=$this->getModel("stock")->rechercher($id);
        $var['item']=$st;

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $id=$_POST['id'];
            $nom=addslashes($_POST['nom']);
            $nom_alternatif=addslashes($_POST['nom_alternatif']);
            $description=addslashes($_POST['description']);
            $st=new Stock();
            $st=$st->findById($id);
            $st->setNom($nom);
            $st->setNomAlternatif($nom_alternatif);
            $st->setDescription($description);

            $qtmax=$_POST['quantite_maximale'];
            $qtcritique=$_POST['quantite_critique'];

            $groupe=addslashes($_POST['groupe']);
            $st->setGroupe($groupe);

            try{
                $prix=$_POST['prix'];
                $prix=DefaultApp::formatComptable($prix);
                $cout=$_POST['cout'];
                $cout=DefaultApp::formatComptable($cout);
            }catch (\Exception $ex){
                $var['err']=$ex->getMessage();
            }

            $st->setPrix($prix);
            $st->setCout($cout);
            $st->setId($id);
            $st->setQuantiteMaximale($qtmax);
            $st->setQuantiteCritique($qtcritique);
            $st->setDateExpiration($_POST['date_expiration']);
            $message=$st->update();
            if($message=="ok"){
                $var['success']="Modifier avec success";
                $var['item']=$st;
            }else{
                $var['err']=$message;
            }
        }

        $this->render("stock/generale/modifier",$var);
    }

    public function historiqueItem($id){
        $var['titre']="Stock";

        $item=new Stock();
        $item=$item->findById($id);
        $this->render("stock/generale/historique",['item'=>$item]);
    }

    public function historique(){
        $var['titre']="Stock";

        $liste=$this->getModel("EntrerSortie")->lister();
        $this->render("stock/generale/historique",['liste'=>$liste]);
    }

    public function repartition($id=""){
        $var['titre']="Repartition Item";
        if($id!=""){
            $var['id']=$id;
        }
        $this->render("stock/generale/repartition",$var);
    }

    public function transfert(){

        $var['titre']="Transfert Articles";

        $this->render("stock/generale/transfert",$var);
    }

    public function retirer(){

        $var['titre']="Retirer Item";

        $this->render("stock/generale/retirer");
    }

    public function bonUtilisation(){
        $var['titre']="Retirer Item";

        $this->render("stock/bon_utilisation");
    }

    public function inventaire(){
        $var['titre']="Inventaire";

        $this->render("stock/inventaire");
    }


    public function commande(){
        if(isset($_POST['statut'])) {
            $_SESSION['statut'] = $_POST['statut'];
        }


        $variable=array();
        if(isset($_POST['fournisseur'])){
            if($_POST['fournisseur']==""){
                $listeCommande=$this->getModel("CommandeRequisition")->listerCommande();
            }else{
                $listeCommande=$this->getModel("CommandeRequisition")->listerCommande($_POST['fournisseur']);
            }
            $variable['fournisseur']=$_POST['fournisseur'];
        }else{
            $commande=new app\DefaultApp\Models\Cmd();
            if(isset($_SESSION['statut'])) {
                if ($_SESSION['statut'] == "Livré") {
                    $listeCommande = $this->getModel("Cmd")->listerLivrer("oui");

                } else if ($_SESSION['statut'] == "Livré non finaliser") {
                    $listeCommande = $this->getModel("Cmd")->listerLivrer("non_finaliser");

                } else if ($_SESSION['statut'] == "non Livré") {
                    $listeCommande = $this->getModel("Cmd")->listerLivrer("non");
                } else {
                    $listeCommande = $this->getModel("Cmd")->lister();
                }
            }else{
                $listeCommande = $this->getModel("Cmd")->lister();
            }

        }

        $variable['listeCommande']=$listeCommande;
        $variable['titre']="Liste Commande";
        return $this->rendreVue("stock/magasin/liste_commande",$variable);
    }


    public function commandePharmacie(){
        if(isset($_POST['statut'])) {
            $_SESSION['statut'] = $_POST['statut'];
        }


        $variable=array();
        if(isset($_POST['fournisseur'])){
            if($_POST['fournisseur']==""){
                $listeCommande=$this->getModel("CommandeRequisition")->listerCommande();
            }else{
                $listeCommande=$this->getModel("CommandeRequisition")->listerCommande($_POST['fournisseur']);
            }
            $variable['fournisseur']=$_POST['fournisseur'];
        }else{
            $commande=new app\DefaultApp\Models\Cmd();
            if(isset($_SESSION['statut']))
            {
                if($_SESSION['statut']=="Livré")
                {
                    $listeCommande = $this->getModel("Cmd")->listerLivrer("oui");

                }else if($_SESSION['statut']=="Livré non finaliser")
                {
                    $listeCommande = $this->getModel("Cmd")->listerLivrer("non_finaliser");

                }else if($_SESSION['statut']=="non Livré")
                {
                    $listeCommande = $this->getModel("Cmd")->listerLivrer("non");
                }else{
                    $listeCommande=$this->getModel("Cmd")->lister();
                }
            }else{
                $listeCommande=$this->getModel("Cmd")->lister();
            }
        }

        $variable['listeCommande']=$listeCommande;
        $variable['titre']="Liste Commande";
        return $this->rendreVue("stock/pharmacie/liste_commande",$variable);
    }

    public function ajouterMagasin(){

        return $this->rendreVue("stock/magasin/ajouter");
    }

    public function ajouterPharmacie(){

        return $this->rendreVue("stock/pharmacie/ajouter");
    }

    

    public function voire($id){
        $var=array();
        $st=$this->getModel("stock")->rechercher($id);
        $var['item']=$st;
        return $this->rendreVue("stock/generale/voire",$var);
    }

    public function modifierMagasin($id){
        $var=array();
        $st=$this->getModel("stock")->rechercher($id);
        $var['item']=$st;

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $id=$_POST['id'];
            $nom=addslashes($_POST['nom']);
            $nom_alternatif=addslashes($_POST['nom_alternatif']);
            $description=addslashes($_POST['description']);
            $size=addslashes($_POST['size']);
            $marque=addslashes($_POST['marque']);




            $st=new app\DefaultApp\Models\Stock();
            $st->setNom($nom);
            $st->setNomAlternatif($nom_alternatif);
            $st->setDescription($description);
            $st->setSize($size);
            $st->setMarque($marque);
            $entrer_par=$_POST['achat_par'];
            $retirer_par=$_POST['vente_par'];

            if(isset($_POST['classe'])){
                $classe=trim(addslashes($_POST['classe']));
            }else{
                $classe="";
            }

            if(isset($_POST['dose'])){
                $dosage=trim(addslashes($_POST['dose']));
            }else{
                $dosage="";
            }


            if(isset($_POST['forme'])){
                $forme=trim(addslashes($_POST['forme']));
            }else{
                $forme="";
            }


            $qtmax=$_POST['quantite_maximale'];
            $qtcritique=$_POST['quantite_critique'];

            $groupe=addslashes($_POST['groupe']);
            $st->setGroupe($groupe);
            try{
                $prix=$_POST['prix'];
                $prix=App::formatComptable($prix);

                $cout=$_POST['cout'];
                $cout=App::formatComptable($cout);
            }catch (\Exception $ex){
                $var['err']=$ex->getMessage();
            }
            if($_POST['type']=="utilisation"){
                $prix=0.0;
            }
            $st->setPrix($prix);
            $st->setCout($cout);
            $st->setEntrerPar($entrer_par);
            $st->setRetirerPar($retirer_par);
            $st->setClasse($classe);
            $st->setDosage($dosage);
            $st->setForme($forme);
            $st->setId($id);
            $st->setQuantiteMaximale($qtmax);
            $st->setQuantiteCritique($qtcritique);
            $st->setType($_POST['type']);
            $st->setDateExpiration($_POST['date_expiration']);
            $message=$st->modifier();
            if($message=="ok"){
                $var['success']="Modifier avec success";
                $var['item']=$st;
            }else{
                $var['err']=$message;
            }
        }

        return $this->rendreVue("stock/magasin/modifier",$var);
    }

    public function modifierPharmacie($id){
        $var=array();
        $st=$this->getModel("stock")->rechercher($id);
        $var['item']=$st;

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $id=$_POST['id'];
            $nom=addslashes($_POST['nom']);
            $nom_alternatif=addslashes($_POST['nom_alternatif']);
            $description=addslashes($_POST['description']);
            $size=addslashes($_POST['size']);
            $marque=addslashes($_POST['marque']);




            $st=new app\DefaultApp\Models\Stock();
            $st->setNom($nom);
            $st->setNomAlternatif($nom_alternatif);
            $st->setDescription($description);
            $st->setSize($size);
            $st->setMarque($marque);
            $entrer_par=$_POST['achat_par'];
            $retirer_par=$_POST['vente_par'];

            if(isset($_POST['classe'])){
                $classe=trim(addslashes($_POST['classe']));
            }else{
                $classe="";
            }

            if(isset($_POST['dose'])){
                $dosage=trim(addslashes($_POST['dose']));
            }else{
                $dosage="";
            }


            if(isset($_POST['forme'])){
                $forme=trim(addslashes($_POST['forme']));
            }else{
                $forme="";
            }


            $qtmax=$_POST['quantite_maximale'];
            $qtcritique=$_POST['quantite_critique'];

            $groupe=addslashes($_POST['groupe']);
            $st->setGroupe($groupe);
            try{
                $prix=$_POST['prix'];
                $prix=App::formatComptable($prix);

                $cout=$_POST['cout'];
                $cout=App::formatComptable($cout);
            }catch (\Exception $ex){
                $var['err']=$ex->getMessage();
            }

            if($_POST['type']=="utilisation"){
                $prix=0.0;
            }

            $st->setPrix($prix);
            $st->setCout($cout);
            $st->setEntrerPar($entrer_par);
            $st->setRetirerPar($retirer_par);
            $st->setClasse($classe);
            $st->setDosage($dosage);
            $st->setForme($forme);
            $st->setId($id);
            $st->setQuantiteMaximale($qtmax);
            $st->setQuantiteCritique($qtcritique);
            $st->setType($_POST['type']);
            $st->setDateExpiration($_POST['date_expiration']);
            $message=$st->modifier();
            if($message=="ok"){
                $var['success']="Modifier avec success";
                $var['item']=$st;
            }else{
                $var['err']=$message;
            }
        }

        return $this->rendreVue("stock/pharmacie/modifier",$var);
    }

    public function liste(){

        $liste=$this->getModel("stock")->lister();
        return $this->rendreVue("stock/generale/lister",['liste'=>$liste]);
    }

    public function listeMagasin(){

        $liste=$this->getModel("stock")->lister("ss");
        return $this->rendreVue("stock/magasin/lister",['liste'=>$liste]);
    }

    public function listePharmacie(){

        $liste=$this->getModel("stock")->lister("Medicament");
        return $this->rendreVue("stock/pharmacie/lister",['liste'=>$liste]);
    }

    public function listeSsh(){
        if(isset($_GET['medicament'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSH",'Medicament');
        }elseif (isset($_GET['materiel'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSH",'Materiel');
        }elseif (isset($_GET['autre_item']))
        {
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSH","service");
        }else{
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSH");
        }

        return $this->rendreVue("stock/ssh/lister",['liste'=>$liste]);
    }

    public function listeSsu(){
        if(isset($_GET['medicament'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSU",'Medicament');
        }elseif (isset($_GET['materiel'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSU",'Materiel');
        }elseif (isset($_GET['autre_item']))
        {
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSU","service");
        }else{
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSU");
        }
        return $this->rendreVue("stock/ssu/lister",['liste'=>$liste]);
    }

    public function listeLabo(){

        $liste=$this->getModel("stock")->listerParService("LABO");
        return $this->rendreVue("stock/labo/lister",['liste'=>$liste]);
    }

    public function listeSsa(){

        if(isset($_GET['medicament'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSA",'Medicament');
        }elseif (isset($_GET['materiel'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSA",'Materiel');
        }elseif (isset($_GET['autre_item']))
        {
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSA","service");
        }else{
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSA");
        }

        //$liste=$this->getModel("stock")->listerParService("SSA");
        return $this->rendreVue("stock/ssa/lister",['liste'=>$liste]);
    }

    public function listeSsc(){

        if(isset($_GET['medicament'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSC",'Medicament');
        }elseif (isset($_GET['materiel'])){
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSC",'Materiel');
        }elseif (isset($_GET['autre_item']))
        {
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSC","service");
        }else{
            $liste=$this->getModel("stock")->listerParServiceGroupe("SSC");
        }
        //$liste=$this->getModel("stock")->listerParService("SSC");
        return $this->rendreVue("stock/ssc/lister",['liste'=>$liste]);
    }



    public function historiqueMagasin(){

        $liste=$this->getModel("EntrerSortie")->listerMagasin();
        return $this->rendreVue("stock/magasin/historique");
    }

    public function historiquePharmacie(){
        $liste=$this->getModel("EntrerSortie")->listerPharmacie();
        return $this->rendreVue("stock/pharmacie/historique");
    }

    public function historiqueSsa(){
        return $this->rendreVue("stock/ssa/historique");
    }

    public function historiqueSsh(){
        return $this->rendreVue("stock/ssh/historique");
    }

    public function historiqueSsu(){
        return $this->rendreVue("stock/ssu/historique");
    }

    public function historiqueLabo(){
        return $this->rendreVue("stock/labo/historique");
    }

    public function historiqueSsc(){
        return $this->rendreVue("stock/ssc/historique");
    }


    public function repartitionMagasin(){
        return $this->rendreVue("stock/magasin/repartition");
    }

    public function repartitionPharmacie(){
        return $this->rendreVue("stock/pharmacie/repartition");
    }



    public function transfertMagasin(){

        return $this->rendreVue("stock/magasin/transfert");
    }

    public function transfertPharmacie(){

        return $this->rendreVue("stock/pharmacie/transfert");
    }


    public function retirerMagasin(){

        return $this->rendreVue("stock/magasin/retirer");
    }

    public function retirerPharmacie(){

        return $this->rendreVue("stock/pharmacie/retirer");
    }

    public function requisition($type){
        $var=array();
        if($type=="interne"){
            $var['requisition']="interne";
        }
        if($type=="externe"){
            $var['requisition']="externe";
        }
        return $this->rendreVue("stock/generale/requisition",$var);
    }

    public function requisitionMagasin($type){
        $var=array();
        if($type=="interne"){
            $var['requisition']="interne";
        }
        if($type=="externe"){
            $var['requisition']="externe";
        }
        return $this->rendreVue("stock/magasin/requisition",$var);
    }

    public function requisitionPharmacie($type){
        $var=array();
        if($type=="interne"){
            $var['requisition']="interne";
        }
        if($type=="externe"){
            $var['requisition']="externe";
        }
        return $this->rendreVue("stock/pharmacie/requisition",$var);
    }

    public function listeRequisition(){
        $var=array();
        $var['requisition']="tout";
        return $this->rendreVue("stock/generale/requisition",$var);
    }

    public function listeRequisitionMagasin(){
        $var=array();
        $var['requisition']="tout";
        return $this->rendreVue("stock/magasin/requisition",$var);
    }

    public function listeRequisitionPharmacie(){
        $var=array();
        $var['requisition']="tout";
        return $this->rendreVue("stock/pharmacie/requisition",$var);
    }

    public function requisitionParService($service){
        $var=array();
        $var['requisition']="tout";
        return $this->rendreVue("stock/".$service."/requisition",$var);
    }

}