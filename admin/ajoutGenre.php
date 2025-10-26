<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background-image: url(/pics/10.jpg);
    }
</style>
<body>
<div class="container">
<div class="box">
<form method="post">
    <div class="mb-3">
    <label for="nom" class="form-label">nom:</label>
    <input type="text" class="form-control" id="nom" name="nom" aria-describedby="emailHelp"><br>
    <label class="form-label">description:</label>
    <input type="text" class="form-control" id="description" name="description" aria-describedby="emailHelp"><br>
    </div>
<button type="submit" class="btn btn-primary" name="creer">Ajouter</button>
</div>
</form>
</div>
<?php
require("connect.php");
$pdo = connect(); 

if (isset($_POST['creer'])) {
    $titre = $_POST['nom'];
    $auteur_id = $_POST['description']; 

    try {
        $requete = "INSERT INTO Genre(nom, description) 
                    VALUES('$nom', '$description')";

        $res = $pdo->exec($requete); 
        if ($res == 0) {
            echo "<br>Problème d'ajout...";
        } else {
            echo "Ajout effectué";
            header("Location: liste.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Impossible d'ajouter ce genre...";
        echo $e->getMessage(); 
    }
}
?>
</body>
</html>