<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_fournisseur") ?>
        <div class="card">
            <div class="card-header"><h4>Ajouter Fournisseur</h4></div>
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
                            location.href = 'ajouter-fournisseur';
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
                                <input type="text" name="nom" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Adresse</label>
                                <input type="text" name="adresse" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" name="telephone" class="form-control" required>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Statut</label>
                                <select class="form-control" name="statut">
                                    <option value="actif">Actif</option>
                                    <option value="inactif">Inactif</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <h4>Personne de contact</h4>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Nom</label>
                                    <input type="text" name="nomp[]" placeholder="Nom" class="form-control" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Poste</label>
                                    <input type="text" name="postep[]" placeholder="Poste" class="form-control"
                                           required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Téléphone</label>
                                    <input type="text" name="telephonep[]" placeholder="Telephone"
                                           class="form-control telephone" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Email</label>
                                    <input type="text" name="emailp[]" placeholder="Email" class="form-control">
                                </div>

                            </div>
                            <div class="div_pr">

                            </div>

                            <div class="form-group">
                                <input type="hidden" name="ajouter">
                                <input type="submit" value="Enregistrer" class="btn btn-primary float-right">
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
</div>