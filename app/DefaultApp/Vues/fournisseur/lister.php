<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_fournisseur") ?>
        <div class="card">
            <div class="card-header"><h4>Liste des Fournisseurs</h4></div>

            <div class="card-body">
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if (isset($listeFournisseur)) {
                        foreach ($listeFournisseur as $fournisseur) {
                            ?>
                            <tr>
                                <td><a href="ajouter-achat-<?= $fournisseur->getId() ?>"><i class="fa fa-shopping-cart"></i></a></td>
                                <td><?= $fournisseur->getNom() ?></td>
                                <td><?= $fournisseur->getAdresse() ?></td>
                                <td><?= $fournisseur->getTelephone() ?></td>
                                <td><?= $fournisseur->getEmail() ?></td>
                                <td><?= $fournisseur->getStatut(); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="dropdown-item" href="fiche-fournisseur-<?php echo $fournisseur->getId(); ?>"> Afficher</a></li>
                                            <li><a  class="dropdown-item" href="modifier-fournisseur-<?= $fournisseur->getId() ?>">Modifier</a></li>
                                            <li>
                                                <?php
                                                if ($fournisseur->getStatut() == "actif") {
                                                    ?>
                                                    <a class='dropdown-item' style='color:red;'
                                                       href='?desactiver=<?= $fournisseur->getId() ?>'>Desactiver</a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class='dropdown-item' style='color:black;'
                                                       href='?activer=<?= $fournisseur->getId() ?>'>Activer</a>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>