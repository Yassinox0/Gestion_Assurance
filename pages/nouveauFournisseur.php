<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
   
    // This query would list out any relevant data you might want to select from.
    // For example, if there is a related table for villes, you could query it here.
    // For now, I'm assuming you don't need a query here similar to the original script.
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouveau Fournisseur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Les infos du nouveau Fournisseur :</div>
                <div class="panel-body">
                    <form method="post" action="insertFournisseur.php" class="form">
                        <div class="form-group">
                            <label for="ICE">ICE :</label>
                            <input type="text" name="ICE" placeholder="ICE" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="IF">IF :</label>
                            <input type="text" name="IF" placeholder="IF" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="nom_fournisseur">Nom du Fournisseur :</label>
                            <input type="text" name="nom_fournisseur" placeholder="Nom Fournisseur" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse :</label>
                            <input type="text" name="adresse" placeholder="Adresse" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville :</label>
                            <input type="text" name="ville" placeholder="Ville" class="form-control" required/>
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
</HTML>
