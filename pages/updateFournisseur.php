<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    // Retrieve form data
    $idFournisseur = isset($_POST['idFournisseur']) ? $_POST['idFournisseur'] : 0;
    $ICE = isset($_POST['ICE']) ? $_POST['ICE'] : "";
    $IF = isset($_POST['IF']) ? $_POST['IF'] : "";
    $nomFournisseur = isset($_POST['nom_fournisseur']) ? $_POST['nom_fournisseur'] : "";
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";
    $ville = isset($_POST['ville']) ? $_POST['ville'] : "";

    // Determine SQL query and parameters
    $requete = "UPDATE fournisseurs SET ICE=?, `IF`=?, nom_fournisseur=?, adresse=?, ville=? WHERE id_fournisseur=?";
    $params = array($ICE, $IF, $nomFournisseur, $adresse, $ville, $idFournisseur);

    // Execute the query
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    // Redirect to the fournisseurs list page
    header('location:fournisseurs.php');
?>
