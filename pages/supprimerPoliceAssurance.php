<?php
session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] == 'ADMIN') {
        require_once('connexiondb.php');

        // Retrieve insurance policy ID from the URL
        $idPolice = isset($_GET['idPolice']) ? intval($_GET['idPolice']) : 0;

        // Prepare and execute the delete query
        $requete = "DELETE FROM polices_assurance WHERE id_police = ?";
        $params = array($idPolice);

        try {
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);

            // Redirect to the insurance policies list page
            header('Location: PoliceAssurance.php');
            exit(); // Ensure no further code is executed
        } catch (PDOException $e) {
            // Handle SQL errors
            $message = urlencode("Erreur lors de la suppression de la police d'assurance: " . htmlspecialchars($e->getMessage()));
            $url = urlencode('PoliceAssurance.php');
            header("Location: alerte.php?message=$message&url=$url");
            exit(); // Ensure no further code is executed
        }
    } else {
        $message = urlencode("Vous n'avez pas le privilège de supprimer une police d'assurance!");
        $url = urlencode('PoliceAssurance.php');
        header("Location: alerte.php?message=$message&url=$url");
        exit(); // Ensure no further code is executed
    }
} else {
    header('Location: login.php');
    exit(); // Ensure no further code is executed
}
?>
