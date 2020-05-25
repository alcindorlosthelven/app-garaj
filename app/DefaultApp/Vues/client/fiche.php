<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_client") ?>
        <div class="card">
            <div class="card-header"><h4>
                    <?php
                    if (isset($client)) {
                        echo strtoupper($client->getNom() . " " . $client->getPrenom());
                    }
                    ?>
                </h4></div>
            <?php
            if (isset($client)){
            $ep = $client;
            ?>
            <div class="card-body">
                <a href="?infos" class="btn btn-primary">Information Générale</a>
                <a href="?reparation" class="btn btn-primary">Réparations</a>
                <br>
                <br>
                <?php
                if (isset($_GET['infos'])) {
                    info:
                    ?>
                    <h4>Infos</h4>
                    <form action="" method="post" id="form_enregistrer_client">
                        <div class="row">
                            <fieldset class="col-md-6">

                                <table class="table">
                                    <tr>
                                        <th colspan="2">
                                            <img src="<?= $ep->getPhoto();
                                            ?>" style="height: 150px" alt="PHOTO">
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>Nom</th>
                                        <td><input type="text" class="form-control" name="nom"
                                                   value="<?php echo $ep->getNom(); ?>"/></td>
                                    </tr>

                                    <tr>
                                        <th>Prénom</th>
                                        <td>
                                            <input value="<?php echo $ep->getPrenom(); ?>" type="text"
                                                   class="form-control"
                                                   name="prenom"/>
                                        </td>
                                    </tr>

                                    <!--<tr>
                                        <th>Date de Naissance ((j/m/a)</th>
                                        <td>
                                            <input  value="<?php /*echo $ep->getDateNaissance(); */
                                    ?>" type="text" class="form-control date"
                                                   name="date_naissance"/>
                                        </td>
                                    </tr>-->

                                    <!--<tr>
                                        <th>NIF</th>
                                        <td>
                                            <input  value="<?php /*echo $ep->getNif(); */
                                    ?>" type="text" class="form-control nif"
                                                   name="nif"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>CIN</th>
                                        <td>
                                            <input  value="<?php /*echo $ep->getCin(); */
                                    ?>" type="text" class="form-control cin"
                                                   name="cin"/>
                                        </td>
                                    </tr>-->

                                    <!-- <tr>
                                        <th>Adresse</th>
                                        <td>
                                            <input  value="<?php /*echo $ep->getAdresse(); */
                                    ?>" type="text" class="form-control"
                                                   name="adresse"/>
                                        </td>
                                    </tr>-->

                                    <tr>
                                        <th>Téléphone</th>
                                        <td>
                                            <input value="<?php echo $ep->getTelephone(); ?>" type="text"
                                                   class="form-control"
                                                   name="telephone"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>
                                            <input value="<?php echo $ep->getEmail(); ?>" type="text"
                                                   class="form-control"
                                                   name="email"/>
                                        </td>
                                    </tr>


                                </table>

                            </fieldset>
                            <fieldset class="col-md-6">

                                <table class="table">

                                    <tr>
                                        <th>Date de Naissance ((j/m/a)</th>
                                        <td>
                                            <input value="<?php echo $ep->getDateNaissance();
                                            ?>" type="text" class="form-control date"
                                                   name="date_naissance"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>NIF</th>
                                        <td>
                                            <input value="<?php echo $ep->getNif();
                                            ?>" type="text" class="form-control nif"
                                                   name="nif"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>CIN</th>
                                        <td>
                                            <input value="<?php /*echo $ep->getCin(); */
                                            ?>" type="text" class="form-control cin"
                                                   name="cin"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Adresse</th>
                                        <td>
                                            <input value="<?php echo $ep->getAdresse();
                                            ?>" type="text" class="form-control"
                                                   name="adresse"/>
                                        </td>
                                    </tr>


                                </table>


                            </fieldset>
                        </div>
                    </form>
                    <?php
                }elseif (isset($_GET['reparation'])) {
                    ?>
                    <h4>Reparations</h4>
                    <?php
                }else{
                    goto info;
                }
                ?>

            </div>
        </div>


    </div>
</div>
<?php
}
?>

