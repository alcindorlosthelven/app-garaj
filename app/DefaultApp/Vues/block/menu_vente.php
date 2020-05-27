<?php
use systeme\Application\Application as  App;
?>
<a href="<?= App::genererUrl("lister_client"); ?>" class="btn btn-success">Nouvel vente</a>
<a href="<?= App::genererUrl("lister_vente"); ?>" class="btn btn-success">Liste des ventes</a>
<hr>