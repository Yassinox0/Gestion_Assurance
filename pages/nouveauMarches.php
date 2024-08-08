<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau Marché</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading">Veuillez saisir les données du nouveau marché</div>
            <div class="panel-body">
                <form method="post" action="insertMarche.php" class="form">
                    <div class="form-group">
                        <label for="numero_marche">Numéro du marché:</label>
                        <input type="text" id="numero_marche" name="numero_marche" placeholder="Numéro du marché" class="form-control" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="objet">Objet:</label>
                        <textarea id="objet" name="objet" placeholder="Objet du marché" class="form-control" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="direction">Direction:</label>
                        <input type="text" id="direction" name="direction" placeholder="Direction" class="form-control" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="montant">Montant:</label>
                        <input type="number" id="montant" name="montant" placeholder="Montant" class="form-control" step="0.01" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="devise">Devise:</label>
                        <input type="text" id="devise" name="devise" placeholder="Devise" class="form-control" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="annee">Année:</label>
                        <input type="number" id="annee" name="annee" placeholder="Année" class="form-control" min="1900" max="2099" step="1" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="id_fournisseur">Fournisseur:</label>
                        <select name="id_fournisseur" id="id_fournisseur" class="form-control">
                            <?php
                                // Fetch suppliers to populate the dropdown
                                $query = "SELECT id_fournisseur, nom_fournisseur FROM fournisseurs";
                                $stmt = $pdo->query($query);
                                while ($row = $stmt->fetch()) {
                                    echo "<option value='" . htmlspecialchars($row['id_fournisseur']) . "'>" . htmlspecialchars($row['nom_fournisseur']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>      
</body>
</html>
