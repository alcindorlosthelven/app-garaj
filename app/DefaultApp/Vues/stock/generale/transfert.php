<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <?php
        $listeService = \app\DefaultApp\Models\Service::listerPourStock();
        ?>
        <div class="card">
            <div class="card-header"><h4>Tranfert D'article</h4></div>
            <div class="card-body">
                <form class="form-horizontal forme_transfert_generale" action="" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <th>Item</th>
                            <th>Quantite</th>
                            <th>De</th>
                            <th>A</th>
                        </tr>

                        <tr>
                            <td>
                                <input value="" type="text" name="item" class="form-control auto_item">
                            </td>

                            <td>
                                <input value="0" type="number" name="quantite" class="form-control quantite">
                            </td>

                            <td>
                                <select name="de" class="form-control de">
                                    <option value="" disabled="disabled">Choisir Service</option>
                                    <?php
                                    foreach ($listeService as $service) {
                                        ?>
                                        <option value="<?= $service->getId() ?>"><?= $service->getSigle() ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>

                            <td>
                                <select name="a" class="form-control a">
                                    <option value="" disabled="disabled">Choisir Service</option>
                                    <?php
                                    foreach ($listeService as $service) {
                                        ?>
                                        <option value="<?= $service->getId() ?>"><?= $service->getSigle() ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>

                            <td>
                                <input type="hidden" name="t2">
                                <input type="submit" class='btn btn-primary pull-right' value="Transferer">
                            </td>

                        </tr>
                    </table>

                    <div class="message">
                    </div>

                </form>

                <div class="tableau_repartition">

                </div>
            </div>
        </div>

    </div>

</div>
