
<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_stock") ?>
        <?php
        $listeService=\app\DefaultApp\Models\Service::listerPourStock();
        ?>

        <div class="card">
            <div class="card-header"><h4>Inventaire</h4></div>
            <div class="card-body">
                <div class="message"></div>
                <form method="post" action="" class="forme_inventory">
                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-control location_inventaire" name="location">
                            <option value="">Selectionner</option>
                            <option value="stock">Stock</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                    <table class='table table-bordered'>
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Quantité actuel</th>
                            <th>Remarque</th>
                        </tr>
                        </thead>
                        <tbody class="tlst">

                        </tbody>

                        <tfoot>
                        <tr>
                            <input type="hidden" name="ok">
                            <td colspan="7"><input type="submit" value="Valider" class="btn btn-success float-right"></td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>

                </form>
                <div class="message"></div>
            </div>
        </div>
    </div>
</div>

