<link rel="stylesheet" href="css/maiin.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body{
        background-image: url(/pics/10.jpg);
    }
</style>
<?php
    require('connect.php');
    $id=$_GET['id'];
    try{
    $pdo = connect();
    $requete = "select * from Auteur where id=$id";
    $resultat = $pdo->query($requete);
    if ($resultat->rowCount() == 0) {
    echo "<br>Id auteur introuvable";
    } else {
        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
        echo"
      <link rel='stylesheet' href='stylee.css'>
        <div class='container my-5'>
              <div class='card mx-auto shadow-lg' style='max-width: 600px;'>
                  <div class='card-header '>
                      <h2>Détails d'auteur</h2>
                  </div>
                  <div class='card-body'>
                   <div class='text-center mb-4'>
                          <img src='" . $ligne['images']. "' alt='Image du livre' class='img-fluid' style='max-height: 300px; max-width: 100%; object-fit: contain;'>
                      </div>
                  <strong>
                      <p>id : ".$ligne['id']."</p>
                      <p>Nom: : " .$ligne['nom']. "</p>
                      <p>biographie:<br>" . ($ligne['biographie']) . "</p>
                      <p> date de naissance :" . ($ligne['date_de_naissance']) . "</p>
                      </strong>
                  </div>

              </div>
          </div>";
  }}catch (PDOException $e) {
    echo "<div class='container my-4'><p class='alert alert-danger'>Erreur : " . ($e->getMessage()) . "</p></div>";
  }
  ?>
</body>
</html>