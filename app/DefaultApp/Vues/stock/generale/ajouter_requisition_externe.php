<div class="clearfix"></div>
<br />
<h5>Ajout Requisition</h5>
<form class="form-horizontal forme_requisition" action="" method="post" >
    <table class="table table-bordered">
        <tr>
            <th>Item</th>
            <th>Quantite</th>
            <th>Fournisseur</th>
        </tr>

        <tr>
            <td>
                <input value="" required type="text" name="item" class="form-control auto_item" >
            </td>

            <td>
                <input value="0" type="number"  name="quantite" class="form-control quantite">
            </td>

            <td>
                <select name="fournisseur" class="form-control location">
                    <?php
                    ListeFournisseurSelect();
                    ?>
                </select>
            </td>


            <td>
                <input type="hidden" name="requisition_externe">
                <input type="submit" class='btn btn-primary pull-right' value="Ajouter">
            </td>

        </tr>
    </table>

    <div class="message">
    </div>

</form>