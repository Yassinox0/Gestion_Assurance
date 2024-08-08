<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $idMarche = isset($_GET['idM']) ? intval($_GET['idM']) : 0;

    $requete = "SELECT * FROM marches WHERE id_marche = ?";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([$idMarche]);
    $marche = $stmt->fetch();
    
    $numero_marche = $marche['numero_marche'];
    $objet = $marche['objet'];
    $direction = $marche['direction'];
    $montant = $marche['montant'];
    $devise = $marche['devise'];
    $annee = $marche['annee'];
    $id_fournisseur = $marche['id_fournisseur'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Édition d'un Marché</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading">Édition du Marché :</div>
            <div class="panel-body">
                <form method="post" action="updateMarche.php" class="form">
                    <div class="form-group">
                        <label for="id_marche">ID du Marché: <?php echo htmlspecialchars($idMarche); ?></label>
                        <input type="hidden" name="id_marche" class="form-control" value="<?php echo htmlspecialchars($idMarche); ?>" />
                    </div>

                    <div class="form-group">
                        <label for="numero_marche">Numéro du Marché:</label>
                        <input type="text" name="numero_marche" class="form-control" value="<?php echo htmlspecialchars($numero_marche); ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="objet">Objet:</label>
                        <textarea name="objet" class="form-control" required><?php echo htmlspecialchars($objet); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="direction">Direction:</label>
                        <input type="text" name="direction" class="form-control" value="<?php echo htmlspecialchars($direction); ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="montant">Montant:</label>
                        <input type="number" step="0.01" name="montant" class="form-control" value="<?php echo htmlspecialchars($montant); ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="devise">Devise:</label>
                        <input type="text" name="devise" class="form-control" value="<?php echo htmlspecialchars($devise); ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="annee">Année:</label>
                        <input type="number" name="annee" class="form-control" value="<?php echo htmlspecialchars($annee); ?>" min="1900" max="<?php echo date('Y'); ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="id_fournisseur">Fournisseur:</label>
                        <select name="id_fournisseur" class="form-control">
                            <?php
                            $resultat = $pdo->query("SELECT id_fournisseur, nom_fournisseur FROM fournisseurs");
                            while ($row = $resultat->fetch()) {
                                $selected = ($row['id_fournisseur'] == $id_fournisseur) ? "selected" : "";
                                echo "<option value='{$row['id_fournisseur']}' $selected>{$row['nom_fournisseur']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
