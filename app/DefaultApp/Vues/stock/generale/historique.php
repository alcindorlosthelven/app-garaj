
<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <div class="card">
            <?php
            if(isset($item)){
                $numero=$item->getId();
                ?>
                <div class="card-header"><h4>Historique (<srong><?= $item->getNom() ?></srong>)</h4></div>
                <div class="card-body">
                    <nav class="nav nav-tabs">
                        <a class="nav-item nav-link active" href=".tout" data-toggle="tab">Tout</a></li>
                    </nav>
                    <div class="tab-content">
                        <br />
                        <div class="tab-pane active tout">
                            <div class="table-responsive">
                            <table class="table table-bordered datatable" style="font-size:11px;">
                                <tr>
                                    <th>Item</th>
                                    <th>Type Transaction</th>
                                    <th>Date</th>
                                    <th>Destination</th>
                                    <th>Qt Avant</th>
                                    <th>Quantite</th>
                                    <th>Qt Apres</th>
                                </tr>

                                <?php
                                $es=new app\DefaultApp\Models\EntrerSortie();
                                $liste=$es->listerParItem($numero);
                                foreach ($liste as $st){
                                    ?>
                                    <tr>
                                        <td><?= app\DefaultApp\Models\Stock::nomItem($st->getItem()) ?></td>
                                        <td><?= $st->getTypeTransaction() ?></td>
                                        <td><?= $st->getDate() ?></td>
                                        <td><?= $st->getDestination() ?></td>
                                        <td><?= $st->getQuantiteAvant(); ?></td>
                                        <td><?= $st->getQuantite(); ?></td>
                                        <td><?= $st->getQuantiteApres(); ?></td>
                                    </tr>
                                    <?php
                                }

                                ?>

                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="card-header"><h4>Historique</h4></div>
                <div class="card-body">
                    <nav class="nav nav-tabs">
                        <a class="nav-item nav-link active" href="#tout" data-toggle="tab">Tout</a></li>
                    </nav>

                    <div class="tab-content">
                        <br />
                        <div id="tout" class="tab-pane active">
                            <div class="table-responsive">
                            <table class="table table-bordered datatable" style="font-size:11px;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Item</th>
                                    <th>Type Transaction</th>
                                    <th>Date</th>
                                    <th>Raison</th>
                                    <th>Destination</th>
                                    <th>Qt Avant</th>
                                    <th>Quantite</th>
                                    <th>Qt Apres</th>
                                </tr>
                                </thead>

                                <?php
                                $es=new app\DefaultApp\Models\EntrerSortie();
                                $liste=$es->lister();
                                foreach ($liste as $st){
                                    ?>
                                    <tr>
                                        <td><?= $st->getId() ?></td>
                                        <td><?= app\DefaultApp\Models\Stock::nomItem($st->getItem()) ?></td>
                                        <td><?= $st->getTypeTransaction() ?></td>
                                        <td><?= $st->getDate() ?></td>
                                        <td><?= $st->getRaison(); ?></td>
                                        <td><?= $st->getDestination(); ?></td>
                                        <td><?= $st->getQuantiteAvant(); ?></td>
                                        <td><?= $st->getQuantite(); ?></td>
                                        <td><?= $st->getQuantiteApres(); ?></td>

                                    </tr>
                                    <?php
                                }

                                ?>

                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>

    </div>

</div>

