<?php
require_once('identifier.php');
require_once("connexiondb.php");

// Capture search inputs
$numeroAssurance = isset($_GET['numeroAssurance']) ? $_GET['numeroAssurance'] : "";
$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page-1) * $size;

// SQL queries for fetching data
$requetePolice = "SELECT id_police, numero_assurance, libelle_assurance, exige, statut, date_debut, date_fin
                   FROM polices_assurance
                   WHERE numero_assurance LIKE '%$numeroAssurance%'
                   ORDER BY id_police
                   LIMIT $size OFFSET $offset";

$requeteCount = "SELECT count(*) countP FROM polices_assurance
                 WHERE numero_assurance LIKE '%$numeroAssurance%'";

// Execute the queries
$resultatPolice = $pdo->query($requetePolice);
$resultatCount = $pdo->query($requeteCount);

// Fetch the count of insurance policies
$tabCount = $resultatCount->fetch();
$nbrPolice = $tabCount['countP'];
$reste = $nbrPolice % $size;   
if ($reste === 0) {
    $nbrPage = $nbrPolice / $size;   
} else {
    $nbrPage = floor($nbrPolice / $size) + 1;  
}
?>
<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Gestion des Polices d'Assurance</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php require("menu.php"); ?>
    
    <div class="container">
        <div class="panel panel-success margetop60">
            <div class="panel-heading">Rechercher des Polices d'Assurance</div>
            <div class="panel-body">
                <form method="get" action="policeAssurance.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="numeroAssurance" 
                               placeholder="Numéro d'assurance"
                               class="form-control"
                               value="<?php echo htmlspecialchars($numeroAssurance, ENT_QUOTES); ?>" />
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button>
                    &nbsp;&nbsp;
                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                        <a href="nouveauPoliceAssurance.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            Nouvelle Police
                        </a>
                    <?php } ?>
                </form>
            </div>
        </div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des Polices d'Assurance (<?php echo $nbrPolice ?> Polices)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Libellé</th>
                            <th>Exigé</th>
                            <th>Statut</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <th>Actions</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($police = $resultatPolice->fetch()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($police['numero_assurance'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($police['libelle_assurance'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($police['exige'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($police['statut'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($police['date_debut'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($police['date_fin'], ENT_QUOTES); ?></td>
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <td>
                                    <a href="editerPoliceAssurance.php?idPolice=<?php echo htmlspecialchars($police['id_police']); ?>">
    <span class="glyphicon glyphicon-edit"></span>
</a>


                                        &nbsp;&nbsp;
                                        <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cette police ?')"
   href="supprimerPoliceAssurance.php?idPolice=<?php echo htmlspecialchars($police['id_police']); ?>">
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
                                <a href="policeAssurance.php?page=<?php echo $i; ?>&numeroAssurance=<?php echo htmlspecialchars($numeroAssurance, ENT_QUOTES); ?>">
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
