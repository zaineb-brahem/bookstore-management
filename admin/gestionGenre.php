<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Genres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/livlist.css">
</head>
<body>
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
            $req = "SELECT * FROM Genre;";
            $resultat = $pdo->query($req);

            echo "<div class='container3'>";
            echo"<div class='box'>";
            echo "<h1 class='mb-4'>Liste des Genres</h1>";

            if ($resultat->rowCount() == 0) {
                echo "<div class='alert alert-warning'>Aucun genre trouvé.</div>";
            } else {
                
                echo '<table class="table">';
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>ID de Genre</th>";
                echo "<th scope='col'>Nom de Genre</th>";
                echo "<th scope='col'>Description</th>";
                echo "<th scope='col'>Actions</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                    $id=$ligne['id'];
                    echo "<tr>";
                    echo "<th scope='row'>$id</td>";
                    echo "<td>" . $ligne['nom'] . "</td>";
                    echo "<td>" . $ligne['description'] . "</td>";
                    echo "<td>";
                    echo "<a href='detailGenre.php?id=$id' class='btn btn-sm btn-info'>Detail</a>|<a href='modifieGenre.php?id=$id' class='btn btn-sm btn-warning'>Modifier</a> | <a href='deleteGenre.php?id=$id' class='btn btn-sm btn-danger'>Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo"<a href='ajoutGenre.php?id=$id' class='btn btn-info'>Ajouter</a>";
                echo "</div>";
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

