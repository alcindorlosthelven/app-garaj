<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_client") ?>
        <div class="card">
            <div class="card-header"><h4>Modifier Client</h4></div>

            <div class="card-body">
                <div class="message"></div>
                <form method="post" class="form-client">
                    <input type="hidden" name="modifier">
                    <input type="hidden" name="id" value="<?php if (isset($client)) {
                        echo $client->getId();
                    } ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <input value="<?php if (isset($client)) {
                                    echo $client->getNom();
                                } ?>" minlength="5" type="text" name="nom" class="form-control nom" required>
                            </div>

                            <div class="form-group">
                                <label>Prénom</label>
                                <input value="<?php if (isset($client)) {
                                    echo $client->getPrenom();
                                } ?>" minlength="5" type="text" name="prenom" class="form-control prenom" required>
                            </div>

                            <div class="form-group">
                                <label>Date Naissance</label>
                                <input value="<?php if(isset($client))echo $client->getDateNaissance(); ?>" type="text" name="date_naissance" class="form-control date" required>
                            </div>


                            <div class="form-group">
                                <label>Téléphone</label>
                                <input value="<?php if (isset($client)) {
                                    echo $client->getTelephone();
                                } ?>" type="text" name="telephone" class="form-control telephone" required>
                            </div>

                            <div class="form-group">
                                <label>Nif</label>
                                <input value="<?php if(isset($client))echo $client->getNif(); ?>" type="text" name="nif" class="form-control nif">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Cin</label>
                                <input value="<?php if(isset($client))echo $client->getCin(); ?>" type="text" name="cin" class="form-control cin">
                            </div>


                            <div class="form-group">
                                <label>Adresse</label>
                                <input value="<?php if(isset($client))echo $client->getAdresse(); ?>" type="text" name="adresse" class="form-control" required>
                            </div>


                            <div class="form-group">
                                <label>Email</label>
                                <input readonly value="<?php if (isset($client)) {
                                    echo $client->getEmail();
                                } ?>" minlength="6" type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Modifier" class="btn btn-success float-right">
                            </div>

                        </div>

                    </div>

                </form>
                <div class="message"></div>
            </div>
        </div>


    </div>
</div>