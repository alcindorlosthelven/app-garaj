<?php
require_once "../../../vendor/autoload.php";
if(isset($_POST['t2'])){
    $item=app\DefaultApp\Models\Stock::idItem($_POST['item']);
    $quantite=$_POST['quantite'];
    $de=$_POST['de'];
    $a=$_POST['a'];
    if($quantite<0){
        echo "Imposible de faire le transfert , choisire un nombre positif pour la quantité";
    }else{
        if($de==$a){
            echo "Imposible de faire le transfert , Choisir une autre location pou la sortie ou pour l'entrer";
        }else{
            $message=app\DefaultApp\Models\RepartitionStock::transfert($item,$quantite,$de,$a,\systeme\Model\Utilisateur::session_valeur(),"transfert",\app\DefaultApp\Models\Service::nonService($a));
            echo $message;
        }
    }
}elseif(isset($_POST['retirer'])){
$item=app\DefaultApp\Models\Stock::idItem($_POST['item']);
$quantite=$_POST['quantite'];
$location=$_POST['location'];
$destination=addslashes($_POST['destination']);
$raison=trim(addslashes($_POST['raison']));
$diminuer=app\DefaultApp\Models\RepartitionStock::dimimuer($location,$item,$quantite,$_SESSION['user']['id'],$raison,$destination);
if($diminuer=="ok"){
$updateStock=app\DefaultApp\Models\Stock::updateStock($item);
echo $updateStock;
}
}elseif(isset($_POST['requisition_interne'])){
   $item=app\DefaultApp\Models\Stock::idItem($_POST['item']);
   $quantite=$_POST['quantite'];
   $de=$_POST['de'];
   $a=$_POST['a'];
   $date=date("Y-m-d h:i:s");
   $type="interne";
   $livre="non";
   $user=$_SESSION['user']['id'];
    if($item==""){
        echo "Item Introuvable";
    }elseif($quantite <=0){
        echo "Valeur quantité incorrect";
    }elseif ($de==$a){
        echo "Imposible de faire la requisition changer la valeur de A ou De";
    }else{
        $cmd=newapp\DefaultApp\Models\Commande();
        $cmd->setItem($item);
        $cmd->setQuantite($quantite);
        $cmd->setDe($de);
        $cmd->setA($a);
        $cmd->setDateCommande($date);
        $cmd->setType($type);
        $cmd->setLivrer($livre);
        $cmd->setUser($user);
        $message=$cmd->ajouter();
        echo $message;
    }
}elseif(isset($_POST['requisition_externe'])){
    $item=app\DefaultApp\Models\Stock::idItem($_POST['item']);
    $quantite=$_POST['quantite'];
    $fournisseur=trim(addslashes($_POST['fournisseur']));
    $date=date("Y-m-d h:i:s");
    $type="externe";
    $livre="non";
    $user=$_SESSION['user']['id'];
    if($item==""){
        echo "Item Introuvable";
    }elseif($quantite <=0){
        echo "Valeur quantité incorrect";
    }else{
        $cmd=newapp\DefaultApp\Models\Commande();
        $cmd->setItem($item);
        $cmd->setQuantite($quantite);
        $cmd->setFournisseur($fournisseur);
        $cmd->setDateCommande($date);
        $cmd->setType($type);
        $cmd->setLivrer($livre);
        $cmd->setUser($user);
        $message=$cmd->ajouter();
        echo $message;
    }
}elseif(isset($_POST['confirmer_requisition_externe'])){

    $id_commande=$_POST['id_commande'];
    $item=$_POST['item'];
    $quantite=$_POST['quantite'];
    $fournisseur=trim(addslashes($_POST['fournisseur']));
    $livre="oui";
    $date_livraison=$_POST['date_livraison'];
    $date=date("Y-m-d h:i:s");
    $type="externe";
    $user=$_SESSION['user']['id'];
    if($item==""){
        echo "Item Introuvable";
    }elseif($quantite <=0){
        echo "Valeur quantité incorrect";
    }else{
        $cmd=newapp\DefaultApp\Models\Commande();
        $cmd->setType("externe");
        $cmd->setId($id_commande);
        $cmd->setLivrer($livre);
        $cmd->setFournisseur($fournisseur);
        $cmd->setItem($item);
        $cmd->setDateLivraison($date_livraison);

        $cout=$_POST['cout'];
        $prix=$_POST['prix'];

        $cmd->setCout($cout);
        $cmd->setPrix($prix);
        $message=$cmd->modifier();

        if($message=="ok"){
            $type=$_POST['type'];

            if($type=="unite"){
             $total_unite=$_POST['quantite'];
            }else{
              $total_unite=$_POST['total_unite'];
            }

            $a=$_POST['a'];
           $message1=app\DefaultApp\Models\RepartitionStock::augementer($a,$item,$total_unite,$user);
           if($message1=="ok"){
               $m=app\DefaultApp\Models\Stock::updateStock($item);
               echo $m;
           }else{
               echo $message1;
           }



        }
    }
}
else{
    $item=$_POST['item'];
    $quantite=$_POST['quantite'];
    $de=$_POST['de'];
    $a=$_POST['a'];
    if($quantite<0){
        echo "Imposible de faire le transfert , choisire un nombre positif pour la quantité";
    }else{
        if($de==$a){
            echo "Imposible de faire le transfert , Choisir une autre location pou la sortie ou pour l'entrer";
        }else{
            $message=app\DefaultApp\Models\RepartitionStock::transfert($item,$quantite,$de,$a,\systeme\Model\Utilisateur::session_valeur(),"transfert",\app\DefaultApp\Models\Service::nonService($a));
            echo $message;
        }
    }

}




