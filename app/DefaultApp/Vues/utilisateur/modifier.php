<br />
<?php app\sge\Sge::block("soumenu_utilisateur") ?>
<div class="card col-md-12">
    <div class="card-header">
        <h4>Modifier Utilisateur</h4>
    </div>
    <div class="card-body">
        <?php
        if(isset($erreur))
        {
            ?>
            <div class="alert alert-danger">
                <?= $erreur?>
            </div>
            <?php
        }
        ?>

        <?php
        if(isset($success))
        {
            ?>
            <script>
                alert(<?=$success?>);
            </script>
            <div class="alert alert-success">
                <?= $success?>
            </div>
            <?php
        }
        ?>


        <form method="post" action="">
            <div class="form-group">
                <label for="company">Nom</label>
                <input required type="text" class="form-control" id="nom" name="nom" placeholder="Nom Utilisateur" >
            </div>

            <div class="form-group">
                <label for="company">Prenom</label>
                <input required type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom Utilisateur">
            </div>

            <div class="form-group">
                <label for="company">Pseudo</label>
                <input required type="text" class="form-control" id="prenom" name="pseudo" placeholder="Pseudo">
            </div>

            <div class="form-group">
                <label for="company">Role</label>
                <select name="role" class="form-control" style="height: 40px;">
                    <option value="administrateur">
                        Administrateur
                    </option>

                    <option value="autre">
                        Autre
                    </option>
                </select>
            </div>


            <div class="form-group">
                <label for="company">Motdepasse</label>
                <input required type="password" class="form-control" id="prenom" name="motdepasse" placeholder="Motdepasse">
            </div>

            <div class="form-group">
                <label for="company">Confirmer Motdepasse</label>
                <input required type="password" class="form-control" id="prenom" name="confirmermotdepasse" placeholder="Confirmer motdepasse">
            </div>

            <div class="form-group pull-right">
                <input type="submit" value="Enregistrer" class="btn btn-primary" />
            </div>

        </form>

    </div>
</div>