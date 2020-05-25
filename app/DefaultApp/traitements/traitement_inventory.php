<?php
require_once "../../../vendor/autoload.php";

if (isset($_POST['ok'])) {
    $stock = new \app\DefaultApp\Models\Stock();
    $id_service = trim(addslashes($_POST['location']));
    $id_service=\app\DefaultApp\Models\Service::idService($id_service);
    $lst = $stock->listerParService($id_service);
    $user = \systeme\Model\Utilisateur::session_valeur();

    $inv = new \app\DefaultApp\Models\Inventaire();
    $inv->setService($id_service);
    $msg="";
    foreach ($lst as $st) {
        $id_stock = $st->getId();
        if (isset($_POST["item-" . $id_stock])) {
            $item = $_POST['item-' . $id_stock];
            $qt_avant = $_POST['qt-avant-' . $id_stock];
            $qt_apres = $_POST['qt-apres-' . $id_stock];
            $remarque = $_POST['remark-' . $id_stock];
            $inv->setItem($item);
            $inv->setQtAvant($qt_avant);
            $inv->setQtApres($qt_apres);
            $inv->setRemarque($remarque);
            $inv->setUser($user);
            $inv->setDate(date("Y-m-d"));
            $m = $inv->enregistrer();
            if ($m == "ok") {
                $m=\app\DefaultApp\Models\RepartitionStock::updateQuantite($id_service,$item,$qt_apres);
                \app\DefaultApp\Models\Stock::updateStock($item);
                $ets = new app\DefaultApp\Models\EntrerSortie();
                $ets->setItem($stock->dernierId());
                $ets->setNoTransaction(rand(0,100).rand(101,10000));
                $ets->setTypeTransaction("Invantaire - Modifier quantité");
                $ets->setDate(date("Y-m-d h:i:s"));
                $ets->setLocation($id_service);
                $ets->setDestination($id_service);
                $ets->setQuantiteAvant($qt_avant);
                $ets->setUser(\systeme\Model\Utilisateur::session_valeur());
                if ($stock->getEntrerPar() == "unite") {
                    $ets->setQuantiteApres($qt_apres);
                    $ets->setQuantite($qt_apres);
                } else {
                    $ets->setQuantiteApres($qt_apres);
                    $ets->setQuantite($qt_apres);
                }
                $mes = $ets->ajouter();
                $msg=$m;
            }else{
                $msg=$m;
            }
        }
    }
    $historique = new \app\DefaultApp\Models\Historique();
    $historique->setUser(\systeme\Model\Utilisateur::session_valeur());
    $historique->setAction("Invetanire ");
    $historique->add();
    echo $msg;
}