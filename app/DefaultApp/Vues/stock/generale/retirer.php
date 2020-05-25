<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <?php
        $listeService=\app\DefaultApp\Models\Service::listerPourStock();
        ?>

        <div class="card">
            <div class="card-header"><h4>Retirer Un Article</h4></div>
            <div class="card-body">
                <div class="message"></div>
                <form class="form-horizontal forme_retirer_generale" action="" method="post" >
                    <table class="table table-bordered">
                        <tr>
                            <th>Item</th>
                            <th>Quantite</th>
                            <th>Location </th>
                            <th>Raison</th>
                            <th>Remarque</th>
                        </tr>

                        <tr>
                            <td>
                                <input value="" required type="text" name="item" class="form-control auto_item" >
                            </td>

                            <td>
                                <input value="0" type="number"  name="quantite" class="form-control quantite">
                            </td>

                            <td>
                                <select name="location" class="form-control de">
                                    <option value="" disabled>Choisir service</option>
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
                                <select name="destination" class="form-control">
                                    <option value="Destruction">Destruction</option>
                                    <option value="Endommagé">Endommagé</option>
                                    <option value="Expiré">Expiré</option>
                                    <option value="Retour vers fournisseur">Retour vers Fournisseur</option>
                                </select>
                            </td>

                            <td>
                                <input type="text" name="raison" class="form-control raison" required />
                            </td>


                            <td>
                                <input type="hidden" name="retirer">
                                <input type="submit" class='btn btn-primary pull-right' value="Retirer">
                            </td>

                        </tr>
                    </table>

                    <div class="message">
                    </div>

                </form>

                <div class="col-md-12 tableau_repartition">

                </div>
            </div>
        </div>

    </div>

</div>
