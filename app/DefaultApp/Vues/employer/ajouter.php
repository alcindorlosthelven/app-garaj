<div class="row">
    <div class="col-md-12">
        <?= \systeme\Application\Application::block("menu_employer") ?>
        <div class="card">
            <div class="card-header"><h4>Ajouter Employer</h4></div>

            <div class="card-body">
                <div class="message"></div>
                <form action="" method="post" id="form_enregistrer_employer" enctype="multipart/form-data">
                    <div class="row">
                    <fieldset class="col-md-4">
                        <legend>Personnel</legend>
                        <table class="table">

                            <tr>
                                <th>Photo</th>
                                <td>
                                    <input type="file" name="fichier" accept="image/jpeg" class="form-control">
                                </td>
                            </tr>

                            <tr>
                                <th>Nom</th>
                                <td><input type="text" class="form-control nom" name="nom" required /></td>
                            </tr>

                            <tr>
                                <th>Prénom</th>
                                <td>
                                    <input type="text" class="form-control prenom" name="prenom" required />
                                </td>
                            </tr>

                            <tr>
                                <th>Sexe</th>
                                <td>
                                   <select name="sexe" class="form-control">
                                       <option value="masculin">Masculin</option>
                                       <option value="féminin">Féminin</option>
                                   </select>
                                </td>
                            </tr>

                            <tr>

                                <th>Date Naissance</th>
                                <td>
                                    <input required type="text" class="form-control date" name="date_naissance" id="date_naissance" placeholder="j/m/a" />
                                </td>
                            </tr>

                            <tr>
                                <th>NIF</th>
                                <td>
                                    <input type="text" class="form-control nif" name="nif" id="nif" />
                                </td>
                            </tr>

                            <tr>
                                <th>CIN</th>
                                <td>
                                    <input type="text" class="form-control cin" name="cin" id="cin" />
                                </td>
                            </tr>

                            <tr>
                                <th>Adresse</th>
                                <td>
                                    <input type="text" class="form-control" name="adresse" />
                                </td>
                            </tr>

                            <tr>
                                <th>Téléphone</th>
                                <td>
                                    <input type="text" class="form-control telephone" name="telephone" />
                                </td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>
                                    <input type="text" class="form-control" name="email" />
                                </td>
                            </tr>

                            <tr>
                                <th>Religion</th>
                                <td>
                                    <input type="text" class="form-control" name="religion" />
                                </td>
                            </tr>

                            <tr>
                                <th>Statut Matrimonial</th>
                                <td>
                                    <select class="form-control" name="statut_matrimonial">
                                        <option value="célibataire">Célibataire</option>
                                        <option value="marié">Marié</option>
                                        <option value="divorcé">Divorcé</option>
                                    </select>
                                </td>
                            </tr>

                        </table>
                    </fieldset>

                    <fieldset class="col-md-4">
                        <legend>Conjoint(e)</legend>
                        <table class="table">
                            <tr>
                                <th>Nom</th>
                                <td><input type="text" class="form-control" name="nom_conjointe" /></td>
                            </tr>

                            <tr>
                                <th>Prénom</th>
                                <td><input type="text" class="form-control" name="prenom_conjointe" /></td>
                            </tr>

                            <tr>
                                <th>Relation</th>
                                <td><input type="text" class="form-control" name="relation_conjointe" /></td>
                            </tr>

                            <tr>
                                <th>Téléphone</th>
                                <td><input type="text" class="form-control telephone" name="telephone_conjointe" /></td>
                            </tr>
                        </table>

                        <fieldset class="col-md-12">
                            <legend>Personne a prévenire en cas d'urgence</legend>
                            <table class="table">
                                <tr>
                                    <th>Nom</th>
                                    <td><input type="text" class="form-control" name="nom_pu" /></td>
                                </tr>

                                <tr>
                                    <th>Prénom</th>
                                    <td><input type="text" class="form-control" name="prenom_pu" /></td>
                                </tr>

                                <tr>
                                    <th>Relation</th>
                                    <td><input type="text" class="form-control" name="relation_pu" /></td>
                                </tr>

                                <tr>
                                    <th>Téléphone</th>
                                    <td><input type="text" class="form-control telephone" name="telephone_pu" /></td>
                                </tr>
                            </table>
                        </fieldset>
                    </fieldset>

                    <fieldset class="col-md-4">
                        <legend>Administration</legend>

                        <table class="table">
                            <tr>
                                <th>Date d'entrée en travail</th>
                                <td><input required type="text" class="form-control date" name="date_entrer" /></td>
                            </tr>

                            <tr>
                                <th>Poste</th>
                                <td>
                                    <input required type="text" class="form-control" name="poste" />
                                </td>
                            </tr>

                            <tr>
                                <th>Service</th>
                                <td>
                                    <select name="service" class="form-control" required>
                                        <option value="">Choisir service</option>
                                        <?php
                                        if(isset($listeService))
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
                                    <input required type="text" class="form-control" name="type_contrat" />
                                </td>
                            </tr>

                            <tr>
                                <th>Identifiant</th>
                                <td>
                                    <input required type="text" class="form-control identifiant" name="identifiant" readonly />
                                </td>
                            </tr>

                            <tr>
                                <th>Categorie</th>
                                <td>
                                    <select name="role" class="form-control" required>
                                        <option value="technicien">Technicien</option>
                                        <option value="informaticien">Informaticien</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Password</th>
                                <td>
                                    <input required type="password" class="form-control" name="password" />
                                </td>
                            </tr>

                            <tr>
                                <th>Confirmer Password</th>
                                <td>
                                    <input required type="password" class="form-control" name="confirmer_password" />
                                </td>
                            </tr>


                        </table>


                        <div class="form-group">
                            <input type="hidden" name="enregistrer_employer">
                            <input type="submit" value="Enregistrer" class="btn btn-primary float-right">
                        </div>

                    </fieldset>
                    </div>
                </form>
                <div class="message"></div>
            </div>
        </div>


    </div>
</div>