<?php
require_once "../../../vendor/autoload.php";
if (isset($_POST['ok'])) {
    try {
        $utilisateur=\systeme\Model\Utilisateur::session_valeur();
        $stock=new \app\DefaultApp\Models\Stock();
        $stock->remplire($_POST);
        $quantite = addslashes($_POST['quantite']);
        $nombre_total = $_POST['nombre_unite'];
        $stock->setTotalType($quantite);
        $stock->setTotalUnite($nombre_total);
        $stock->setUser($utilisateur);
        $stock->setActif("oui");
        $message=$stock->add();
        if ($message == "ok") {
            $rps = new app\DefaultApp\Models\RepartitionStock();
            $rps->remplire($_POST);
            $rps->setItem($stock->dernierId());
            if ($stock->getEntrerPar() == "unite") {
                $rps->setQuantite($stock->getTotalType());
            } else {
                $rps->setQuantite($stock->getTotalUnite());
            }
            $message2 = $rps->ajouter();
            if ($message2 == "ok") {
                $ets = new app\DefaultApp\Models\EntrerSortie();
                $ets->setItem($stock->dernierId());
                $ets->setNoTransaction(rand(0,100).rand(101,10000));
                $ets->setTypeTransaction("Ajout Item");
                $ets->setDate(date("Y-m-d h:i:s"));
                $ets->setLocation($rps->getService());
                $ets->setQuantiteAvant("0");
                $ets->setUser($utilisateur);
                if ($stock->getEntrerPar() == "unite") {
                    $ets->setQuantiteApres($stock->getTotalType());
                    $ets->setQuantite($stock->getTotalType());
                } else {
                    $ets->setQuantiteApres($stock->getTotalUnite());
                    $ets->setQuantite($stock->getTotalUnite());
                }
                $mes = $ets->ajouter();
                $historique = new \app\DefaultApp\Models\Historique();
                $historique->setUser($utilisateur);
                $historique->setAction("Ajouter item : " . $stock->getNom());
                $historique->add();
                echo $mes;
            }
        } else {
            echo $message;
        }

    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

if (isset($_POST['modifier'])) {
    try {
        $id = $_POST['id'];
        $nom = addslashes($_POST['nom']);
        $nom_alternatif = addslashes($_POST['nom_alternatif']);
        $description = addslashes($_POST['description']);
        $size = addslashes($_POST['size']);
        $marque = addslashes($_POST['marque']);
        $st = new app\DefaultApp\Models\Stock();
        $st->setNom($nom);
        $st->setNomAlternatif($nom_alternatif);
        $st->setDescription($description);
        $st->setSize($size);
        $st->setMarque($marque);

        $entrer_par = $_POST['achat_par'];
        $retirer_par = $_POST['vente_par'];

        $classe = trim(addslashes($_POST['classe']));
        $dosage = trim(addslashes($_POST['dose']));
        $forme = trim(addslashes($_POST['forme']));

        $prix = $_POST['prix'];
        $prix = app\DefaultApp\Models\App::formatComptable($prix);

        if ($_POST['type'] == "utilisation") {
            $prix = 0.00;
        }

        $st->setEntrerPar($entrer_par);
        $st->setRetirerPar($retirer_par);
        $st->setClasse($classe);
        $st->setDosage($dosage);
        $st->setForme($forme);
        $st->setType($_POST['type']);
        $st->setDateExpiration($_POST['date_expiration']);

        $message = $st->modifier();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

}

if(isset($_POST['ajuster_quantite'])){
    try{
        $id_service=\app\DefaultApp\Models\Service::idService("stock");
        $id=$_POST['id'];
        $quantite=intval($_POST['quantite']);
        \app\DefaultApp\Models\RepartitionStock::augementer($id_service,$id,$quantite,\systeme\Model\Utilisateur::session_valeur());
        $m=\app\DefaultApp\Models\Stock::updateStock($id);
        echo $m;
    }catch (Exception $ex){
        echo $ex->getMessage();
    }
}