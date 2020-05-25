<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_fournisseur") ?>
        <div class="card">
            <div class="card-header"><h4>Modifier Fournisseur</h4></div>
            <div class="card-body">
                <div class="message">
                    <?php
                    if (isset($erreur)) {
                        ?>
                        <div class="alert alert-warning"><?= $erreur ?></div>
                        <?php
                    }

                    if (isset($success)) {
                        ?>
                        <div class="alert alert-warning"><?= $success ?></div>
                        <script>
                            alert("<?= $success ?>");
                            location.href = 'modifier-fournisseur-<?= $fournisseur->getId() ?>';
                        </script>
                        <?php
                    }
                    ?>
                </div>

                <div class="row">

                <div class="col-md-12">
                    <button class="float-right btn btn-success btn-xs btn_pr">+ personne contact</button>

                    <button class="float-right btn btn-success btn-xs btn_pr_moins"
                            style="margin-right: 10px;margin-bottom: 10px">- personne contact
                    </button>
                </div>

                </div>

                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <input value="<?php if (isset($fournisseur)) echo $fournisseur->getNom(); ?>" type="text"
                                       name="nom" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Adresse</label>
                                <input value="<?php if (isset($fournisseur)) echo $fournisseur->getAdresse(); ?>"
                                       type="text" name="adresse" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Téléphone</label>
                                <input value="<?php if (isset($fournisseur)) echo $fournisseur->getTelephone(); ?>"
                                       type="text" name="telephone" class="form-control" required>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input value="<?php if (isset($fournisseur)) echo $fournisseur->getEmail(); ?>" type="email"
                                       name="email" class="form-control" required>
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
                                            <input value="<?= $c->getNom(); ?>" type="text" name="nomp[]"
                                                   placeholder="Nom"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Poste</label>
                                            <input value="<?= $c->getPoste() ?>" type="text" name="postep[]"
                                                   placeholder="Poste" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Téléphone</label>
                                            <input value="<?= $c->getTelephone(); ?>" type="text" name="telephonep[]"
                                                   placeholder="Telephone" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Email</label>
                                            <input value="<?= $c->getEmail(); ?>" type="text" name="emailp[]"
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

                            <div class="form-group">
                                <input type="hidden" name="modifier">
                                <input type="submit" value="Modifier" class="btn btn-primary float-right">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>