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
    <label for="nom" class="form-label">Nom Auteur</label>
    <input type="text" class="form-control" id="idA" name="nom" aria-describedby="emailHelp"><br>
    <label class="form-label">biographie</label>
    <input type="text" class="form-control" id="biographie" name="biographie" aria-describedby="emailHelp"><br>
    <label  class="form-label">Nom date</label>
    <input type="date" class="form-control" id="date" name="date" aria-describedby="emailHelp">
    <label for="images">Image:</label>
                <input type="text" class="form-control" name="images" id="images" placeholder="saisir le lien de photo de livre" required>

    </div>

<button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
</div>
</form>
</div>
    <?php 
    require('connect.php');
    $pdo=connect();
    if(isset($_POST['submit'])){
        $nom = $_POST['nom'];
        $biographie = $_POST['biographie'];
        $date = $_POST['date'];
        $query="INSERT INTO Auteur (nom,biographie,date_de_naissance) values('$nom','$biographie','$date')";
        try{
            $resultat = $pdo->exec($query);
        if ($resultat == 0) {
            echo "<br>Probleme d'ajout...";
        } else 
        {
            header("location:liste.php");
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    }
    ?>
</body>
</html>