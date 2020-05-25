<?php
use systeme\Application\Application as  App;
?>
<a href="<?= App::genererUrl("ajouter_imagerie"); ?>" class="btn btn-primary">Ajouter</a>
<a href="<?= App::genererUrl("lister_imagerie"); ?>" class="btn btn-primary">Lister</a>
<a href="<?= App::genererUrl("ajouter_categorie_examens_imagerie"); ?>" class="btn btn-primary">Ajouter Catégorie Examens Imagerie</a>
<a href="<?= App::genererUrl("lister_categorie_examens_imagerie"); ?>" class="btn btn-primary">Lister Catégorie Examens Imagerie</a>
<a href="<?= App::genererUrl("liste_demande_imagerie"); ?>" class="btn btn-primary">Liste des demmandes</a>
<br>
<br>