<?php
require_once "../../../vendor/autoload.php";
if (isset($_POST['bdc'])) {
    $id_admision=$_POST['id_admision'];
    $admision=new \app\DefaultApp\Models\Admision();
    $admision=$admision->findById($id_admision);
    $service=$admision->getServiceActuel();
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $shit = $_POST['shit'];
    $id_patient=$admision->getIdPatient();
    if($admision==null){
        echo "Id admision non trouver";
        return;
    }

    $facture=\app\DefaultApp\Models\Facture::rechercherParAdmision($id_admision);
    if($facture==null){
        echo "Facture non trouver";
        return;
    }

    if(\app\DefaultApp\Models\BonDeCharge::bdcExiste($id_admision,$date,$shit)){
        echo "Shit Deja enregistrer pour la date : " . $date . " / " . $shit;
        return;
    }


    //creation bon de charge
    $bdc = new \app\DefaultApp\Models\BonDeCharge();
    $bdc->setIdAdmision($id_admision);
    $bdc->setDate($date);
    $bdc->setHeure($heure);
    $bdc->setUser(\systeme\Model\Utilisateur::session_valeur());
    $bdc->setShift($shit);
    $m = $bdc->add();
    if ($m == "ok") {
        $item_bdc=new \app\DefaultApp\Models\ItemBdc();
        $dernier_id = \app\DefaultApp\Models\BonDeCharge::dernierId();
        //fin creation de bon de charge
        $stock=new \app\DefaultApp\Models\Stock();
        $listeItem=$stock->findAll();
        foreach ($listeItem as $data){
            $id=$data->getId();
            if (isset($_POST[$id])) {
                $id_stock = $_POST[$id];
                $item = $id_stock;
                $groupe_item = $data->getGroupe();
                if ($groupe_item == "Medicament") {
                    $categorie_item = "medicament";
                } elseif ($groupe_item == "service") {
                    $categorie_item = "service";
                } else {
                    $categorie_item = "materiel medicaux";
                }
                //quantite item
                $quantite = $_POST['qt-' . $id_stock];

                if ($quantite != "") {
                    $prix = $data->getPrix();
                    $prix = str_replace(",", "", $prix);
                    $bdc_no = $dernier_id;
                    $jour = $date;

                    $item_bdc->setIdBdc($dernier_id);
                    $item_bdc->setIdItem($id_stock);
                    $item_bdc->setQuantite($quantite);
                    $item_bdc->setPrix($prix);
                    $item_bdc->add();

                    if (!\app\DefaultApp\Models\RepartitionStock::itemExisteService($service, $id_stock)) {
                        if ($data->getGroupe() != 'service') {
                            \app\DefaultApp\Models\RepartitionStock::augementer($service, $id_stock, -$quantite, \systeme\Model\Utilisateur::session_valeur());
                        }

                    } else {
                        $mm = \app\DefaultApp\Models\RepartitionStock::dimimuerBdc($service, $id_stock, $quantite, \systeme\Model\Utilisateur::session_valeur(), "consomation patient par bon de charge (" . $id_admision . ")", "Patient : " . $id_patient);
                    }
                    \app\DefaultApp\Models\Stock::updateStock($id_stock);

                    $item_facture = new \app\DefaultApp\Models\FactureItemDirect();
                    $item_facture->setIdFacture($facture->getId());
                    $item_facture->setIdItem($item);
                    $item_facture->setCategorieItem($categorie_item);
                    $item_facture->setQuantite($quantite);
                    $item_facture->setPrix($prix);
                    $item_facture->setIdBdc($bdc_no);
                    $item_facture->setJour($jour);
                    $item_facture->setCouvert("oui");

                    $ser=new \app\DefaultApp\Models\Service();
                    $ser=$ser->findById($service);
                    $nom_service=$ser->getSigle();
                    if ($nom_service == "SSH") {
                        $item_facture->setQtSsh($quantite);
                        $item_facture->setQtSsc(0);
                        $item_facture->setQtSsu(0);
                    }
                    if ($nom_service == "SSU") {
                        $item_facture->setQtSsh(0);
                        $item_facture->setQtSsc(0);
                        $item_facture->setQtSsu($quantite);
                    }

                    if ($nom_service == "SSC") {
                        $item_facture->setQtSsh(0);
                        $item_facture->setQtSsc($quantite);
                        $item_facture->setQtSsu(0);
                    }

                    $item_facture->add();
                }
            }
            $m = "ok";
        }

        $ms = $bdc->update();
        echo $ms;
    } else {
        echo $m;
    }

}
