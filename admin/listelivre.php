<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/maiin.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <title>Document</title>
</head>
<body >
<style>
body{
    background: url(../pics/10.jpg);
}
</style>
<?php
session_start();
include('dashboard.php');
?>
<?php

if (!isset($_SESSION['admin_id']) || ($_SESSION['role'] != 'admin')) {
    header('location: ../login.php');
} 
require('connect.php');

try {
    $pdo = connect();

    if ($pdo) {
        $titre = isset($_GET['titre']) ? trim($_GET['titre']) : '';
        $req = "select * from books where disponible=1";
        if (!empty($titre)) {
            $req .= " and titre like '%$titre%'";
        }
        $resultat = $pdo->query($req);

        if ($resultat->rowCount() == 0) {
            echo "<br>Aucun livre trouvé...";
        } else {
            echo '
            <div class="container">
            
                        <div class="box">
                        <h1>Gestion des Livres</h1>
                <form action="listelivre.php" method="GET">
                <div class="mb">
                <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrer le titre de livre souhaité " value="' . htmlspecialchars($titre) . '">
                </div>
            <button type="submit" class="btn btn-info">Chercher</button>
            </form><br>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Image:</th>
                                <th scope="col">ID</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Auteur_id</th>
                                <th scope="col">Genre_id</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    </div>
                    </div>';
            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $id = $ligne['id'];
                echo "<tr>";
                echo "<td><img src='" . htmlspecialchars($ligne['images']) . "' alt='" . htmlspecialchars($ligne['titre']) . "' style='width: 100px; height: auto;'></td>";
                echo "<td>$id</td>";
                echo "<td>" . $ligne['titre'] . "</td>";
                echo "<td>" . $ligne['auteur_id'] . "</td>";
                echo "<td>" . $ligne['genre_id'] . "</td>";
                echo "<td>" . $ligne['ISBN'] . "</td>";
                echo "<td>" . "<a href='detailliv.php?titre=" . $ligne['titre'] . "' class='btn btn-info'>Détails</a>| 
                                <a href='deleteLivre.php?id=$id' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce livre ?\");'>Supprimer</a> |
                                <a href='modifierLivre.php?id=$id' class='btn btn-warning'>Modifier</a>" . "</td>";
            }
            echo '</tbody>
                </table>
                <a href="ajoutlivre.php" class="btn btn-info">Ajouter un nouveau livre</a>
            </div>';
        }
    }
} catch (PDOException $e) {
    echo "Attention : une exception s'est produite<br>";
    echo $e->getMessage();
}
?>
