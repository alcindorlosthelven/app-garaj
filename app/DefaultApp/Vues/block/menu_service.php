<?php
use systeme\Application\Application as  App;
?>
<a href="<?= App::genererUrl("ajouter_service"); ?>" class="btn btn-primary">Ajouter un service</a>
<a href="<?= App::genererUrl("lister_service"); ?>" class="btn btn-primary">Lister les services</a>
<a href="<?= App::genererUrl("ajouter_categorie_service"); ?>" class="btn btn-primary">Ajouter une catégorie de service</a>
<a href="<?= App::genererUrl("lister_categorie_service"); ?>" class="btn btn-primary">Lister les catégories de services</a>
<br>
<br>