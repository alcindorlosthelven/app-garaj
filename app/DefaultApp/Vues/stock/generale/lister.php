<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <?php
        $inactif = "";
        $role = \systeme\Model\Utilisateur::role();
        $stock = new \app\DefaultApp\Models\Stock();
        $liste = $stock->findAll();
        if (isset($_GET['activer']) and isset($_GET['item'])) {
            $item = $_GET['item'];
            \app\DefaultApp\Models\Stock::statut($item, 'oui');
            echo "<script>document.location.href='stock';</script>";
        }

        if (isset($_GET['desactiver']) and isset($_GET['item'])) {
            $item = $_GET['item'];
            \app\DefaultApp\Models\Stock::statut($item, 'non');
            echo "<script>document.location.href='stock';</script>";
        }

        if (isset($_GET['innactif'])) {
            $liste = $stock->listerInnactif();
            $inactif = "Inactif";
        }

        ?>
        <div class="card">
            <div class="card-header"><h4>Liste des Articles <?= $inactif ?></h4></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class='table table-bordered datatable'>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Categorie</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <!-- <th>Unité</th>-->
                            <th></th>
                        </tr>
                        </thead>
                        <?php
                        if (isset($liste)) {
                            foreach ($liste as $item) {
                                ?>
                                <tr>
                                    <td><?= $item->getId() ?></td>
                                    <td><?= $item->getCode(); ?></td>
                                    <td><?= $item->getNom(); ?></td>
                                    <td><?= $item->getDescription(); ?></td>
                                    <td><?= $item->getGroupe(); ?></td>
                                    <td><?= $item->getTotalType() . " " . $item->getEntrerPar(); ?></td>
                                    <td><?= $item->getPrix() . " HTG"; ?></td>
                                    <!-- <td><?/*= $item->getTotalUnite(); */ ?></td>-->
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Action</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <button class='dropdown-item' data-toggle='modal' data-target='#m<?=$item->getId()?>'>
                                                        Ajuster Quantité
                                                    </button>
                                                </li>

                                                <li>
                                                    <a class='dropdown-item'
                                                       href="modifier-item-<?= $item->getId() ?>">Modifier</a>
                                                </li>
                                                <li><a class='dropdown-item'
                                                       href="historique-item-<?= $item->getId() ?>">Historique</a>
                                                </li>
                                                <li><a class='dropdown-item'
                                                       href="repartition-item-<?= $item->getId() ?>">Repartition</a>
                                                </li>
                                                <li>
                                                    <button class='dropdown-item' data-toggle='modal'
                                                            data-target='#infos'
                                                            data-id='<?= $item->getId(); ?>'>
                                                        Voir
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" role="dialog" id="m<?= $item->getId(); ?>" style="position: absolute">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ajuster Quantité</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="message"></div>
                                               <form class="ajuster_quantite was-validated" method="post">
                                                   <div class="form-group">
                                                       <label>Quantite Actuel : <?= $item->getTotalType() . " " . $item->getEntrerPar(); ?></label>
                                                   </div>

                                                   <div class="form-group">
                                                       <label>Quantité</label>
                                                       <input min="0" type="number" required class="form-control" name="quantite">
                                                   </div>

                                                   <div class="form-group">
                                                       <input type="hidden" name="ajuster_quantite">
                                                       <input type="hidden" name="id" value="<?= $item->getId() ?>">
                                                       <input type="submit" value="Enregistrer" class="btn btn-primary float-right" >
                                                   </div>
                                               </form>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>



        <div class="modal fade" id="infos" role="dialog">
            <div class="modal-dialog modal-lg fetched-data" role="document">

            </div>
        </div>
    </div>
</div>


