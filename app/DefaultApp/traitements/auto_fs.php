<?php
if(isset($_GET['query'])) {
    // Mot tapé par l'utilisateur
    $q = htmlentities($_GET['query']);

    include_once("fonction.php");
    $bdd=connection();
    // Requête SQL
    $requete="SELECT * FROM couverture_medical WHERE no_enregistrement LIKE '".$q."%' and couverture='famille en santé'  LIMIT 0, 100";

    // Exécution de la requête SQL
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

    // On parcourt les résultats de la requête SQL
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // On ajoute les données dans un tableau
        $suggestions['suggestions'][] = $donnees['no_enregistrement'];
    }

    // On renvoie le données au format JSON pour le plugin
    echo json_encode($suggestions);
}
?>