<div class="row">
    <div class="col-md-12">
        <div class="no-print">
            <?= \systeme\Application\Application::block("menu_achat") ?>
        </div>
        <?php if (!isset($fournisseur)) {
            return;
        }
        $ligne = "";
        $soutotal1 = 0;
        $total = 0;
        if (isset($dernierAchat)) {
            if ($dernierAchat != null) {
                if (isset($_GET['sup'])) {
                    $id = $_GET['sup'];
                    $itemAchat = new \app\DefaultApp\Models\ItemAchat();
                    $itemAchat->deleteById($id);
                    \app\DefaultApp\DefaultApp::redirection("ajouter_achat", ["id" => $dernierAchat->getId()]);
                }

                $itemAchat = \app\DefaultApp\Models\ItemAchat::listerParAchat($dernierAchat->getId());
                $stock = new \app\DefaultApp\Models\Stock();
                if (count($itemAchat) > 0) {
                    foreach ($itemAchat as $itv) {
                        $quantite = $itv->getQuantite();
                        $prix = $itv->getPrix();
                        $soutotal = $quantite * $prix;
                        $stock = $stock->findById($itv->getIdProduit());
                        if($dernierAchat->getStatut()=="encour")
                        {
                            $trash="<a href='?sup={$itv->getId()}'><i class='fa fa-trash'></i></a>";
                        }else{
                            $trash="";
                        }

                        $prix = \app\DefaultApp\DefaultApp::formatComptable($prix);
                        $soutotal = \app\DefaultApp\DefaultApp::formatComptable($soutotal);
                        $ligne .= "<tr><td>{$trash} {$stock->getNom()}</td><td>{$stock->getDescription()}</td><td class='update_quantite_achat' data-id='{$itv->getId()}' data-id_vente='{$dernierAchat->getId()}' contenteditable='true'>{$quantite}</td><td>{$prix}</td><td>{$soutotal}</td></tr>";
                        $soutotal1 = \app\DefaultApp\Models\ItemAchat::sousTotal($dernierAchat->getId());
                        $total = $soutotal1;

                        $soutotal1 = \app\DefaultApp\DefaultApp::formatComptable($soutotal1);
                        $total = \app\DefaultApp\DefaultApp::formatComptable($total);

                    }
                }
            }
        }
        ?>
        <div class="card">
            <div class="card-header"><h4>Achat</h4></div>
            <div class="card-body">
                <div class="message"></div>
                <?php
                if (isset($dernierAchat)) {
                    if ($dernierAchat->getStatut() == "encour") {
                        ?>
                        <form method="post" class="was-validated no-print add_article">
                            <?php
                            if (isset($dernierAchat)) {
                                if ($dernierAchat != null) {
                                    ?>
                                    <input type="hidden" name="id_achat" value="<?= $dernierAchat->getId(); ?>">
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
                                    <input type="hidden" name="ajouter_article_achat">
                                    <input type="hidden" name="id_fournisseur" value="<?= $fournisseur->getId() ?>">
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
                        if (isset($dernierAchat)) {
                            if ($dernierAchat != null) {
                                ?>
                                <input type="hidden" name="id_achat" value="<?= $dernierAchat->getId(); ?>">
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
                                <input type="hidden" name="ajouter_article_achat">
                                <input type="hidden" name="id_fournisseur" value="<?= $fournisseur->getId() ?>">
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
                                                    id="date"><?php if (isset($dernierAchat)) {
                                                    if ($dernierAchat != null) {
                                                        echo $dernierAchat->getDate();
                                                    }
                                                } ?></span></small>
                                    </h4>
                                </div>

                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Fournisseur
                                    <address>
                                        <strong><?= strtoupper($fournisseur->getNom()) ?>.</strong><br>
                                        <?= $fournisseur->getAdresse(); ?>><br>
                                        Phone: <?=$fournisseur->getTelephone();?>><br>
                                        Email: <?= $fournisseur->getEmail(); ?>>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                   <!-- A
                                    <address>
                                        <strong><?/*= "" */?></strong><br>
                                        <?/*= "" */?><br>
                                        Phone: <br>
                                        Email:
                                    </address>-->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>ID: <span
                                                id="order_id"><?php if (isset($dernierAchat)) {
                                                if ($dernierAchat != null) {
                                                    echo $dernierAchat->getId();
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
                            if (isset($dernierAchat)) {
                                if ($dernierAchat->getStatut() == "finaliser") {
                                    echo "<h3>Finaliser</h3>";
                                } else {
                                    echo "<h3>Non Finaliser</h3>";
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
                        if (isset($dernierAchat)) {
                            /* $pdf = new \Spipu\Html2Pdf\Html2Pdf("P", "A4", "en");
                             $lien = \app\DefaultApp\DefaultApp::protocolApp() . $_SERVER['HTTP_HOST'];
                             \Spipu\Html2Pdf\Html2Pdf::$lien_web = $lien;
                             $pdf->writeHTML($data);

                             $nom = "invoice_".$dernierAchat->getId();
                             $destination = str_replace("\\", "/", dirname(__DIR__)) . "/public/fichier/" . $nom . ".pdf";
                             //$pdf->output($destination, 'F');
                             $pdf->output("bultin.pdf");*/
                            ?>
                            <a href="imprimer-facture-achat-<?php if ($dernierAchat != null) echo $dernierAchat->getId() ?>"
                               target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimer</a>

                            <?php
                            if (isset($dernierAchat)) {
                                if ($dernierAchat->getStatut() != "finaliser") {
                                    ?>
                                    <a href="" type="button" class="finaliser_achat btn btn-success float-right"
                                       data-id="<?= $dernierAchat->getId(); ?>"><i class="far fa-credit-card"></i>Finaliser
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