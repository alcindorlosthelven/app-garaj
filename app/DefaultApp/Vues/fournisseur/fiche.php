<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_fournisseur") ?>
        <div class="card">
            <div class="card-header"><h4>
                    <?php
                    if(isset($fournisseur)){
                        echo strtoupper($fournisseur->getNom());
                    }
                    ?>
                </h4></div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Information Générale</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#comptable" role="tab" aria-controls="contact" aria-selected="false">Comptabilité</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input readonly value="<?php if (isset($fournisseur)) echo $fournisseur->getNom(); ?>" type="text"
                                           name="nom" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Adresse</label>
                                    <input readonly value="<?php if (isset($fournisseur)) echo $fournisseur->getAdresse(); ?>"
                                           type="text" name="adresse" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input readonly value="<?php if (isset($fournisseur)) echo $fournisseur->getTelephone(); ?>"
                                           type="text" name="telephone" class="form-control" required>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input readonly value="<?php if (isset($fournisseur)) echo $fournisseur->getEmail(); ?>" type="email"
                                           name="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Statut</label>
                                    <input readonly value="<?php if (isset($fournisseur)) echo $fournisseur->getStatut(); ?>" class="form-control" required>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <h4>Personne de contact</h4>
                                <div class="row">
                                    <?php
                                    if(isset($contactA)) {
                                        if (count($contactA) > 0) {
                                            foreach ($contactA as $c) {
                                                ?>
                                                <div class="form-group col-md-3">
                                                    <label>Nom</label>
                                                    <input readonly value="<?= $c->getNom(); ?>" type="text" name="nomp[]"
                                                           placeholder="Nom"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>Poste</label>
                                                    <input readonly value="<?= $c->getPoste() ?>" type="text" name="postep[]"
                                                           placeholder="Poste" class="form-control">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>Téléphone</label>
                                                    <input readonly value="<?= $c->getTelephone(); ?>" type="text" name="telephonep[]"
                                                           placeholder="Telephone" class="form-control">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>Email</label>
                                                    <input readonly value="<?= $c->getEmail(); ?>" type="text" name="emailp[]"
                                                           placeholder="Email" class="form-control">
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="div_pr">

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="comptable" role="tabpanel" aria-labelledby="contact-tab"><h2>Comptabilite</h2></div>
                </div>


            </div>
        </div>


    </div>
</div>