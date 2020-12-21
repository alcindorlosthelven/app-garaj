<div class="row">
    <div class="col-md-12">
        <div class="message"></div>
        <div class="no-print">
            <?= \systeme\Application\Application::block("menu_vente") ?>
        </div>
        <?php if (!isset($client)) {
            return;
        }
        $ligne = "";
        $vtax = 0;
        $tax = 0;
        $soutotal1 = 0;
        $total = 0;
        if (isset($dernierVente)) {
            if ($dernierVente != null) {
                $tax = $dernierVente->getTaxe();
                if (isset($_GET['sup'])) {
                    $id = $_GET['sup'];
                    $itemVente = new \app\DefaultApp\Models\ItemVente();
                    $itemVente->deleteById($id);
                    \app\DefaultApp\DefaultApp::redirection("ajouter_vente", ["id" => $dernierVente->getId()]);
                }

                $itemVente = \app\DefaultApp\Models\ItemVente::listerParVente($dernierVente->getId());
                $stock = new \app\DefaultApp\Models\Stock();
                if (count($itemVente) > 0) {
                    foreach ($itemVente as $itv) {
                        $quantite = $itv->getQuantite();
                        $prix = $itv->getPrix();
                        $soutotal = $quantite * $prix;
                        $stock = $stock->findById($itv->getIdProduit());
                        if($dernierVente->getPayer()=="non")
                        {
                            $trash="<a href='?sup={$itv->getId()}'><i class='fa fa-trash'></i></a>";
                        }else{
                            $trash="";
                        }

                        $prix = \app\DefaultApp\DefaultApp::formatComptable($prix);
                        $soutotal = \app\DefaultApp\DefaultApp::formatComptable($soutotal);
                        $ligne .= "<tr><td>{$trash} {$stock->getNom()}</td><td>{$stock->getDescription()}</td><td class='update_quantite' data-id='{$itv->getId()}' data-id_vente='{$dernierVente->getId()}' contenteditable='true'>{$quantite}</td><td>{$prix}</td><td>{$soutotal}</td></tr>";
                        $soutotal1 = \app\DefaultApp\Models\ItemVente::sousTotal($dernierVente->getId());
                        $vtax = ($soutotal1 * $tax) / 100;
                        $total = $soutotal1 + $vtax;

                        $soutotal1 = \app\DefaultApp\DefaultApp::formatComptable($soutotal1);
                        $vtax = \app\DefaultApp\DefaultApp::formatComptable($vtax);
                        $total = \app\DefaultApp\DefaultApp::formatComptable($total);

                    }
                }
            }
        }
        ?>
        <div class="card">
            <div class="card-header"><h4>Ajouter Vente</h4></div>
            <div class="card-body">
                <div class="message"></div>
                <?php
                if (isset($dernierVente)) {
                    if ($dernierVente->getPayer() == "non") {
                        ?>
                        <form method="post" class="was-validated no-print add_article">
                            <?php
                            if (isset($dernierVente)) {
                                if ($dernierVente != null) {
                                    ?>
                                    <input type="hidden" name="id_vente" value="<?= $dernierVente->getId(); ?>">
                                    <?php
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Article</label>
                                    <input type="text" class="form-control auto_item" name="article" required>
                                </div>

                                <div class="form-group col-4">
                                    <label>Quantité</label>
                                    <input min="1" type="number" class="form-control" value="1" name="quantite">
                                </div>

                                <div class="form-group col-4">
                                    <input type="hidden" name="ajouter_article">
                                    <input type="hidden" name="id_client" value="<?= $client->getId() ?>">
                                    <label>.</label><br>
                                    <input type="submit" class="btn btn-success" value="ajouter">
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                }else{
                    ?>
                    <form method="post" class="was-validated no-print add_article">
                        <?php
                        if (isset($dernierVente)) {
                            if ($dernierVente != null) {
                                ?>
                                <input type="hidden" name="id_vente" value="<?= $dernierVente->getId(); ?>">
                                <?php
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Article</label>
                                <input type="text" class="form-control auto_item" name="article" required>
                            </div>

                            <div class="form-group col-4">
                                <label>Quantité</label>
                                <input min="1" type="number" class="form-control" value="1" name="quantite">
                            </div>

                            <div class="form-group col-4">
                                <input type="hidden" name="ajouter_article">
                                <input type="hidden" name="id_client" value="<?= $client->getId() ?>">
                                <label>.</label><br>
                                <input type="submit" class="btn btn-success" value="ajouter">
                            </div>
                        </div>
                    </form>
                <?php
                }
                ?>

                <?php ob_start(); ?>
                <page>
                    <form method="post" class="form-vente">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> APP-GARAJ
                                        <small class="float-right">Date: <span
                                                    id="date"><?php if (isset($dernierVente)) {
                                                    if ($dernierVente != null) {
                                                        echo $dernierVente->getDate();
                                                    }
                                                } ?></span></small>
                                    </h4>
                                </div>

                            </div>

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
                                                id="invoice"><?php if (isset($dernierVente)) {
                                                if ($dernierVente != null) {
                                                    echo $dernierVente->getNumero();
                                                }
                                            } ?></span></b><br>
                                    <br>
                                    <b>Order ID: <span
                                                id="order_id"><?php if (isset($dernierVente)) {
                                                if ($dernierVente != null) {
                                                    echo $dernierVente->getId();
                                                }
                                            } ?></span></b>
                                    <br>
                                </div>
                                <!-- /.col -->
                            </div>

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

                            <div class="row">

                                <div class="col-6">

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
                            if (isset($dernierVente)) {
                                if ($dernierVente->getPayer() == "oui") {
                                    echo "<h3>Payer</h3>";
                                } else {
                                    echo "<h3>Non Payer</h3>";
                                }
                            }

                            ?>
                        </div>
                    </form>
                </page>
                <?php
                $data = ob_get_clean();
                echo $data;
                ?>

                <div class="row no-print">
                    <div class="col-12">
                        <?php
                        if (isset($dernierVente)) {
                            /* $pdf = new \Spipu\Html2Pdf\Html2Pdf("P", "A4", "en");
                             $lien = \app\DefaultApp\DefaultApp::protocolApp() . $_SERVER['HTTP_HOST'];
                             \Spipu\Html2Pdf\Html2Pdf::$lien_web = $lien;
                             $pdf->writeHTML($data);

                             $nom = "invoice_".$dernierVente->getId();
                             $destination = str_replace("\\", "/", dirname(__DIR__)) . "/public/fichier/" . $nom . ".pdf";
                             //$pdf->output($destination, 'F');
                             $pdf->output("bultin.pdf");*/
                            ?>
                            <a href="imprimer-facture-vente-<?php if ($dernierVente != null) echo $dernierVente->getId() ?>"
                               target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimer</a>

                            <?php
                            if (isset($dernierVente)) {
                                if ($dernierVente->getPayer() == "non") {
                                    ?>
                                    <a href="" type="button" class="finaliser_vente btn btn-success float-right"
                                       data-id="<?= $dernierVente->getId(); ?>"><i class="far fa-credit-card"></i>Finaliser
                                        Paiement</a>
                                    <?php
                                }
                            }
                            ?>

                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"><i
                                        class="fas fa-download"></i> Generer en PDF
                            </button>
                            <?php
                        } else {
                            ?>
                            <a href="" type="button" class="btn btn-success float-right"><i class="far fa-save"></i>
                                Enregistrer la Facture</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>