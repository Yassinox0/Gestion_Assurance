<?php
    require_once('identifier.php');
    require_once("connexiondb.php");

    // Capture search inputs
    $nomFournisseur = isset($_GET['nomFournisseur']) ? $_GET['nomFournisseur'] : "";
    $size = isset($_GET['size']) ? $_GET['size'] : 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page-1) * $size;

    // SQL queries for fetching data
    $requeteFournisseur = "SELECT id_fournisseur, ICE, `IF`, nom_fournisseur, adresse, ville
                           FROM fournisseurs
                           WHERE nom_fournisseur LIKE '%$nomFournisseur%'
                           ORDER BY id_fournisseur
                           LIMIT $size OFFSET $offset";
    
    $requeteCount = "SELECT count(*) countF FROM fournisseurs
                     WHERE nom_fournisseur LIKE '%$nomFournisseur%'";

    // Execute the queries
    $resultatFournisseur = $pdo->query($requeteFournisseur);
    $resultatCount = $pdo->query($requeteCount);

    // Fetch the count of suppliers
    $tabCount = $resultatCount->fetch();
    $nbrFournisseur = $tabCount['countF'];
    $reste = $nbrFournisseur % $size;   
    if ($reste === 0) {
        $nbrPage = $nbrFournisseur / $size;   
    } else {
        $nbrPage = floor($nbrFournisseur / $size) + 1;  
    }
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des Fournisseurs</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php require("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-success margetop60">
                <div class="panel-heading">Rechercher des Fournisseurs</div>
                <div class="panel-body">
                    <form method="get" action="fournisseurs.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomFournisseur" 
                                   placeholder="Nom du fournisseur"
                                   class="form-control"
                                   value="<?php echo $nomFournisseur ?>"/>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        &nbsp;&nbsp;
                        <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                            <a href="nouveauFournisseur.php">
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouveau Fournisseur
                            </a>
                        <?php } ?>
                    </form>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des Fournisseurs (<?php echo $nbrFournisseur ?> Fournisseurs)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ICE</th> 
                                <th>IF</th> 
                                <th>Nom</th> 
                                <th>Adresse</th>
                                <th>Ville</th> 
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <th>Actions</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fournisseur = $resultatFournisseur->fetch()) { ?>
                                <tr>
                                    <td><?php echo $fournisseur['ICE'] ?></td>
                                    <td><?php echo $fournisseur['IF'] ?></td>
                                    <td><?php echo $fournisseur['nom_fournisseur'] ?></td>
                                    <td><?php echo $fournisseur['adresse'] ?></td>
                                    <td><?php echo $fournisseur['ville'] ?></td>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                        <td>
                                        <a href="editerFournisseur.php?idFournisseur=<?php echo htmlspecialchars($fournisseur['id_fournisseur']); ?>">
    <span class="glyphicon glyphicon-edit"></span>
</a>

                                            &nbsp;
                                            <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce fournisseur ?')"
   href="supprimerFournisseur.php?idF=<?php echo $fournisseur['id_fournisseur']; ?>">
    <span class="glyphicon glyphicon-trash"></span>
</a>

                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div>
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                                <li class="<?php if ($i == $page) echo 'active' ?>">
                                    <a href="fournisseurs.php?page=<?php echo $i; ?>&nomFournisseur=<?php echo $nomFournisseur ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</HTML>
