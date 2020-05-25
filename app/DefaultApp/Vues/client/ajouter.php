<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_client") ?>
        <div class="card">
            <div class="card-header"><h4>Ajouter Client</h4></div>

            <div class="card-body">
                <div class="message"></div>
                <form method="post" class="form-client">
                    <input type="hidden" name="ajouter">
                    <input type="hidden" name="actif" value="non">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Photo</label><br>
                                <img id="blah" style="width:120px;max-height:100px;min-height:100px;" src="" class="img-responsive" alt=""/><br>
                                <input value="" type="file" name="fichier" id="imgInp" onchange="readURL(this);"/>
                            </div>


                            <div class="form-group">
                                <label>Nom</label>
                                <input minlength="5" type="text" name="nom" class="form-control nom" required>
                            </div>

                            <div class="form-group">
                                <label>Prénom</label>
                                <input minlength="5" type="text" name="prenom" class="form-control prenom" required>
                            </div>

                            <div class="form-group">
                                <label>Date Naissance</label>
                                <input type="text" name="date_naissance" class="form-control date" required>
                            </div>

                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" name="telephone" class="form-control telephone" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input minlength="6" type="email" name="email" class="form-control" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nif</label>
                                <input type="text" name="nif" class="form-control nif">
                            </div>

                            <div class="form-group">
                                <label>Cin</label>
                                <input type="text" name="cin" class="form-control cin">
                            </div>


                            <div class="form-group">
                                <label>Adresse</label>
                                <input type="text" name="adresse" class="form-control" required>
                            </div>


                            <div class="form-group">
                                <label>Pseudo</label>
                                <input type="text" name="pseudo" class="form-control identifiant" required readonly>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" value="1234" required
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label>Confirmer Password</label>
                                <input type="password" name="cpassword" class="form-control" value="1234" required
                                       readonly>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Enregistrer" class="btn btn-success float-right">
                            </div>

                        </div>


                    </div>

                </form>
                <div class="message"></div>
            </div>
        </div>


    </div>
</div>