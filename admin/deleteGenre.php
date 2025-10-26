
<?php
  require('connect.php');
  $id=$_GET['id'];
  $pdo = connect();
  $requete = "delete from Genre where id=$id";
  try{
    $resultat = $pdo->exec($requete);
    if ($resultat == 0) {
      echo "<br>Probleme de suppression...";
  } else {
        header("location:gestionGenre.php");
      /*  echo "<h1>Suppression editeur</h1>";
        echo "Editeur id:$id a ete supprime avec succes...";*/
       
  }
  }
  catch(PDOException $e)
  {
    echo "Impossible de supprimer cet Genre...";
    echo $e->getMessage();
  }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>