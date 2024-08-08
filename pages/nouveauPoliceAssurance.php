<?php
require_once('identifier.php');
require_once('connexiondb.php');

// Fetch marchés for the dropdown
$requeteMarches = "SELECT id_marche, numero_marche FROM marches";
$resultatMarches = $pdo->query($requeteMarches);
?>
<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Nouvelle Police d'Assurance</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php require("menu.php"); ?>

    <div class="container">
        <div class="panel panel-success margetop60">
            <div class="panel-heading">Ajouter une Nouvelle Police d'Assurance</div>
            <div class="panel-body">
                <form method="post" action="insertPoliceAssurance.php" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Numéro d'Assurance:</label>
                        <div class="col-sm-10">
                            <input type="text" name="numero_assurance" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Libellé:</label>
                        <div class="col-sm-10">
                            <input type="text" name="libelle_assurance" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Exigé:</label>
                        <div class="col-sm-10">
                            <select name="exige" class="form-control" required>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Statut:</label>
                        <div class="col-sm-10">
                            <select name="statut" class="form-control" required>
                                <option value="Active">Active</option>
                                <option value="Expiré">Expiré</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de Début:</label>
                        <div class="col-sm-10">
                            <input type="date" name="date_debut" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de Fin:</label>
                        <div class="col-sm-10">
                            <input type="date" name="date_fin" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Marché:</label>
                        <div class="col-sm-10">
                            <select name="id_marche" class="form-control" required>
                                <?php while ($marche = $resultatMarches->fetch()) { ?>
                                    <option value="<?php echo $marche['id_marche']; ?>">
                                        <?php echo $marche['numero_marche']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Ajouter</button>
                            <a href="policeAssurance.php" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</HTML>
