<?php
if(isset($_GET['query'])) {
    // Mot tapé par l'utilisateur
    $q = htmlentities($_GET['query']);
    include_once("fonction.php");
    $bdd=connection();
    // Requête SQL
    $requete="SELECT * FROM examens WHERE type='imagerie' and categorie='radiographie' and (nom LIKE '%".$q."%' or nom_alternatif LIKE '%".$q."%')";
    // Exécution de la requête SQL
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    // On parcourt les résultats de la requête SQL
    if($donnees = $resultat->fetch(PDO::FETCH_ASSOC))
    {
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // On ajoute les données dans un tableau
            $suggestions['suggestions'][] = $donnees['nom'];
        }
    }else
    {
        $suggestions['suggestions'][] = "Aucun resultat";
    }

    // On renvoie le données au format JSON pour le plugin
    echo json_encode($suggestions);
}
?>