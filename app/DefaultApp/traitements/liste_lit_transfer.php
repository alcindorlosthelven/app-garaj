<?php
require "../../../vendor/autoload.php";
if (isset($_GET['service'])) {
    $service = $_GET['service'];
    if($service==""){
        ?>
        <option value="">Lit</option>
        <?php
        return;
    }
    $liste=\app\DefaultApp\Models\Lit::listerParServiceLibre($service);
    foreach ($liste as $l) {
        ?>
        <option value="<?= $l->getId() ?>"><?= $l->getNom(); ?></option>
        <?php
    }
}
?>


