<?php
require_once('identifier.php');
require_once('connexiondb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $numero_assurance = isset($_POST['numero_assurance']) ? $_POST['numero_assurance'] : "";
    $libelle_assurance = isset($_POST['libelle_assurance']) ? $_POST['libelle_assurance'] : "";
    $exige = isset($_POST['exige']) ? $_POST['exige'] : "";
    $statut = isset($_POST['statut']) ? $_POST['statut'] : "";
    $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : "";
    $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : "";
    $id_marche = isset($_POST['id_marche']) ? $_POST['id_marche'] : null;

    try {
        $requete = "INSERT INTO polices_assurance (numero_assurance, libelle_assurance, exige, statut, date_debut, date_fin, id_marche)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array($numero_assurance, $libelle_assurance, $exige, $statut, $date_debut, $date_fin, $id_marche);
        $stmt = $pdo->prepare($requete);
        $stmt->execute($params);

        // Redirect to the policies list page
        header('Location: policeAssurance.php');
        exit();
    } catch (PDOException $e) {
        // Handle any errors
        echo 'Erreur : ' . $e->getMessage();
    }
} else {
    // Redirect if not a POST request
    header('Location: policeAssurance.php');
    exit();
}
?>
