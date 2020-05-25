<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <div class="card">
            <div class="card-header"><h4>Modifier Article</h4></div>
            <div class="card-body">
                <div class="message"></div>
                <?php
                if (isset($success)) {
                    ?>
                    <div class="alert alert-success"><?= $success ?></div>
                    <script>alert("modifier avec success");
                        document.location.href='stock';
                    </script>
                    <?php
                }
                ?>

                <?php
                if (isset($err)) {
                    ?>
                    <div class="alert alert-danger"><?= $err ?></div>
                    <?php
                }
                ?>

                <?php
                if (isset($item)) {
                    ?>
                    <form enctype="multipart/form-data" method="post" class="form-signin" id="" action="">
                        <div class="row">
                        <div class="col-md-6">
                            <table class="table">

                                <tr>
                                    <th>Date Expiration</th>
                                    <th><input value="<?= $item->getDateExpiration() ?>" class="form-control date datetimepicker8" type="text" name="date_expiration"  required /></th>
                                </tr>

                                <tr>
                                    <th>Group Item</th>
                                    <th>
                                        <select name="groupe" id="type" class="form-control">
                                            <option value="<?= $item->getGroupe() ?>"><?= $item->getGroupe() ?></option>
                                        </select>
                                    </th>
                                </tr>

                                <tr>
                                    <th>Nom</th>
                                    <th>
                                        <input value="<?= $item->getNom() ?>" class="form-control" type="text" name="nom" id="nom"
                                               required/>
                                    </th>
                                </tr>

                                <tr>
                                    <th>Nom Alternatif</th>
                                    <th><input value="<?= $item->getNomAlternatif() ?>" class="form-control" type="text"
                                               name="nom_alternatif" id="nom_alternatif"/></th>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <th>
                                        <input value="<?= $item->getDescription(); ?>" type="text" class="form-control"
                                               name="description">
                                    </th>
                                </tr>

                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table">

                                <tr>
                                    <th>Quantite Maximal</th>
                                    <th colspan="3"><input value="<?= $item->getQuantiteMaximale(); ?>" class="form-control"
                                                           type="number" name="quantite_maximale" id="quantite_maximale" required/>
                                    </th>

                                </tr>

                                <tr>
                                    <th>Quantite Critique</th>
                                    <th colspan="3"><input value="<?= $item->getQuantiteCritique(); ?>" class="form-control"
                                                           type="number" name="quantite_critique" id="quantite_critique" required/>
                                    </th>
                                </tr>

                                <tr style="display: none">
                                    <th>Achat par</th>
                                    <th>
                                        <select name="achat_par" class="form-control" id="type_stock">
                                            <option value="<?= $item->getEntrerPar() ?>"><?= $item->getEntrerPar() ?></option>
                                        </select>
                                    </th>

                                    <th>Vente par</th>
                                    <th>
                                        <select name="vente_par" class="form-control" id="vente_par">
                                            <option value="<?= $item->getRetirerPar() ?>"><?= $item->getRetirerPar() ?></option>
                                        </select>
                                    </th>

                                </tr>

                                <tr>
                                    <th>Cout</th>
                                    <th><input  value="<?= $item->getCout(); ?>" class="form-control" type="text" name="cout"  required/>
                                    </th>
                                </tr>

                                <tr>
                                    <th>Prix</th>
                                    <th><input value="<?= $item->getPrix(); ?>" class="form-control" name="prix" id="prix" required/></th>

                                    <th>
                                        <input type="hidden" name="modifier"/>
                                        <input type="hidden" name="id" value="<?= $item->getId(); ?>"/>
                                    </th>
                                    <th colspan="3"><input type="submit" value="Modifier" id="btn_stock" name="btn_stock" class="btn btn-primary pull-right"/></th>
                                </tr>

                            </table>

                        </div>
                        </div>

                    </form>
                    <?php
                }
                ?>
                <div class="message"></div>
            </div>
        </div>

    </div>
</div>