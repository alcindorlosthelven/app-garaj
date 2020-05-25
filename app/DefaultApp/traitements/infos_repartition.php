<?php
include_once "../../../vendor/autoload.php";
$item=$_GET['item'];
$item=app\DefaultApp\Models\Stock::idItem($item);
?>
<h3>Repartition (<strong><?= app\DefaultApp\Models\Stock::nomItem($item) ?></strong>)</h3>
<table class="table table-bordered datatable-buttons" style="font-size: 12px">
    <thead>
    <tr>
        <th>Item</th>
        <th>Size</th>
        <th>Caterogie</th>
        <th>Description</th>
        <th>Location</th>
        <th>Quantite</th>
        <!--<th></th>-->
    </tr>
    </thead>
    <?php
    $r=new app\DefaultApp\Models\RepartitionStock();
    $r=$r->listerParItem($item);
    foreach ($r as $re){
        $service=new \app\DefaultApp\Models\Service();
        $service=$service->findById($re->getService());
        ?>
        <tr>
            <td> <?= app\DefaultApp\Models\Stock::nomItem($re->getItem()) ; ?></td>
             <td><?= app\DefaultApp\Models\Stock::sizeItem($re->getItem()); ?></td>
             <td><?= app\DefaultApp\Models\Stock::groupeItem($re->getItem()); ?></td>
             <td><?= app\DefaultApp\Models\Stock::descriptionItem($re->getItem()); ?></td>
            <td> <?= $service->getSigle() ?></td>
            <td> <?= $re->getQuantite(); ?></td>
        </tr>
        <?php
    }
    ?>
</table>
</div>
