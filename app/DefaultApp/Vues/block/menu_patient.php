<?php
use systeme\Application\Application as  App;
?>
<a href="<?= App::genererUrl("ajouter_patient"); ?>" class="btn btn-primary">Ajouter Patient</a>
<a href="<?= App::genererUrl("lister_patient"); ?>" class="btn btn-primary">Liste des Patients</a>
<br>
<br>