<?php
session_start();
if (isset($_SESSION['user'])) {
    require_once('connexiondb.php');
    
    // Retrieve the ID of the marche to be deleted
    $idMarche = isset($_GET['idM']) ? intval($_GET['idM']) : 0;

    if ($idMarche > 0) {
        // Prepare the delete statement
        $requete = "DELETE FROM marches WHERE id_marche = ?";
        $params = array($idMarche);

        try {
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
            
            // Redirect to the list page after successful deletion
            header('Location: marches.php');
        } catch (PDOException $e) {
            // Handle the exception if the delete operation fails
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Handle the case where the ID is not valid
        echo "Invalid ID.";
    }
} else {
    header('Location: login.php');
}
?>
