<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    // Retrieve and sanitize form data
    $numero_marche = isset($_POST['numero_marche']) ? trim($_POST['numero_marche']) : "";
    $objet = isset($_POST['objet']) ? trim($_POST['objet']) : "";
    $direction = isset($_POST['direction']) ? trim($_POST['direction']) : "";
    $montant = isset($_POST['montant']) ? trim($_POST['montant']) : "";
    $devise = isset($_POST['devise']) ? trim($_POST['devise']) : "";
    $annee = isset($_POST['annee']) ? intval($_POST['annee']) : 0;
    $id_fournisseur = isset($_POST['id_fournisseur']) ? intval($_POST['id_fournisseur']) : null;
    
    // Validate required fields
    if (!empty($numero_marche) && !empty($objet) && !empty($direction) && !empty($montant) && !empty($devise) && !empty($annee)) {
        // Prepare SQL statement
        $requete = "INSERT INTO marches (numero_marche, objet, direction, montant, devise, annee, id_fournisseur) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array($numero_marche, $objet, $direction, $montant, $devise, $annee, $id_fournisseur);
        $resultat = $pdo->prepare($requete);
        
        // Execute the query
        $resultat->execute($params);
        
        // Redirect to the list of marches
        header('Location: marches.php');
        exit;
    } else {
        // Handle the error if form data is invalid
        echo "Les données du formulaire sont invalides.";
    }
?>
