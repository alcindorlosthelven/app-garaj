<div class="clearfix"></div>
<br />
<h5>Liste Requisition Externe</h5>
<?php
if(isset($_GET['t'])){
    $id=$_GET['t'];
    echo $id;
  /*  $m=\Models\Chsm\Commande::livraisonInterne($id);
    if($m="ok"){
        echo "<script>
  alert('fait avec success');
  document.location.href='app.php?url=stock&type=magasin&action=requisition&type_requisition=interne&action_requisition=lister';
</script>";
    }*/
}
?>

<table class="table table-bordered datatable-buttons">
    <thead>
    <tr>
        <th>Id</th>
        <th>Item</th>
        <th>Quantite</th>
        <th>Fournisseur</th>
        <th>Date Demande</th>
        <th>Livré</th>
        <th>Date livraison</th>
        <th></th>
    </tr>
    </thead>

    <?php
    $c=new \Models\Chsm\Commande();
    $listeInterne=$c->listerParType("externe");
    foreach ($listeInterne as $c){
        ?>
<tr>
    <td><?= $c->getId(); ?></td>
    <td><?= $c->getItem()->getNom(); ?></td>
    <td><?= $c->getQuantite() ." ".$c->getItem()->getEntrerPar(); ?></td>
    <td><?= nomFournisseur($c->getFournisseur()); ?></td>
    <td><?= $c->getDateCommande(); ?></td>
    <td><?= $c->getLivrer(); ?></td>
    <td><?= $c->getDateLivraison(); ?></td>

    <?php
    if($c->getLivrer()=="oui"){
        ?>
        <td><a href=""><i class="fa fa-check"></i></a></td>
    <?php
    }else{
        ?>
        <td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#message1<?php echo $c->getId();?>">Confirmer</button></td>   <?php
    }
    ?>
</tr>

        <div id="message1<?php echo $c->getId();?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmation Requisition</h4>
                    </div>
                    <div class="modal-body">
                        <p>

                        <form class="form-horizontal forme_transfert" action="" method="post">

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="email">Date :</label>
                                </div>

                                <div class="col-sm-10">
                                    <input value="<?= date("Y-m-y h:i:s") ?>" type="text"  name="date_livraison" class="form-control datetime" required>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <br />


                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="email">Item :</label>
                                </div>

                                <div class="col-sm-10">
                                    <input type="hidden" readonly name="item" value="<?= $c->getItem()->getId() ?>" class="form-control">
                                    <input value="<?= \Models\Chsm\Stock::nomItem($c->getItem()->getId()) ?>" type="text" readonly name="" class="form-control">

                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <br />


                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="email">Quantité </label>
                                </div>

                                <div class="col-sm-8">
                                    <input value="<?= $c->getQuantite(); ?>" type="number"  name="quantite" class="form-control quantite" required readonly>
                                </div>

                                <div class="col-sm-2">
                                    <input name="type" class="form-control type2" readonly type="text" value="<?= \Models\Chsm\Stock::entrerPar($c->getItem()->getId())?>">
                                </div>
                            </div>

                            <?php
                            if(\Models\Chsm\Stock::entrerPar($c->getItem()->getId())!="unite"){
                                ?>
                                <div class="clearfix"></div>

                                <br />
                                <div class="form-group">
                                    <div class="col-sm-2">
                                    </div>

                                    <div class="col-sm-8">
                                        <input value="<?= $c->getQuantite() * \Models\Chsm\Stock::quantiteParType($c->getItem()->getId()); ?>" type="number"  name="total_unite" class="form-control total_unite" required readonly>
                                    </div>

                                    <div class="col-sm-2">
                                        <input name="" class="form-control" readonly value="Unité">
                                    </div>
                                </div>

                                <?php
                            }
                            ?>

                            <div class="clearfix"></div>

                            <br />

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="email">Cout :</label>
                                </div>

                                <div class="col-sm-10">
                                    <input value="" type="number" step="0.01"  name="cout" class="form-control cout2" required>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <br />


                            <div class="clearfix"></div>

                            <br />


                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="email">Prix :</label>
                                </div>

                                <div class="col-sm-10">
                                    <input type="number" step="0.01"  name="prix" class="form-control prix2" required>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <br />

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="email">De </label>
                                </div>

                                <div class="col-sm-10">
                                    <select name="fournisseur" class="form-control location">
                                        <option value="<?= $c->getFournisseur() ?>"><?= nomFournisseur($c->getFournisseur()); ?></option>
                                        <?php
                                        ListeFournisseurSelect();
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="clearfix"></div>

                            <br />

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="email">A :</label>
                                </div>

                                <div class="col-sm-10">
                                    <select name="a" class="form-control">
                                        <?php
                                        ListeServiceSelect();
                                        ?>
                                    </select>
                                </div>



                                <div class="clearfix"></div>
                                <br />

                                <input type="hidden" name="confirmer_requisition_externe">
                                <input type="hidden" name="id_commande" value="<?= $c->getId(); ?>">
                                <input type="submit" class='btn btn-primary pull-right' value="Confirmer">
                            </div>

                        </form>

                        <div class="clearfix"></div>

                        <div class="message"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
    ?>

</table>