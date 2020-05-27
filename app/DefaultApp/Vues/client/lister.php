<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_client") ?>
        <div class="card">
            <?php
            if(isset($_GET['activer'])){
                $id=$_GET['activer'];
                $client=new \app\DefaultApp\Models\Client();
                $client=$client->findById($id);
                $client->setActif("oui");
                $client->update();
                \app\DefaultApp\DefaultApp::redirection("lister_client");
            }

            if(isset($_GET['desactiver'])){
                $id=$_GET['desactiver'];
                $client=new \app\DefaultApp\Models\Client();
                $client=$client->findById($id);
                $client->setActif("non");
                $client->update();
                \app\DefaultApp\DefaultApp::redirection("lister_client");
            }
            ?>
            <div class="card-header"><h4>Liste des clients</h4></div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Identifiant</th>
                        <th>Actif</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if (isset($listeClient)) {
                        foreach ($listeClient as $client) {
                            $id = $client->getId();

                            if ($client->getActif() == "oui") {
                                $a = "<a class='dropdown-item' href='?desactiver=$id'>Désactiver</a>";
                            }

                            if ($client->getActif() == "non") {
                                $a = "<a  class='dropdown-item' href='?activer=$id'>Activer</a>";
                            }

                            ?>
                            <tr>
                                <td><a href="ajouter-vente-<?= $client->getId() ?>"><i class="fa fa-shopping-cart"></i></a></td>
                                <td><?= $client->getId() ?></td>
                                <td><?php echo $client->getNom()?></td>
                                <td><?= $client->getPrenom() ?></td>
                                <td><?php echo $client->getTelephone(); ?></td>
                                <td><?php echo $client->getEmail(); ?></td>
                                <td><?php echo $client->getPseudo(); ?></td>
                                <td><?php echo $client->getActif(); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="dropdown-item" href="fiche-client-<?php echo $client->getId(); ?>">Afficher</a></li>
                                            <li><a class="dropdown-item" href="modifier-client-<?= $client->getId() ?>">Modifier</a></li>
                                            <li><?= $a ?></li>
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
</div>