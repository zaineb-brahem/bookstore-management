<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require ('connect.php');
    $id=$_GET['id'];
    $pdo=connect();
    $sql = "DELETE FROM Auteur WHERE id = $id";
    try{
        $resultat = $pdo->exec($sql);
        if ($resultat == 0) {
        echo "<br>Probleme de suppression...";
        } else {
            header("location:liste.php");
        }
    }
    catch(PDOException $e)
    {
        echo "Impossible de supprimer cet auteur...";
        echo $e->getMessage();
    }
    
    
    ?>
</body>
</html>