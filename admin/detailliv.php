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
$titre = $_GET['titre'];
try {
    $pdo = connect();
    $requete = "select * from books where titre='$titre'";
    $resultat = $pdo->query($requete);
    if ($resultat->rowCount() == 0) {
        echo "<br>livre introuvable";
    } else {
        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
        echo "
    <link rel='stylesheet' href='stylee.css'>
    <style>
    <style>
    body {
        background-image: url('/pics/');
        background-size: cover; 
        background-position: 
        background-attachment: fixed; 
    }
</style>

    </style>
      <div class='container my-5'>
            <div class='card mx-auto shadow-lg' style='max-width: 600px;'>
                <div class='card-header '>
                    <h2>Détails du livre</h2>
                </div>
                <div class='card-body'>
                 <div class='text-center mb-4'>
                        <img src='" . $ligne['images'] . "' alt='Image du livre' class='img-fluid' style='max-height: 300px; max-width: 100%; object-fit: contain;'>
                    </div>
                <strong>
                    <p>Titre : " . $ligne['titre'] . "</p>
                    <p>Auteur ID : " . $ligne['auteur_id'] . "</p>
                    <p>Genre ID : " . ($ligne['genre_id']) . "</p>
                    <p>ISBN :" . ($ligne['ISBN']) . "</p>
                    <p>Disponibilité : " . ($ligne['disponible'] ? 'Oui' : 'Non') . "</p>
                    </strong>
                </div>

            </div>
        </div>


";
    }
} catch (PDOException $e) {
    echo "<div class='container my-4'><p class='alert alert-danger'>Erreur : " . ($e->getMessage()) . "</p></div>";
}
?>
