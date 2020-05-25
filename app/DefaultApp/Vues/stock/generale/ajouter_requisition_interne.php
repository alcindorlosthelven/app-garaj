<div class="clearfix"></div>
<br />
<h5>Ajout Requisition</h5>
<?php echo $_GET['type_requisition'] ?>
<form class="form-horizontal forme_requisition" action="" method="post" >
    <table class="table table-bordered">
        <tr>
            <th>Item</th>
            <th>Quantite</th>
            <th>De </th>
            <th>A</th>
        </tr>

        <tr>
            <td>
                <input value="" required type="text" name="item" class="form-control auto_item" >
            </td>

            <td>
                <input value="0" type="number"  name="quantite" class="form-control quantite">
            </td>

            <td>
                <select name="de" class="form-control location">
                    <?php
                    ListeServiceSelect();
                    ?>
                </select>
            </td>

            <td>
                <select name="a" class="form-control location">
                    <?php
                    ListeServiceSelect();
                    ?>
                </select>
            </td>

            <td>
                <input type="hidden" name="requisition_interne">
                <input type="submit" class='btn btn-primary pull-right' value="Ajouter">
            </td>

        </tr>
    </table>

    <div class="message">
    </div>

</form>