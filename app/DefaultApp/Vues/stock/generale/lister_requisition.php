<div class="clearfix"></div>
<br />
<h5>Liste Requisition</h5>
<?php
if(isset($_GET['t'])){
    $id=$_GET['t'];
    $m=\Models\Chsm\Commande::livraisonInterne($id);
    if($m="ok"){
        echo "<script>
  alert('fait avec success');
  document.location.href='app.php?url=stock&type=magasin&action=requisition&type_requisition=interne&action_requisition=lister';
</script>";
    }
}
?>
<table class="table table-bordered datatable-buttons">
    <thead>
    <tr>
        <td>Id</td>
        <td>Type</td>
        <td>Item</td>
        <td>Quantite</td>
        <th>De</th>
        <th>A</th>
        <th>Fournisseur</th>
        <th>Date Demande</th>
        <th>Livré</th>
        <th>Date livraison</th>
        <th>Cout</th>
        <th>Prix</th>
    </tr>
    </thead>

    <?php
    $c=new \Models\Chsm\Commande();
    $listeInterne=$c->lister();
    foreach ($listeInterne as $c){
        ?>
<tr>
    <td><?= $c->getId(); ?></td>
    <td><?= $c->getType(); ?></td>
    <td><?= $c->getItem()->getNom(); ?></td>
    <td><?= $c->getQuantite(); ?></td>

    <td><?php if($c->getDe()==""){}else{ echo $c->getDe()->getNom();  } ?></td>
    <td><?php if($c->getA()==""){}else{ echo $c->getA()->getNom();  } ?></td>
    <td><?= nomFournisseur($c->getFournisseur()); ?></td>
    <td><?= $c->getDateCommande(); ?></td>
    <td><?= $c->getLivrer(); ?></td>
    <td><?= $c->getDateLivraison(); ?></td>

    <td><?= $c->getCout(); ?></td>
    <td><?= $c->getPrix(); ?></td>

</tr>
        <?php
    }
    ?>

</table>