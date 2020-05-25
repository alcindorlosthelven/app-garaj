<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <div class="card">
            <?php
            if(isset($id)){
                $item=new \app\DefaultApp\Models\Stock();
                $item=$item->findById($id);
                ?>
                <div class="card-header"><h4>Repartition (<strong><?= $item->getNom(); ?></strong>)</h4></div>
                <div class="card-body">
                    <table class="table table-bordered datatable-buttons" style="font-size: 12px">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Item</th>
                            <th>Caterogie</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Quantite</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php
                        $r = new app\DefaultApp\Models\RepartitionStock();
                        $r = $r->listerParItem($item->getId());
                        foreach ($r as $re) {
                            $service = new \app\DefaultApp\Models\Service();
                            $service = $service->findById($re->getService());
                            $nomService = $service->getSigle();
                            ?>
                            <tr>
                                <td><?= $re->getId(); ?></td>
                                <td> <?= app\DefaultApp\Models\Stock::nomItem($re->getItem()); ?></td>
                                <td><?= app\DefaultApp\Models\Stock::groupeItem($re->getItem()); ?></td>
                                <td><?= app\DefaultApp\Models\Stock::descriptionItem($re->getItem()); ?></td>
                                <td><?= $nomService ?></td>
                                <td> <?= $re->getQuantite(); ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                            data-target="#message<?php echo $re->getId(); ?>">Transfert
                                    </button>
                                </td>
                            </tr>

                            <div id="message<?php echo $re->getId(); ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Transfert Article</h4>
                                        </div>

                                        <div class="modal-body">

                                            <form class="form-horizontal forme_repartition_general" action="" method="post">
                                                <div class="form-group">
                                                    <label for="email">Item :</label>
                                                    <input type="hidden" readonly name="item"
                                                           value="<?= $re->getItem() ?>" class="form-control">
                                                    <input value="<?= app\DefaultApp\Models\Stock::nomItem($re->getItem()) ?>"
                                                           type="text" readonly name="" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Quantité :</label>
                                                    <input value="1" type="number" name="quantite" class="form-control">
                                                </div>


                                                <div class="form-group">
                                                    <label for="email">De :</label>
                                                    <input type="hidden" readonly name="de"
                                                           value="<?= $re->getService() ?>" class="form-control">
                                                    <input value="<?= $nomService ?>" type="text" readonly
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">A :</label>
                                                    <?php
                                                    $listeService = \app\DefaultApp\Models\Service::listerPourStock();
                                                    ?>
                                                    <select name="a" class="form-control">
                                                        <?php
                                                        foreach ($listeService as $service) {
                                                            ?>
                                                            <option value="<?= $service->getId() ?>"><?= $service->getSigle() ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class='btn btn-primary pull-right'
                                                           value="Transferer">
                                                </div>

                                            </form>

                                            <div class="message"></div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <?php
            }else{
                ?>
                <div class="card-header"><h4>Repartition Article</h4></div>
                <div class="card-body">
                    <table class="table table-bordered datatable-buttons" style="font-size: 12px">
                        <thead>
                        <tr>
                            <td>Id</td>
                            <th>Item</th>
                            <th>Size</th>
                            <th>Caterogie</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Quantite</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php
                        $r = new app\DefaultApp\Models\RepartitionStock();
                        $r = $r->lister();
                        foreach ($r as $re) {
                            $service = new \app\DefaultApp\Models\Service();
                            $service = $service->findById($re->getService());
                            $nomService = $service->getSigle();
                            ?>
                            <tr>
                                <td><?= $re->getId(); ?></td>
                                <td> <?= app\DefaultApp\Models\Stock::nomItem($re->getItem()); ?></td>
                                <td><?= app\DefaultApp\Models\Stock::sizeItem($re->getItem()); ?></td>
                                <td><?= app\DefaultApp\Models\Stock::groupeItem($re->getItem()); ?></td>
                                <td><?= app\DefaultApp\Models\Stock::descriptionItem($re->getItem()); ?></td>
                                <td><?= $nomService ?></td>
                                <td> <?= $re->getQuantite(); ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                            data-target="#message<?php echo $re->getId(); ?>">Transfert
                                    </button>
                                </td>
                            </tr>

                            <div id="message<?php echo $re->getId(); ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Transfert Article</h4>
                                        </div>

                                        <div class="modal-body">

                                            <form class="form-horizontal forme_repartition_general" action="" method="post">
                                                <div class="form-group">
                                                    <label for="email">Item :</label>
                                                    <input type="hidden" readonly name="item"
                                                           value="<?= $re->getItem() ?>" class="form-control">
                                                    <input value="<?= app\DefaultApp\Models\Stock::nomItem($re->getItem()) ?>"
                                                           type="text" readonly name="" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Quantité :</label>
                                                    <input value="1" type="number" name="quantite" class="form-control">
                                                </div>


                                                <div class="form-group">
                                                    <label for="email">De :</label>
                                                    <input type="hidden" readonly name="de"
                                                           value="<?= $re->getService() ?>" class="form-control">
                                                    <input value="<?= $nomService ?>" type="text" readonly
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">A :</label>
                                                    <?php
                                                    $listeService = \app\DefaultApp\Models\Service::listerPourStock();
                                                    ?>
                                                    <select name="a" class="form-control">
                                                        <option value="" disabled>Choisir service</option>
                                                        <?php
                                                        foreach ($listeService as $service) {
                                                            ?>
                                                            <option value="<?= $service->getId() ?>"><?= $service->getSigle() ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class='btn btn-primary pull-right'
                                                           value="Transferer">
                                                </div>

                                            </form>

                                            <div class="message"></div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            <?php
            }
            ?>

        </div>

    </div>

</div>

