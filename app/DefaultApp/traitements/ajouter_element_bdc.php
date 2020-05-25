<?php
require_once "../../../vendor/autoload.php";
if(isset($_GET['nom_item']))
{
    $item=new \app\DefaultApp\Models\Stock();
    $id_i=\app\DefaultApp\Models\Stock::idItem($_GET['nom_item']);
    $item=$item->findById($id_i);
    if($item==null)
    {
        $tab['erreur']="Item introuvable dans le systeme.";
    }else{
        $tab=array();
        $tab['id_item']=$item->getId();
        $tab['nom_item']=$item->getNom();
    }
    echo json_encode($tab);
}
?>

