
<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_employer") ?>


        <div class="card">
            <div class="card-header"><h4>
                    <?php
                    if(isset($employer)){
                        echo strtoupper($employer->getNom()." ".$employer->getPrenom());
                    }
                    ?>
                </h4></div>
            <?php
            if (isset($employer)){
            $ep = $employer;
            $conjointe=\app\DefaultApp\Models\ConjointeEmployer::rechercherParEmployer($ep->getId());
            $pv=\app\DefaultApp\Models\PersonnePrevenirEmployer::rechercherParEmployer($ep->getId());

            $ser=new \app\DefaultApp\Models\Service();
            $ser=$ser->findById($ep->getService());

            ?>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Information Générale</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="profile" aria-selected="false">Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#comptable" role="tab" aria-controls="contact" aria-selected="false">Comptabilité</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <br>
                        <div class="message"></div>
                        <form action="" method="post" id="form_enregistrer_employer">

                            <div class="row">
                            <fieldset class="col-md-4">

                                <table class="table">

                                    <tr>
                                        <th colspan="2">
                                            <img src="<?= $ep->getPhoto(); ?>" style="height: 150px" alt="PHOTO">
                                        </th>
                                    </tr>


                                    <tr>
                                        <th>Nom</th>
                                        <td><input  type="text" class="form-control" name="nom"
                                                   value="<?php echo $ep->getNom(); ?>"/></td>
                                    </tr>

                                    <tr>
                                        <th>Prénom</th>
                                        <td>
                                            <input  value="<?php echo $ep->getPrenom(); ?>" type="text" class="form-control"
                                                   name="prenom"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Date de Naissance ((j/m/a)</th>
                                        <td>
                                            <input  value="<?php echo $ep->getDateNaissance(); ?>" type="text" class="form-control date"
                                                   name="date_naissance"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>NIF</th>
                                        <td>
                                            <input  value="<?php echo $ep->getNif(); ?>" type="text" class="form-control nif"
                                                   name="nif"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>CIN</th>
                                        <td>
                                            <input  value="<?php echo $ep->getCin(); ?>" type="text" class="form-control cin"
                                                   name="cin"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Adresse</th>
                                        <td>
                                            <input  value="<?php echo $ep->getAdresse(); ?>" type="text" class="form-control"
                                                   name="adresse"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Téléphone</th>
                                        <td>
                                            <input  value="<?php echo $ep->getTelephone(); ?>" type="text" class="form-control"
                                                   name="telephone"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>
                                            <input  value="<?php echo $ep->getEmail(); ?>" type="text" class="form-control"
                                                   name="email"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Religion</th>
                                        <td>
                                            <input  value="<?php echo $ep->getReligion(); ?>" type="text" class="form-control"
                                                   name="religion"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Statut Matrimonial</th>
                                        <td>
                                            <input  value="<?php echo $ep->getStatutMatrimonial(); ?>" type="text"
                                                   class="form-control" name="statut_matrimonial"/>
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
                                        <th>Date d'entrée en travail (j/m/a)</th>
                                        <td><input  value="<?php echo $ep->getDateEntrerEnTravail(); ?>" type="text"
                                                   class="form-control date" name="date_entrer"/></td>
                                    </tr>

                                    <tr>
                                        <th>Poste</th>
                                        <td>
                                            <input  value="<?php echo $ep->getPoste(); ?>" type="text" class="form-control"
                                                   name="poste"/>
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
                                            <input  value="<?php echo $ep->getTypeContrat(); ?>" type="text" class="form-control"
                                                   name="type_contrat"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Identifiant</th>
                                        <td>
                                            <input  readonly value="<?php echo $ep->getIdentifiant(); ?>" type="text" class="form-control"
                                                   name="identifiant"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Catégorie</th>
                                        <td>
                                            <select name="role" class="form-control ccc" required>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Actif</th>
                                        <td>
                                            <input readonly  value="<?php echo $ep->getActif(); ?>" type="text" class="form-control"/>
                                        </td>
                                    </tr>

                                    <?php
                                    if ($ep->getActif() == "non") {
                                        ?>
                                        <tr>
                                            <th>Inactif pour</th>
                                            <td>
                                                <input readonly  value="<?php echo $ep->getPinactif(); ?>" type="text" class="form-control"/>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>


                                    <tr>
                                        <th>Date</th>
                                        <td>
                                            <input readonly value="<?php echo $ep->getDateInactif(); ?>" type="text" class="form-control"/>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Par</th>
                                        <td>
                                            <input readonly  value="<?php echo $ep->getUserInactif() ?>" type="text"
                                                   class="form-control"/>
                                        </td>
                                    </tr>
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
                    </div>

                    <div class="tab-pane fade" id="menu1" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="message"></div>

                        <form method="post" class="f_amp" enctype="multipart/form-data">
                            <div class="row">
                            <div class="form-group col-md-4">
                                <label>Document</label>
                                <input type="text" name="nom" class="form-control" required placeholder="Nom Document">
                            </div>

                            <div class="form-group col-md-4">
                                <label>Image</label>
                                <input type="file" name="fichier" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>.</label>
                                <input type="hidden" name="ajout_employer">
                                <input type="hidden" name="id_employer" value="<?= $employer->getId(); ?>">
                                <input type="submit" value="AJouter" class="btn btn-primary form-control">
                            </div>
                            </div>
                        </form>

                        <div class="t_document">
                            <table style="width:100%" class="table table-bordered ">
                                <tr>
                                    <th>Nom</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php
                                $listeDocument = \app\DefaultApp\Models\DocumentEmployer::listerParEnployer($employer->getId());
                                if (count($listeDocument) > 0) {
                                    foreach ($listeDocument as $dc) {
                                        ?>
                                        <tr>
                                            <td><?= stripslashes($dc->getNom()); ?></td>
                                            <td><a class="btn btn-warning btn-xs" href="<?= $dc->getImage(); ?>" target="_blank">Afficher</a></td>
                                            <td><a class="btn btn-primary btn-xs bte_sup" data-id="<?= $dc->getId(); ?>" data-id_employer="<?= $employer->getId(); ?>">Supprimer</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="comptable" role="tabpanel" aria-labelledby="contact-tab"><h2>Comptabilite</h2></div>
                </div>

            </div>
        </div>


    </div>
</div>
<?php
}
?>

