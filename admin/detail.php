<link rel="stylesheet" href="css/maiin.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
<body class="main">
    <?php include '../includes/nav.php'; ?>
</body>
<style>
    body {
        background-image: url('/pics/7.jpg');
        background-size:contain;
        background-position: center;
        background-attachment: fixed;
    }
</style>
<?php
session_start();
    require('connect.php');
    $titre=$_GET['titre'];
    
try{
    $pdo = connect();
    $requete = "select b.titre, b.images, a.nom as name, g.nom, g.description from books b join Auteur a on b.auteur_id=a.id join Genre g on b.genre_id=g.id  where b.titre='$titre'";
    $resultat = $pdo->query($requete);
    if ($resultat->rowCount() == 0) {
        echo "<br>livre introuvable";
    } else {
        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
        $_SESSION['panier'] = [
            $ligne['images'],
            $ligne['name'],
            $ligne['nom'],
            $ligne['description'],
            $ligne['titre']
        ];
      echo"
    <link rel='stylesheet' href='stylee.css'>
      <div class='container my-5'>
            <div class='card mx-auto shadow-lg' style='max-width: 600px;'>
                <div class='card-header '>
                    <h2>Détails du livre</h2>
                </div>
                <div class='card-body'>
                 <div class='text-center mb-4'>
                        <img src='" . $ligne['images']. "' alt='Image du livre' class='img-fluid' style='max-height: 300px; max-width: 100%; object-fit: contain;'>
                    </div>
                <strong>
                    <p>Titre de livre: " . $ligne['titre']. "</p>
                    <p>Auteur  : " .$ligne['name']. "</p>
                    <p>Genre : " . $ligne['nom'] . "</p>
                    <p>description: " . $ligne['description']. "</p>
                    <form action='' method='POST'>
                             <label for='avisuser'>Écrivez votre avis :</label><br>
                             <textarea id='avisuser' name='avisuser' rows='2' cols='30' placeholder='Votre avis ici...'></textarea>&nbsp
                             <button type='submit' class='btn btn-primary' name='avis'>Ajouter</button>
                    </form>
                    </strong>
                <input type= 'submit' class='btn btn-info' name='ajout' value='Emprunter'>

                </div>

            </div>
        </div>


";
} }
catch (PDOException $e) {
  echo "<div class='container my-4'><p class='alert alert-danger'>Erreur : " . ($e->getMessage()) . "</p></div>";
}
if (isset($_POST['avis'])) {
    $critique = htmlspecialchars($_POST['avisuser']);
    try {
        $requete = "INSERT INTO Critiques(critique, nom_livre) 
                    VALUES ('$critique', '$titre')";
        $res = $pdo->exec($requete);
        if ($res == 0) {
            echo "<div class='container my-4'><p class='alert alert-danger'>Problème d'ajout";
        } else {
            echo "<div class='container my-4'><p class='alert alert-success'>Votre avis a été ajouté avec succès !</p></div>";
        }
    } catch (PDOException $e) {
        echo "<div class='container my-4'><p class='alert alert-danger'>Impossible d'ajouter la critique...</p></div>";
        echo $e->getMessage();
    }
}
?>
