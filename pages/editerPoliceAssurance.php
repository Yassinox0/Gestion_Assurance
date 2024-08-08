<?php
require_once('identifier.php');
require_once('connexiondb.php');

$idPolice = isset($_GET['idPolice']) ? $_GET['idPolice'] : 0;

if ($idPolice > 0) {
    $requetePolice = "SELECT * FROM polices_assurance WHERE id_police = ?";
    $stmt = $pdo->prepare($requetePolice);
    $stmt->execute([$idPolice]);
    $police = $stmt->fetch();

    if (!$police) {
        header('Location: policeAssurance.php');
        exit();
    }
} else {
    header('Location: policeAssurance.php');
    exit();
}

// Retrieve the list of 'marches' for the dropdown
$requeteMarches = "SELECT id_marche,numero_marche FROM marches"; // Adjust the table and column names if needed
$resultatMarches = $pdo->query($requeteMarches);
?>

<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Éditer Police d'Assurance</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php require("menu.php"); ?>

    <div class="container">
        <div class="panel panel-success margetop60">
            <div class="panel-heading">Éditer Police d'Assurance</div>
            <div class="panel-body">
                <form method="post" action="updatePoliceAssurance.php" class="form-horizontal">
                    <input type="hidden" name="id_police" value="<?php echo htmlspecialchars($police['id_police']); ?>" />

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Numéro d'Assurance:</label>
                        <div class="col-sm-10">
                            <input type="text" name="numero_assurance" class="form-control" value="<?php echo htmlspecialchars($police['numero_assurance']); ?>" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Libellé d'Assurance:</label>
                        <div class="col-sm-10">
                            <input type="text" name="libelle_assurance" class="form-control" value="<?php echo htmlspecialchars($police['libelle_assurance']); ?>" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Exigé:</label>
                        <div class="col-sm-10">
                            <select name="exige" class="form-control" required>
                                <option value="Oui" <?php if ($police['exige'] == 'Oui') echo 'selected'; ?>>Oui</option>
                                <option value="Non" <?php if ($police['exige'] == 'Non') echo 'selected'; ?>>Non</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Statut:</label>
                        <div class="col-sm-10">
                            <select name="statut" class="form-control" required>
                                <option value="Active" <?php if ($police['statut'] == 'Active') echo 'selected'; ?>>Active</option>
                                <option value="Expiré" <?php if ($police['statut'] == 'Expiré') echo 'selected'; ?>>Expiré</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de Début:</label>
                        <div class="col-sm-10">
                            <input type="date" name="date_debut" class="form-control" value="<?php echo htmlspecialchars($police['date_debut']); ?>" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de Fin:</label>
                        <div class="col-sm-10">
                            <input type="date" name="date_fin" class="form-control" value="<?php echo htmlspecialchars($police['date_fin']); ?>" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Marché:</label>
                        <div class="col-sm-10">
                            <select name="id_marche" class="form-control" required>
                                <option value="">Sélectionner un marché</option>
                                <?php
                                while ($marche = $resultatMarches->fetch()) {
                                    echo '<option value="' . htmlspecialchars($marche['id_marche']) . '"';
                                    if ($marche['id_marche'] == $police['id_marche']) {
                                        echo ' selected';
                                    }
                                    echo '>' . htmlspecialchars($marche['numero_marche']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Mettre à Jour</button>
                            <a href="policeAssurance.php" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</HTML>
