<?php
use systeme\Application\Application as  App;
?>
<a href="<?= App::genererUrl("ajouter_pmedical"); ?>" class="btn btn-primary">Ajouter</a>
<a href="<?= App::genererUrl("lister_pmedical"); ?>" class="btn btn-primary">Lister</a>
<a href="<?= App::genererUrl("ajouter_specialite"); ?>" class="btn btn-primary">Ajouter la Spécialité</a>
<a href="<?= App::genererUrl("lister_specialite"); ?>" class="btn btn-primary">Lister les Spécialités</a>
<br>
<br>