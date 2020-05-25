<?php
require_once "../../../vendor/autoload.php";
$location = $_GET['location'];
$stock = new \app\DefaultApp\Models\Stock();
if ($location == "") {
    return;
}
$idService=\app\DefaultApp\Models\Service::idService($location);
$list = $stock->listerParService($idService);
if (isset($list))
    foreach ($list as $st) {
        ?>
        <tr>
            <td><?= $st->getCode(); ?></td>
            <td><?= $st->getNom(); ?></td>
            <td><?= $st->quantite?></td>
            <td><input value="<?= $st->quantite?>" type="number" min="0" name="qt-apres-<?= $st->getId(); ?>" class="form-control" required></td>
            <td>
                <input type="hidden" name="item-<?= $st->getId(); ?>" value="<?= $st->getId(); ?>">
                <input type="hidden" name="qt-avant-<?= $st->getId(); ?>" value="<?= $st->quantite; ?>">
                <input value="ok" type="text" name="remark-<?= $st->getId(); ?>" class="form-control" required>
            </td>
        </tr>
        <?php
    }
?>
