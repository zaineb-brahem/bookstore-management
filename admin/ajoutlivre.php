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
    <label for="nom" class="form-label">titre de livre:</label>
    <input type="text" class="form-control" id="titre" name="titre" aria-describedby="emailHelp"><br>
    <label class="form-label">Auteur_id:</label>
    <input type="text" class="form-control" id="auteur_id" name="auteur_id" aria-describedby="emailHelp"><br>
    <label  class="form-label">Genre_id</label>
    <input type="text" class="form-control" id="genre_id" name="genre_id" aria-describedby="emailHelp">
    <label  class="form-label">ISBN</label>
    <input type="text" class="form-control" id="ISBN" name="ISBN" aria-describedby="emailHelp">

    <label for="disponible">Disponible :</label>
    <select class="form-control" name="disponible" id="disponible" required>
            <option value="1">oui</option>
            <option value="0">non</option>
    </select>
    </div>
    <label for="images">Image:</label>
                <input type="text" class="form-control" name="images" id="images" placeholder="saisir le lien de photo de livre" required>

<button type="submit" class="btn btn-primary" name="creer">Ajouter</button>
</div>
</form>
</div>
<?php
require("connect.php");
$pdo = connect(); 

if (isset($_POST['creer'])) {
    $titre = $_POST['titre'];
    $auteur_id = $_POST['auteur_id']; 
    $genre_id = $_POST['genre_id']; 
    $ISBN = $_POST['ISBN']; 
    $disponible = $_POST['disponible'];  
    $images = $_POST['images']; 
    try {
        $requete = "INSERT INTO books(titre, auteur_id, genre_id, ISBN, disponible, images) 
                    VALUES('$titre', '$auteur_id', '$genre_id', '$ISBN', '$disponible' ,'$images')";

        $res = $pdo->exec($requete); 
        if ($res == 0) {
            echo "<br>Problème d'ajout...";
        } else {
            echo "Ajout effectué";
            header("Location: listelivre.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Impossible d'ajouter ce livre...";  
        echo $e->getMessage(); 
    }
}
?>
</body>
</html>

