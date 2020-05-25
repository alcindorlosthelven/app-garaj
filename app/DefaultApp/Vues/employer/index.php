<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_employer") ?>
        <div class="card">

            <?php
            if(isset($_GET['desactiver'])){
                ?>
            <div class="card-header"><h4>Désactiver employer</h4></div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Desactiver Pour</label>
                        <select class="form-control" name="raison">
                            <option value="disponibilité">Disponibilité</option>
                            <option value="renvoie">Revoie</option>
                            <option value="démision">Démision</option>
                            <option value="congé">Congé</option>
                        </select>
                    </div>
                    <div class="form-group pull-right">
                        <input type="hidden" name="desactiver" value="<?= $_GET['desactiver'] ?>">
                        <input type="submit" value="confirmer" class="btn btn-primary">
                    </div>
                </form>
            </div>
                <?php
                return;
            }
            ?>

            <div class="card-header"><h4>Liste des employés</h4></div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>

                        <th>Nom / Prénom</th>
                        <th>Service</th>
                        <th>Poste</th>
                        <th>Identifiant</th>
                        <th>Actif</th>
                        <th>

                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if (isset($listeEmployer)) {
                        foreach ($listeEmployer as $emp) {
                            $id = $emp->getId();
                            $id_service=$emp->getService();
                            $ser=new \app\DefaultApp\Models\Service();
                            $ser=$ser->findById($id_service);

                            if ($emp->getActif() == "oui") {
                                $a = "<a class='dropdown-item' href='?desactiver=$id'>Désactiver</a>";
                            }

                            if ($emp->getActif() == "non") {
                                $a = "<a  class='dropdown-item' href='?activer=$id'>Activer</a>";
                            }

                            ?>
                            <tr>
                                <td><?php echo $emp->getNom()." ".$emp->getPrenom();; ?></td>
                                <td><?= $ser->getSigle()."<Br>".$ser->getDefinition() ?></td>
                                <td><?php echo $emp->getPoste(); ?></td>
                                <td><?php echo $emp->getIdentifiant(); ?></td>
                                <td><?php echo $emp->getActif(); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="dropdown-item" href="fiche-employer-<?php echo $emp->getId(); ?>">Afficher</a></li>
                                            <li><a  class="dropdown-item" href="modifier-employer-<?= $emp->getId() ?>">Modifier</a></li>
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