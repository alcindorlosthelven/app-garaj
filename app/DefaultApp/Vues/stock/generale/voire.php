<div class="signin-form col-md-12" id="">
    <?php
    include "vues/block/menu_stock_generale.php";
    ?>
    <h4>Infos Item</h4>
    <?php
    if (isset($success)) {
        ?>
        <div class="alert alert-success"><?= $success ?></div>
        <script>alert("modifier avec success");
            document.location.href = 'app.php?url=stock&type=stock_generale&action=lister';
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
            <div class="col-md-6">
                <table class="table">

                    <tr>
                        <th>Type</th>
                        <th>
                            <select name="type" class="form-control" readonly>
                                <option value="<?= $item->getType() ?>"><?= $item->getType() ?></option>
                            </select>
                        </th>
                    </tr>

                    <tr>
                        <th>Date Expiration</th>
                        <th><input readonly value="<?= $item->getDateExpiration() ?>" class="form-control date datetimepicker8"
                                   type="text" name="date_expiration" required/></th>
                    </tr>

                    <tr>
                        <th>Group Item</th>
                        <th>
                            <select readonly name="groupe" id="type" class="form-control">
                                <option value="<?= $item->getGroupe() ?>"><?= $item->getGroupe() ?></option>
                            </select>
                        </th>
                    </tr>

                    <tr>
                        <th>Nom</th>
                        <th>
                            <input readonly value="<?= $item->getNom() ?>" class="form-control" type="text" name="nom" id="nom"
                                   required/>
                        </th>
                    </tr>

                    <tr>
                        <th>Nom Alternatif</th>
                        <th><input readonly value="<?= $item->getNomAlternatif() ?>" class="form-control" type="text"
                                   name="nom_alternatif" id="nom_alternatif"/></th>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <th>
                            <input readonly value="<?= $item->getDescription(); ?>" type="text" class="form-control"
                                   name="description">
                        </th>
                    </tr>

                    <tr>
                        <th>Marque</th>
                        <th><input readonly value="<?= $item->getMarque() ?>" class="form-control" type="text" name="marque"
                                   id="marque"/></th>
                    </tr>

                    <tr>
                        <th>Size</th>
                        <th><input readonly value="<?= $item->getSize() ?>" class="form-control" type="text" name="size"
                                   id="size" required/></th>
                    </tr>


                    <tr>
                        <th>Classe</th>
                        <th><input  readonly value="<?= $item->getSize() ?>" class="form-control gm" type="text" name="classe"/>
                        </th>
                    </tr>

                </table>
            </div>

            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Forme</th>
                        <th colspan="3"><input readonly value="<?= $item->getForme(); ?>" class="form-control gm" type="text"
                                               name="forme"/></th>
                    </tr>

                    <tr>
                        <th>Dose</th>
                        <th colspan="3"><input readonly value="<?= $item->getDosage(); ?>" class="form-control gm" type="text"
                                               name="dose"/></th>
                    </tr>


                    <tr>
                        <th>Quantite Maximal</th>
                        <th colspan="3"><input readonly value="<?= $item->getQuantiteMaximale(); ?>" class="form-control"
                                               type="number" name="quantite_maximale" id="quantite_maximale" required/>
                        </th>

                    </tr>

                    <tr>
                        <th>Quantite Critique</th>
                        <th colspan="3"><input readonly value="<?= $item->getQuantiteCritique(); ?>" class="form-control"
                                               type="number" name="quantite_critique" id="quantite_critique" required/>
                        </th>
                    </tr>

                    <tr>
                        <th>Achat par</th>
                        <th>
                            <select readonly name="achat_par" class="form-control" id="type_stock">
                                <option value="<?= $item->getEntrerPar() ?>"><?= $item->getEntrerPar() ?></option>
                            </select>
                        </th>

                        <th>Vente par</th>
                        <th>
                            <select readonly name="vente_par" class="form-control" id="vente_par">
                                <option value="<?= $item->getRetirerPar() ?>"><?= $item->getRetirerPar() ?></option>

                            </select>
                        </th>

                    </tr>

                    <tr>
                        <th>Cout</th>
                        <th><input readonly value="<?= $item->getCout(); ?>" class="form-control" type="text" name="cout"
                                   required/>
                        </th>
                    </tr>

                    <tr>
                        <th>Prix</th>
                        <th><input readonly value="<?= $item->getPrix(); ?>" class="form-control" name="prix" id="prix"
                                   required/></th>
                    </tr>

                    <tr>
                        <th>
                            <input type="hidden" name="modifier"/>
                            <input type="hidden" name="id" value="<?= $item->getId(); ?>"/>
                        </th>
                    </tr>

                </table>

            </div>

        </form>
        <?php
    }
    ?>
</div>
