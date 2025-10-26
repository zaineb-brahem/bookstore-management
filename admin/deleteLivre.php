<?php
require('connect.php');
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
$pdo = connect();
  $requete = "delete from books where id=$id";
  try{
    $resultat = $pdo->exec($requete);
    if ($resultat == 0) {
      echo "<br>Probleme de suppression...";
  } else {
        header("location:listelivre.php");
        echo "book id:$id a ete supprime avec succes...";
       
  }
  }
catch(PDOException $e)
  {
    echo "Impossible de supprimer ce book..";
    echo $e->getMessage();
  }
}
  ?>
