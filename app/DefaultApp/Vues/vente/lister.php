<div class="row">
    <div class="col-md-12">
        <div class="no-print">
            <?= \systeme\Application\Application::block("menu_vente") ?>
        </div>

        <div class="card">
            <div class="card-header"><h4>Liste des ventes</h4></div>
            <div class="card-body">
                <a class="btn btn-primary" href="lister-vente?tous">Tous</a>
                <a class="btn btn-primary" href="lister-vente?payer">Payer</a>
                <a class="btn btn-primary" href="lister-vente?non_payer">Non Payer</a>
                <hr>
                <?php
                if(isset($_GET['tous'])){
                    $vente=new \app\DefaultApp\Models\Vente();
                    $listeVente=$vente->findAll();
                    echo "<h4>Tous les ventes</h4>";
                }

                if(isset($_GET['payer'])){
                    $listeVente=\app\DefaultApp\Models\Vente::listePayer();
                    echo "<h4>Deja Payé</h4>";
                }

                if(isset($_GET['non_payer'])){
                    $listeVente=\app\DefaultApp\Models\Vente::listeNonPayer();
                    echo "<h4>Non Payé</h4>";
                }

                ?>

                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Numero</th>
                            <th>Client</th>

                            <th>Date</th>
                            <th>Date Paiement</th>

                            <th>Payer</th>
                        </tr>
                        </thead>

                        <?php
                        if (isset($listeVente))
                            $client=new \app\DefaultApp\Models\Client();
                            foreach ($listeVente as $p) {
                                $client=$client->findById($p->getIdClient());
                                if($p->getPayer()=="oui"){
                                    $lien="facture-vente-{$p->getId()}";
                                }else{
                                    $lien="ajouter-vente-{$p->getId()}";
                                }
                                ?>
                                <tr>
                                    <td><a  href="<?= $lien ?>"><?= $p->getId() ?></a></td>
                                    <td><a  href="<?= $lien ?>"><?= $p->getNumero() ?></a></td>
                                    <td><a target="_blank" href="fiche-client-<?= $client->getId() ?>"><?= ucfirst($client->getNom()." ".$client->getPrenom()) ?></a></td>
                                    <td><?= $p->getDate() ?></td>
                                    <td><?= $p->getDatePaiement() ?></td>
                                    <td><?= $p->getPayer(); ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>