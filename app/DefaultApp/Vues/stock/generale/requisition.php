
<div class="signin-form col-md-12" id="">
    <?php
    include "vues/block/menu_stock_generale.php";
    ?>
    <h4>Requisition <?php if(isset($requisition)){echo ucfirst($requisition);} ?></h4>

    <?php
     if($requisition=="interne"){
         include "vues/block/menu_requisition_interne.php";
         if(isset($_GET['action_requisition'])){

             $action=$_GET['action_requisition'];
             if($action=="ajouter"){
                require_once "ajouter_requisition_interne.php";
             }elseif($action=="lister"){
                require_once "lister_requisition_interne.php";
             }
         }else{
             require_once "lister_requisition_interne.php";
         }
     }
     elseif($requisition=="externe"){
         include "vues/block/menu_requisition_externe.php";
         if(isset($_GET['action_requisition'])){
             $action=$_GET['action_requisition'];
             if($action=="ajouter"){
                 require_once "ajouter_requisition_externe.php";
             }elseif($action=="lister"){
                 require_once "lister_requisition_externe.php";
             }
         }else{
             require_once "lister_requisition_externe.php";
         }
     }else{
         require_once "lister_requisition.php";
     }
    ?>


</div>
