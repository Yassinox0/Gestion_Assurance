<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $idMarche = isset($_POST['id_marche']) ? intval($_POST['id_marche']) : 0;
    $numero_marche = isset($_POST['numero_marche']) ? $_POST['numero_marche'] : '';
    $objet = isset($_POST['objet']) ? $_POST['objet'] : '';
    $direction = isset($_POST['direction']) ? $_POST['direction'] : '';
    $montant = isset($_POST['montant']) ? $_POST['montant'] : 0;
    $devise = isset($_POST['devise']) ? $_POST['devise'] : '';
    $annee = isset($_POST['annee']) ? $_POST['annee'] : 0;
    $id_fournisseur = isset($_POST['id_fournisseur']) ? intval($_POST['id_fournisseur']) : 0;

    $requete = "UPDATE marches SET numero_marche = ?, objet = ?, direction = ?, montant = ?, devise = ?, annee = ?, id_fournisseur = ? WHERE id_marche = ?";
    $params = array($numero_marche, $objet, $direction, $montant, $devise, $annee, $id_fournisseur, $idMarche);
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('Location: marches.php');
?>
