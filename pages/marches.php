<?php
    require_once('identifier.php');
    require_once("connexiondb.php");

    $numeroMarche = isset($_GET['numeroMarche']) ? $_GET['numeroMarche'] : "";
    $size = isset($_GET['size']) ? $_GET['size'] : 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $size;

    // Build the query based on the search input
    $requete = "SELECT * FROM marches
                WHERE numero_marche LIKE '%$numeroMarche%'
                LIMIT $size OFFSET $offset";

    $requeteCount = "SELECT COUNT(*) countM FROM marches
                     WHERE numero_marche LIKE '%$numeroMarche%'";

    $resultatM = $pdo->query($requete);
    $resultatCount = $pdo->query($requeteCount);

    // Fetch the count of marches
    $tabCount = $resultatCount->fetch();
    $nbrMarches = $tabCount['countM'];
    $reste = $nbrMarches % $size;
    $nbrPage = ($reste === 0) ? ($nbrMarches / $size) : (floor($nbrMarches / $size) + 1);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion des Marchés</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="container">
        <div class="panel panel-success margetop60">
            <div class="panel-heading">Rechercher des Marchés</div>
            <div class="panel-body">
                <form method="get" action="marches.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="numeroMarche" 
                               placeholder="Numéro du marché"
                               class="form-control"
                               value="<?php echo htmlspecialchars($numeroMarche) ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button>
                    &nbsp;&nbsp;
                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                        <a href="nouveauMarches.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            Nouveau Marché
                        </a>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Liste des Marchés (<?php echo $nbrMarches ?> Marchés)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Objet</th>
                            <th>Direction</th>
                            <th>Montant</th>
                            <th>Devise</th>
                            <th>Année</th>
                            <th>Fournisseur</th>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <th>Actions</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($marche = $resultatM->fetch()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($marche['numero_marche']) ?></td>
                                <td><?php echo htmlspecialchars($marche['objet']) ?></td>
                                <td><?php echo htmlspecialchars($marche['direction']) ?></td>
                                <td><?php echo htmlspecialchars(number_format($marche['montant'], 2)) ?></td>
                                <td><?php echo htmlspecialchars($marche['devise']) ?></td>
                                <td><?php echo htmlspecialchars($marche['annee']) ?></td>
                                <td>
                                    <?php
                                        $idFournisseur = $marche['id_fournisseur'];
                                        if ($idFournisseur) {
                                            $requeteFournisseur = "SELECT nom_fournisseur FROM fournisseurs WHERE id_fournisseur = ?";
                                            $resultatFournisseur = $pdo->prepare($requeteFournisseur);
                                            $resultatFournisseur->execute([$idFournisseur]);
                                            $fournisseur = $resultatFournisseur->fetch();
                                            echo htmlspecialchars($fournisseur['nom_fournisseur']);
                                        } else {
                                            echo 'Non assigné';
                                        }
                                    ?>
                                </td>
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <td>
                                        <a href="editerMarche.php?idM=<?php echo $marche['id_marche'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        &nbsp;
                                        <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce marché ?')"
                                           href="supprimerMarche.php?idM=<?php echo $marche['id_marche'] ?>">
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
                                <a href="marches.php?page=<?php echo $i ?>&numeroMarche=<?php echo htmlspecialchars($numeroMarche) ?>">
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
</html>
