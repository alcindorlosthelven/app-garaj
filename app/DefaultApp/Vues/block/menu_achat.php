<?php
use systeme\Application\Application as  App;
?>
<a href="<?= App::genererUrl("lister_fournisseur"); ?>" class="btn btn-success">Nouvel Achat</a>
<a href="<?= App::genererUrl("lister_achat"); ?>" class="btn btn-success">Liste des Achats</a>
<hr>