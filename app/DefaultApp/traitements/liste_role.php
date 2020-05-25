<?php
require_once "../../../vendor/autoload.php";
if (isset($_POST['id_service'])) {
    $id_service = $_POST['id_service'];
    if ($id_service == "") {
        ?>
        <option value="">Choisir Categorie</option>
        <?php
    } else {
        $listeRole = \app\DefaultApp\Models\CategorieService::listerParService($id_service);
        if (count($listeRole) > 0) {
            foreach ($listeRole as $role) {
                ?>
                <option value="<?= $role->getId() ?>"><?= $role->getCategorie(); ?></option>
                <?php
            }
        } else {
            ?>
            <option value="">Choisir Catégorie</option>
            <?php
        }
    }
}