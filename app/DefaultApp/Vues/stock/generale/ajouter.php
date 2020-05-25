<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <div class="card">
            <div class="card-header"><h4>Nouveau Article</h4></div>
            <div class="card-body">
                <div class="message"></div>
                <form enctype="multipart/form-data" method="post" class="form-signin" id="nouveau_produit3" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr style="display: none">
                                    <th>Type</th>
                                    <th>
                                        <select name="type" class="form-control">
                                            <option value="vendu">vendu</option>
                                        </select>
                                    </th>
                                </tr>

                                <tr style="display: none">
                                    <th>Date Expiration</th>
                                    <th><input value="12/12/1990" class="form-control date datetimepicker8" type="text"
                                               name="date_expiration" required/></th>
                                </tr>

                                <tr style="display: none">
                                    <th>Group</th>
                                    <th>
                                        <select name="groupe" id="type" class="form-control">
                                            <option value="piece automobil" >Piece automobil</option>
                                        </select>
                                    </th>
                                </tr>

                                <tr>
                                    <th>Code</th>
                                    <th><input class="form-control" type="text" name="code" required/>
                                        <input value="<?= app\DefaultApp\Models\Service::idService("stock"); ?>"
                                               class="form-control" type="hidden" name="service" id="service" readonly/>
                                    </th>
                                </tr>

                                <tr>
                                    <th>Nom</th>
                                    <th><input class="form-control" type="text" name="nom" id="nom" required/>
                                    </th>
                                </tr>

                                <tr>
                                    <th>Nom Alternatif</th>
                                    <th><input class="form-control" type="text" name="nom_alternatif"
                                               id="nom_alternatif"/></th>
                                </tr>


                                <tr>
                                    <th>Quantite Maximal</th>
                                    <th><input class="form-control" type="number" name="quantite_maximale"
                                               id="quantite_maximale" required/></th>

                                </tr>

                                <tr>
                                    <th>Quantite Critique</th>
                                    <th><input class="form-control" type="number" name="quantite_critique"
                                               id="quantite_critique" required/></th>
                                </tr>


                                <tr>
                                    <th>Description</th>
                                    <th>
                                        <textarea class="editeur" name="description" id="description" style="width:100%"></textarea>
                                    </th>
                                </tr>


                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table">

                                <tr style="display: none">
                                    <th>Achat par</th>
                                    <th>
                                        <select name="entrer_par" class="form-control" id="type_stock">
                                            <option value="unite">Unite</option>
                                        </select>
                                    </th>

                                    <th>Vente par</th>
                                    <th>
                                        <select name="retirer_par" class="form-control" id="vente_par">
                                            <option value="unite">Unite</option>
                                        </select>
                                    </th>

                                </tr>

                                <tr>
                                    <th>Quantite</th>
                                    <th><input class="form-control" type="number" name="quantite" id="quantite" required/></th>
                                    <th colspan="2">
                                        <input type="text" value="Unite" readonly id="ab" class="form-control">
                                    </th>
                                </tr>

                                <tr>
                                    <th>Nombre Unite</th>
                                    <th><input class="form-control" name="quantite_par_type" type="number" id="nb_unite" required/></th>
                                    <th colspan="2"><input name="nombre_unite" id="nombre_total" required readonly class="form-control"></th>
                                </tr>

                                <tr>
                                    <th>Cout Unitaire</th>
                                    <th><input class="form-control" type="number" name="cout" id="cout_unitaire"
                                               step="0.01" required/></th>
                                    <th colspan="2"><input class="form-control" type="number" name="cout_total"
                                                           id="cout_total" step="0.01" readonly required/></th>
                                </tr>

                                <tr>
                                    <th>Prix</th>
                                    <th><input class="form-control" type="text" name="prix" id="prix" required/></th>

                                    <th>markup %</th>
                                    <th colspan="2"><input type="text" name="markup" id="markup" required value="0"
                                                           class="form-control"></th>
                                </tr>


                            </table>
                            <div class="form-group">
                                <input type="hidden" name="ok"/>
                                <input type="submit" value="Enregistrer" id="btn_stock" name="btn_stock"
                                       class="btn btn-primary float-right"/>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="message"></div>
            </div>
        </div>

    </div>
</div>
