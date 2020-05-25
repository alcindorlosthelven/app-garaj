<div class="clearfix"></div>
<br />
<h5>Liste Requisition Interne</h5>
<?php
if(isset($_GET['t'])){
    /* $id=$_GET['t'];
     $m=\Models\Chsm\Commande::livraisonInterne($id);
     if($m="ok"){
         echo "<script>
   alert('fait avec success');
   document.location.href='app.php?url=stock&type=pharmacie&action=requisition&type_requisition=interne';
 </script>";
     }*/
}
?>
<table class="table datatable-buttons">
    <thead>
    <tr>
        <td>Id</td>
        <th>A</th>
        <th>Date</th>
        <th>Livré</th>
        <th>Date livraison</th>
    </tr>
    </thead>
    <?php
    $c=new \Models\Chsm\Requisition();
    if(isset($_GET['statut'])){
        if($_GET['statut']=="non"){
            $listeInterne=$c->lister("non");
        }

        if($_GET['statut']=="encour"){
            $listeInterne=$c->lister("en_cour");
        }

        if($_GET['statut']=="livrer"){
            $listeInterne=$c->lister("oui");
        }

        if($_GET['statut']=="tout"){
            $listeInterne=$c->lister();
        }

    }else{
        $listeInterne=$c->lister();
    }
    foreach ($listeInterne as $c){
        ?>
        <tr>
            <th><?= $c->getId(); ?></th>
            <th><?php if($c->getA()==""){}else{ echo $c->getA()->getNom();  } ?></th>
            <th><?= $c->getDate(); ?></th>
            <th><?= $c->getLivrer(); ?></th>
            <th><?= $c->getDateLivraison(); ?></th>
            <?php
            if($c->getLivrer() == "non"){
                $idd=$c->getId();
                $v="<button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#message$idd'>Livré</button>";
            }else{
                $v="";
            }
            ?>
            <td><?=$v?></td>
        </tr>
        <tr>
            <td colspan="6">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $c->getId(); ?>">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div id="collapse<?= $c->getId(); ?>" class="panel-collapse collapse in active">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Item</th>
                                    <th>Size</th>
                                    <th>Categorie</th>
                                    <th>Quantité</th>
                                </tr>

                                <?php
                                $cmds=$c->getCommandes();
                                foreach ($cmds as $cmd){
                                    ?>

                                    <tr>
                                        <td>
                                            <?= $cmd->getItem()->getNom(); ?>
                                        </td>

                                        <td>
                                            <?= $cmd->getItem()->getSize(); ?>
                                        </td>

                                        <td>
                                            <?= $cmd->getItem()->getGroupe(); ?>
                                        </td>

                                        <td>
                                            <?= $cmd->getQuantite(); ?>
                                        </td>

                                    </tr>


                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="6"><hr /></td>
        </tr>

        <div id="message<?php echo $c->getId();?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmer Requisition</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                        <form class="form-horizontal forme_confirmer_requisition_interne" action="" method="post">
                            <?php
                            foreach ($cmds as $cmd ){
                                ?>
                                <div class="form-group col-md-6">
                                    <label><?= $cmd->getItem()->getNom()?></label>
                                    <input type="number" name="<?=$cmd->getId()?>-quantite" class="form-control" required>
                                    <input type="hidden" value="<?= $cmd->getId() ?>" name="item-<?= $cmd->getId() ?>">
                                </div>
                                <?php
                            }
                            ?>

                            <div class="form-group">
                                <input type="hidden" name="confirmer_livraison_requisition_interne">
                                <input type="hidden" name="id_requisition" value="<?= $c->getId(); ?>">
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