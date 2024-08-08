<?php
    require_once('identifier.php');
    require_once('connexiondb.php');

    // Retrieve form data
    $ICE = isset($_POST['ICE']) ? $_POST['ICE'] : "";
    $IF = isset($_POST['IF']) ? $_POST['IF'] : "";
    $nomFournisseur = isset($_POST['nom_fournisseur']) ? $_POST['nom_fournisseur'] : "";
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";
    $ville = isset($_POST['ville']) ? $_POST['ville'] : "";

    // Prepare and debug the insert query
    $requete = "INSERT INTO fournisseurs (ICE, `IF`, nom_fournisseur, adresse, ville) VALUES (?, ?, ?, ?, ?)";
    $params = array($ICE, $IF, $nomFournisseur, $adresse, $ville);

    try {
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:fournisseurs.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
