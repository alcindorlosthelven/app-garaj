<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_employer") ?>
        <div class="card">
            <div class="card-header"><h4>Modifier employer</h4></div>
            <div class="card-body">
                <div class="message"></div>
                <?php
                if (isset($employer)){
                $ep = $employer;
                $conjointe=\app\DefaultApp\Models\ConjointeEmployer::rechercherParEmployer($ep->getId());
                $pv=\app\DefaultApp\Models\PersonnePrevenirEmployer::rechercherParEmployer($ep->getId());
                $ser=new \app\DefaultApp\Models\Service();
                $ser=$ser->findById($ep->getService());
              /*  $cser=new \app\DefaultApp\Models\CategorieService();
                $cser=$cser->findById($ep->getId());*/
                ?>

                <form action="" method="post" id="form_enregistrer_employer">
                    <div class="row">
                        <fieldset class="col-md-4">
                            <legend>Information</legend>

                            <table class="table">

                                <tr>
                                    <th>Photo</th>
                                    <td>
                                        <input type="file" name="fichier" accept="image/jpeg" class="form-control">
                                    </td>
                                </tr>


                                <tr>
                                    <th>Nom</th>
                                    <td><input type="text" class="form-control nom" name="nom" value="<?php echo $ep->getNom(); ?>"/></td>
                                </tr>

                                <tr>
                                    <th>Prénom</th>
                                    <td>
                                        <input value="<?php echo $ep->getPrenom(); ?>" type="text" class="form-control prenom" name="prenom"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Date de Naissance</th>
                                    <td>
                                        <input value="<?php echo $ep->getDateNaissance(); ?>" type="text" class="form-control date"
                                               name="date_naissance"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>NIF</th>
                                    <td>
                                        <input value="<?php echo $ep->getNif(); ?>" type="text" class="form-control nif" name="nif"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>CIN</th>
                                    <td>
                                        <input value="<?php echo $ep->getCin(); ?>" type="text" class="form-control cin" name="cin"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Adresse</th>
                                    <td>
                                        <input value="<?php echo $ep->getAdresse(); ?>" type="text" class="form-control"
                                               name="adresse"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Téléphone</th>
                                    <td>
                                        <input value="<?php echo $ep->getTelephone(); ?>" type="text" class="form-control telephone"
                                               name="telephone"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <input value="<?php echo $ep->getEmail(); ?>" type="text" class="form-control" name="email"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Religion</th>
                                    <td>
                                        <input value="<?php echo $ep->getReligion(); ?>" type="text" class="form-control"
                                               name="religion"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Statut Matrimonial</th>
                                    <td>
                                        <input value="<?php echo $ep->getStatutMatrimonial(); ?>" type="text" class="form-control"
                                               name="statut_matrimonial"/>
                                    </td>
                                </tr>

                            </table>


                        </fieldset>

                        <fieldset class="col-md-4">
                            <legend>Conjoint(e)</legend>
                            <table class="table">
                                <tr>
                                    <th>Nom</th>
                                    <td><input value="<?php if (!is_null($conjointe)) {
                                            echo $conjointe->getNom();
                                        } ?>" type="text" class="form-control" name="nom_conjointe"/></td>
                                </tr>

                                <tr>
                                    <th>Prénom</th>
                                    <td><input value="<?php if (!is_null($conjointe)) {
                                            echo $conjointe->getPrenom();
                                        } ?>" type="text" class="form-control" name="prenom_conjointe"/></td>
                                </tr>

                                <tr>
                                    <th>Relation</th>
                                    <td><input value="<?php if (!is_null($conjointe)) {
                                            echo $conjointe->getRelation();
                                        } ?>" type="text" class="form-control" name="relation_conjointe"/></td>
                                </tr>

                                <tr>
                                    <th>Téléphone</th>
                                    <td><input value="<?php if (!is_null($conjointe)) {
                                            echo $conjointe->getTelephone();
                                        } ?>" type="text" class="form-control" name="telephone_conjointe"/></td>
                                </tr>
                            </table>
                            <fieldset class="col-md-12">
                                <legend>Personne a prévenire en cas d'urgence</legend>
                                <table class="table">
                                    <tr>
                                        <th>Nom</th>
                                        <td><input value="<?php if (!is_null($pv)) {
                                                echo $pv->getNom();
                                            } ?>" type="text" class="form-control" name="nom_pu"/></td>
                                    </tr>

                                    <tr>
                                        <th>Prénom</th>
                                        <td><input value="<?php if (!is_null($pv)) {
                                                echo $pv->getPrenom();
                                            } ?>" type="text" class="form-control" name="prenom_pu"/></td>
                                    </tr>

                                    <tr>
                                        <th>Relation</th>
                                        <td><input value="<?php if (!is_null($pv)) {
                                                echo $pv->getRelation();
                                            } ?>" type="text" class="form-control" name="relation_pu"/></td>
                                    </tr>

                                    <tr>
                                        <th>Téléphone</th>
                                        <td><input value="<?php if (!is_null($pv)) {
                                                echo $pv->getTelephone();
                                            } ?>" type="text" class="form-control" name="telephone_pu"/></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </fieldset>

                        <fieldset class="col-md-4">
                            <legend>Administration</legend>

                            <table class="table">
                                <tr>
                                    <th>Date d'entrée en travail</th>
                                    <td><input value="<?php echo $ep->getDateEntrerEnTravail(); ?>" type="text" class="form-control"
                                               name="date_entrer"/></td>
                                </tr>

                                <tr>
                                    <th>Poste</th>
                                    <td>
                                        <input value="<?php echo $ep->getPoste(); ?>" type="text" class="form-control" name="poste"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Service</th>
                                    <td>
                                        <select name="service" class="form-control service_employer" required>
                                            <option value="<?= $ser->getId() ?>"><?php echo $ser->getSigle(); ?></option>
                                            <?php
                                            foreach ($listeService as $service){
                                                ?>
                                                <option value="<?= $service->getId(); ?>"><?= $service->getSigle(); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Type Contrat</th>
                                    <td>
                                        <input value="<?php echo $ep->getTypeContrat(); ?>" type="text" class="form-control"
                                               name="type_contrat"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Identifiant</th>
                                    <td>
                                        <input readonly value="<?php echo $ep->getIdentifiant(); ?>" type="text" class="form-control identifiant"
                                               name="identifiant"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Catégorie</th>
                                    <td>
                                        <select name="role" class="form-control ccc" required>
                                            <option value="<?= $ep->getRole() ?>"><?= $ep->getRole() ?></option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Actif</th>
                                    <td>
                                        <select name="actif" class="form-control" readonly="">
                                            <option value="<?php echo $ep->getActif(); ?>"><?php echo $ep->getActif(); ?></option>
                                        </select>
                                    </td>
                                </tr>

                                <?php
                                if ($ep->getActif() == "nom") {
                                    ?>
                                    <tr>
                                        <th>Inactif pour</th>
                                        <td>
                                            <input readonly value="<?php echo $ep->getPinactif(); ?>" type="text" class="form-control"
                                                   name="identifiant"/>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </table>


                            <div class="form-group float-right">
                                <input type="hidden" name="id_employer" value="<?php echo $ep->getId(); ?>">
                                <input type="hidden" name="id_conjointe" value="<?php if (!is_null($conjointe)) {
                                    echo $conjointe->getId();
                                } ?>">
                                <input type="hidden" name="id_personne" value="<?php if (!is_null($pv)) {
                                    echo $pv->getId();
                                } ?>">
                                <input type="hidden" name="modifier_employer">
                                <input type="submit" value="Modifier" class="btn btn-primary">
                            </div>

                        </fieldset>
                    </div>
                </form>
                <div class="message"></div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>


