<?php
require_once('identifier.php');
require_once('connexiondb.php');

// Retrieve supplier ID from URL
$idFournisseur = isset($_GET['idFournisseur']) ? intval($_GET['idFournisseur']) : 0;

// Fetch the supplier data based on the ID
$requete = "SELECT id_fournisseur, ICE, `IF`, nom_fournisseur, adresse, ville
            FROM fournisseurs
            WHERE id_fournisseur = ?";
$resultat = $pdo->prepare($requete);
$resultat->execute([$idFournisseur]);
$fournisseur = $resultat->fetch();

if (!$fournisseur) {
    // Handle the case where the supplier is not found
    echo "Fournisseur not found.";
    exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Modifier Fournisseur</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
    <?php require("menu.php"); ?>
    <div class="container">
        <h1>Modifier Fournisseur</h1>
        <form method="post" action="updateFournisseur.php">
            <input type="hidden" name="idFournisseur" value="<?php echo htmlspecialchars($fournisseur['id_fournisseur']); ?>">
            <div class="form-group">
                <label for="ICE">ICE:</label>
                <input type="text" class="form-control" id="ICE" name="ICE" value="<?php echo htmlspecialchars($fournisseur['ICE']); ?>" required>
            </div>
            <div class="form-group">
                <label for="IF">IF:</label>
                <input type="text" class="form-control" id="IF" name="IF" value="<?php echo htmlspecialchars($fournisseur['IF']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nom_fournisseur">Nom:</label>
                <input type="text" class="form-control" id="nom_fournisseur" name="nom_fournisseur" value="<?php echo htmlspecialchars($fournisseur['nom_fournisseur']); ?>" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <textarea class="form-control" id="adresse" name="adresse" rows="4" required><?php echo htmlspecialchars($fournisseur['adresse']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="ville">Ville:</label>
                <input type="text" class="form-control" id="ville" name="ville" value="<?php echo htmlspecialchars($fournisseur['ville']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>
