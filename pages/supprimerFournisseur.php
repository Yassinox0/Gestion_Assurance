<?php
session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] == 'ADMIN') {
        require_once('connexiondb.php');

        // Retrieve supplier ID from the URL
        $idFournisseur = isset($_GET['idF']) ? intval($_GET['idF']) : 0;

        // Prepare and execute the delete query
        $requete = "DELETE FROM fournisseurs WHERE id_fournisseur = ?";
        $params = array($idFournisseur);

        try {
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);

            // Redirect to the fournisseurs list page
            header('location:fournisseurs.php');
        } catch (PDOException $e) {
            // Handle SQL errors
            $message = "Erreur lors de la suppression du fournisseur: " . $e->getMessage();
            $url = 'fournisseurs.php';
            header("location:alerte.php?message=$message&url=$url");
        }
    } else {
        $message = "Vous n'avez pas le privilège de supprimer un fournisseur!";
        $url = 'fournisseurs.php';
        header("location:alerte.php?message=$message&url=$url");
    }
} else {
    header('location:login.php');
}
?>
