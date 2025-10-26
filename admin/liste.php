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
if (!isset($_SESSION['admin_id']) || ($_SESSION['role'] != 'admin')) {
    header('location: ../login.php');
} 
require('connect.php');
require('dashboard.php');
    try {
        $pdo = connect();

    if ($pdo) {
        $req = "select * from Auteur";
        $resultat = $pdo->query($req);
        if ($resultat->rowCount() == 0) {
            echo "<br>Resultat vide...";
        } else {
            echo '<div class="container">
            <div class="box">
            <h1>Liste des Auteurs</h1>
            <table class="table">
            <thead>
            <tr>
            <th scope="col">Image</th>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Biographie</th>
            <th scope="col">date de naissance</th>
            <th scope="col">Gestionnaire</th>
            </tr>
            </thead>
            <tbody>
            </div>
            </div>';
            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                $id=$ligne['id'];
                echo "<tr>";
                echo "<td><img src='" . htmlspecialchars($ligne['images']) . "' alt='" . htmlspecialchars($ligne['nom']) . "' style='width: 100px; height: auto;'></td>";  
                echo "<th scope='row'>$id</td>";
                echo "<td>" . $ligne['nom'] . "</td>";
                echo "<td>" . $ligne['biographie'] . "</td>";
                echo "<td>" . $ligne['date_de_naissance'] . "</td>";
                echo "<td>" . "<a href='detailauteur.php?id=$id' class='btn btn-info'>detail</a> | 
                <a href='deleteauteur.php?id=$id' class='btn btn-danger'>Supprimer</a> |
                <a href='modifierauteur.php?id=$id' class='btn btn-warning'>Modifier</a>" . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo"<a href='ajoutAuteur.php?id=$id' class='btn btn-info'>Ajouter</a>";
            echo "</div>";
        }
        }
    } catch (PDOException $e) {
        echo "Attention : une exception s'est produite<br>";
        echo $e->getMessage();
    }
    ?>
        
</body>
</html>