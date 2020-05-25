<?php
require "../../../vendor/autoload.php";
if(isset($_GET['term'])) {
    // Mot tapé par l'utilisateur
    $q = htmlentities($_GET['term']);
    $bdd=\app\DefaultApp\DefaultApp::connection();

    // Requête SQL
    if(isset($_GET['pharmacie'])){
        $requete="SELECT * FROM stock WHERE nom LIKE '".$q."%' and groupe ='Medicament'  LIMIT 0, 100";
    }elseif(isset($_GET['magasin'])){
        $requete="SELECT * FROM stock WHERE nom LIKE '".$q."%' and groupe !='Medicament'  LIMIT 0, 100";
    }else{
        $requete="SELECT * FROM stock WHERE nom LIKE '".$q."%'  LIMIT 0, 100";
    }

    // Exécution de la requête SQL
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

    // On parcourt les résultats de la requête SQL
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // On ajoute les données dans un tableau
        $suggestions[] = $donnees['nom'];
    }
    // On renvoie le données au format JSON pour le plugin
    echo json_encode($suggestions);
}
?>