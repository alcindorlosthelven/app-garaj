<?php
require "../../../vendor/autoload.php";
if(isset($_POST['ajouter_article'])){

    $taxe=floatval(\app\DefaultApp\Models\Configuration::getValueOfConfiguraton("taxe"));
    if(empty($taxe)){
        $taxe="0";
    }

    $rps=array();
    $id_client=$_POST['id_client'];
    $nomA=trim(addslashes($_POST['article']));
    $quantite=intval($_POST['quantite']);
    $stock=new \app\DefaultApp\Models\Stock();
    $stock=$stock->rechercherParNom($nomA);
    if($stock==null){
        $rps['statut']="no";
        $rps['value']="Aucun article trouver pour ce nom";
        echo json_encode($rps);
        return;
    }
    $vente=new \app\DefaultApp\Models\Vente();
    $date=date("Y-m-d");
    $vente->setNumero(rand(0,100000000000));
    $vente->setDate($date);
    $vente->setIdClient($id_client);
    $vente->setPayer("non");
    $vente->setDatePaiement("n/a");
    $vente->setTaxe($taxe);
    $vente->setDeduction("0");
    if(isset($_POST['id_vente'])){
        $id_vente=$_POST['id_vente'];
        $mv="ok";
    }else {
        if (\app\DefaultApp\Models\Vente::existe($id_client, $date)) {
            $vente = \app\DefaultApp\Models\Vente::rechercherParClientNonPayer($id_client, $date);
            $id_vente = $vente->getId();
            $mv = "ok";
        } else {
            $mv = $vente->add();
            $id_vente = \app\DefaultApp\Models\Vente::dernierId($id_client);
        }
    }

    if($mv=="ok"){
        $itemVente=new \app\DefaultApp\Models\ItemVente();
        $itemVente->setIdVente($id_vente);
        $itemVente->setIdProduit($stock->getId());
        $itemVente->setQuantite($quantite);
        $itemVente->setPrix($stock->getPrix());
        $mit=$itemVente->add();
        if($mit=="ok"){
            $did=\app\DefaultApp\Models\ItemVente::dernierId($id_vente);
            $soutotal=floatval($stock->getPrix()*$quantite);
            $soutotal1=\app\DefaultApp\Models\ItemVente::sousTotal($id_vente);
            $vtax=($soutotal1*$taxe) / 100;
            $total=$soutotal1+$vtax;
            $rps['statut']="ok";
            $rps['tax']=$taxe;
            $rps['vtax']=\app\DefaultApp\DefaultApp::formatComptable($vtax);
            $rps['date']=$date;
            $rps['invoice']=$vente->getNumero();
            $rps['order_id']=$id_vente;
            $rps['sous_total']=\app\DefaultApp\DefaultApp::formatComptable($soutotal1);
            $rps['total']=\app\DefaultApp\DefaultApp::formatComptable($total);
            $prix=\app\DefaultApp\DefaultApp::formatComptable($stock->getPrix());
            $soutotal=\app\DefaultApp\DefaultApp::formatComptable($soutotal);
            $ligne="<tr><td><a href='?sup={$did}'><i class='fa fa-trash'></i></a> {$stock->getNom()}</td><td>{$stock->getDescription()}</td><td class='update_quantite' data-id='{$did}' data-id_vente='{$id_vente}' contenteditable='true'>{$quantite}</td><td>{$prix}</td><td>{$soutotal}</td></tr>";
            $rps['ligne']=$ligne;
            echo json_encode($rps);
            return;
        }else{
            $rps['statut']="no";
            $rps['value']=$mit;
            echo json_encode($rps);
            return;
        }
    }else{
        $rps['statut']="no";
        $rps['value']=$mv;
        echo json_encode($rps);
        return;
    }





}

if(isset($_GET['finaliser'])){
    $id=$_GET['id'];
    echo $id;
    $vente=new \app\DefaultApp\Models\Vente();
    $vente=$vente->findById($id);
    $vente->setPayer("oui");
    $vente->setDatePaiement(date("Y-m-d"));
    $vente->update();
}

if(isset($_POST['update_quantite'])){
    $stock=new \app\DefaultApp\Models\Stock();
    $rps=array();
    $id=$_POST['id'];
    $value=intval($_POST['value']);
    $id_vente=$_POST['id_vente'];

    if($value<=0){
        $rps['statut']="no";
        $rps['value']="Entrer une valeur superieur a 0";
        echo json_encode($rps);
    }else{
        $itemVente=new \app\DefaultApp\Models\ItemVente();
        $itemVente=$itemVente->findById($id);
        $itemVente->setQuantite($value);
        $m=$itemVente->update();
        if($m=="ok"){
            $listeItem=\app\DefaultApp\Models\ItemVente::listerParVente($id_vente);
            $ligne="";
            $tax=10;
            foreach ($listeItem as $itv){
                $quantite = $itv->getQuantite();
                $prix = $itv->getPrix();
                $soutotal = $quantite * $prix;
                $stock = $stock->findById($itv->getIdProduit());

                $prix = \app\DefaultApp\DefaultApp::formatComptable($prix);
                $soutotal = \app\DefaultApp\DefaultApp::formatComptable($soutotal);
                $soutotal1 = \app\DefaultApp\Models\ItemVente::sousTotal($id_vente);
                $vtax = ($soutotal1 * $tax) / 100;
                $total = $soutotal1 + $vtax;

                $soutotal1 = \app\DefaultApp\DefaultApp::formatComptable($soutotal1);
                $vtax = \app\DefaultApp\DefaultApp::formatComptable($vtax);
                $total = \app\DefaultApp\DefaultApp::formatComptable($total);

                $rps['statut']="ok";
                $rps['vtax']=\app\DefaultApp\DefaultApp::formatComptable($vtax);
                $rps['sous_total']=\app\DefaultApp\DefaultApp::formatComptable($soutotal1);
                $rps['total']=\app\DefaultApp\DefaultApp::formatComptable($total);
                $prix=\app\DefaultApp\DefaultApp::formatComptable($stock->getPrix());
                $soutotal=\app\DefaultApp\DefaultApp::formatComptable($soutotal);
                $ligne .= "<tr><td><a href='?sup={$itv->getId()}'><i class='fa fa-trash'></i></a> {$stock->getNom()}</td><td>{$stock->getDescription()}</td><td class='update_quantite' data-id='{$itv->getId()}' data-id_vente='{$id_vente}' contenteditable='true'>{$quantite}</td><td>{$prix}</td><td>{$soutotal}</td></tr>";
            }
            $rps['ligne']=$ligne;
            $rps['statut']='ok';
            echo json_encode($rps);
            return;
        }else{
            $rps['statut']="no";
            $rps['value']=$m;
            echo json_encode($rps);
        }
    }

}