<div class="row">
    <div class="col-md-12">
        <?php if (!isset($client) and !isset($vente)) {
            return;
        }

        $ligne="";
        $dernierVente = $vente;
        if($dernierVente!=null){
            $tax=$dernierVente->getTaxe();
            $itemVente=\app\DefaultApp\Models\ItemVente::listerParVente($dernierVente->getId());
            $stock=new \app\DefaultApp\Models\Stock();
            if(count($itemVente)>0){
                foreach ($itemVente as $itv)
                {
                    $quantite=$itv->getQuantite();
                    $prix=$itv->getPrix();
                    $soutotal=$quantite*$prix;
                    $stock=$stock->findById($itv->getIdProduit());

                    $prix=\app\DefaultApp\DefaultApp::formatComptable($prix);
                    $soutotal=\app\DefaultApp\DefaultApp::formatComptable($soutotal);

                    $ligne.="<tr><td>{$stock->getNom()}</td><td>{$stock->getDescription()}</td><td>{$quantite}</td><td>{$prix}</td><td>{$soutotal}</td></tr>";

                    $soutotal1=\app\DefaultApp\Models\ItemVente::sousTotal($dernierVente->getId());

                    $vtax=($soutotal1*$tax) /100;
                    $total=$soutotal1+$vtax;

                    $soutotal1=\app\DefaultApp\DefaultApp::formatComptable($soutotal1);
                    $vtax=\app\DefaultApp\DefaultApp::formatComptable($vtax);
                    $total=\app\DefaultApp\DefaultApp::formatComptable($total);

                }
            }
        }
        ?>
        <div class="card">
            <div class="card-body">
                <form method="post" class="form-vente">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> APP-GARAJ
                                    <small class="float-right">Date: <span
                                            id="date"><?php if ($dernierVente != null) echo $dernierVente->getDate() ?></span></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                De
                                <address>
                                    <strong>App-Garaj.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: +509 3396 4995<br>
                                    Email: alcindorlos@gmail.com
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                A
                                <address>
                                    <strong><?= $client->getNom() . " " . $client->getPrenom() ?></strong><br>
                                    <?= $client->getAdresse() ?><br>
                                    Phone: <?= $client->getTelephone(); ?>><br>
                                    Email: <?= $client->getEmail() ?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice <span
                                        id="invoice"><?php if ($dernierVente != null) echo $dernierVente->getNumero() ?></span></b><br>
                                <br>
                                <b>Order ID: <span
                                        id="order_id"><?php if ($dernierVente != null) echo $dernierVente->getId() ?></span></b>
                                <br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped" id="t">
                                    <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Description</th>
                                        <th>Qte</th>
                                        <th>Prix</th>
                                        <th>Sous total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?= $ligne; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">

                            <div class="col-6">
                                <br>
                                <div class="text-dark text-capitalize"><strong>NB : Les prix sont en Gourdes</strong></div>
                            </div>

                            <div class="col-6">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td><span id="sous_total"><?= $soutotal1 ?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Tax (<span id="tax"><?= $tax ?></span> %)</th>
                                            <td><span id="vtax"><?= $vtax ?></span></td>
                                        </tr>

                                        <tr>
                                            <th>Total:</th>
                                            <td><span id="total"><?= $total ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="text-success text-center">
                        <?php
                        if($vente->getPayer()=="oui"){
                            echo "<h3>Payé</h3>";
                        }else{
                            echo "<h3>Non Payé</h3>";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>