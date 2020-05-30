<div class="row">
    <div class="col-md-12">
        <div class="no-print">
            <?= \systeme\Application\Application::block("menu_achat") ?>
        </div>

        <div class="card">
            <div class="card-header"><h4>Liste des achats</h4></div>
            <div class="card-body">
                <a class="btn btn-primary" href="lister-achat?tous">Tous</a>
                <a class="btn btn-primary" href="lister-achat?finaliser">Finaliser</a>
                <a class="btn btn-primary" href="lister-achat?encour">En cours</a>
                <hr>
                <?php
                if(isset($_GET['tous'])){
                    $achat=new \app\DefaultApp\Models\Achat();
                    $listeAchat=$achat->findAll();
                    echo "<h4>Tous les achats</h4>";
                }

                if(isset($_GET['finaliser'])){
                    $listeAchat=\app\DefaultApp\Models\Achat::listeFinaliser();
                    echo "<h4>Finaliser</h4>";
                }

                if(isset($_GET['encour'])){
                    $listeAchat=\app\DefaultApp\Models\Achat::listeNonFinaliser();
                    echo "<h4>Non Finaliser</h4>";
                }


                ?>

                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fournisseur</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                        </thead>

                        <?php
                        if (isset($listeAchat)){
                            $fournisseur=new \app\DefaultApp\Models\Fournisseur();
                            foreach ($listeAchat as $p) {
                                $fournisseur=$fournisseur->findById($p->getIdFournisseur());
                                if($p->getStatut()=="finaliser"){
                                    $lien="facture-achat-{$p->getId()}";
                                }else{
                                    $lien="ajouter-achat-{$p->getId()}";
                                }
                                ?>
                                <tr>
                                    <td><a  href="<?= $lien ?>"><?= $p->getId() ?></a></td>
                                    <td><a  href="fiche-fournisseur-<?= $fournisseur->getId() ?>"><?= ucfirst($fournisseur->getNom()) ?></a></td>
                                    <td><?= $p->getDate() ?></td>
                                    <td><?= $p->getStatut(); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>