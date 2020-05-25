<?php
require_once "../../../vendor/autoload.php";
if(isset($_POST['numero']))
{
$numero=$_POST['numero'];
}
?>

    <div class="modal-content">
      <div class="modal-header">
          
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Information Produit (Materiel)</h4>
      </div>
      <div class="modal-body">
          
       <?php
          $itm=new \app\DefaultApp\Models\Stock();
          $itm=$itm->rechercher($numero);

        ?>
          <form enctype="multipart/form-data" method="post" class="form-signin"  id="nouveau_produit"  action="" >
              <div class="col-md-12">
                  <table class="table">
                      <tr>
                          <th>Catégorie</th>
                          <th>
                              <?= $itm->getGroupe(); ?>
                          </th>
                      </tr>

                      <tr>
                          <th>Nom</th>
                          <th>
                              <?= $itm->getNom(); ?>
                          </th>
                      </tr>

                      <tr>
                          <th>Nom Alternatif</th>
                          <th>
                              <?= $itm->getNomAlternatif(); ?>
                          </th>
                      </tr>

                      <tr>
                          <th>Description</th>
                          <th>
                              <?= $itm->getDescription(); ?>
                          </th>
                      </tr>




                      <tr>
                          <th>Quantite Maximale</th>
                          <th>
                              <?= $itm->getQuantiteMaximale(); ?>
                          </th>

                      </tr>

                      <tr>
                          <th>Quantite Critique</th>
                          <th>
                              <?= $itm->getQuantiteCritique(); ?>
                          </th>

                      </tr>



                  </table>
              </div>


          </form>

      </div>
        <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>