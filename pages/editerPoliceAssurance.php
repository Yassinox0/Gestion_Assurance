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
                    <!-- Other fields... -->
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
