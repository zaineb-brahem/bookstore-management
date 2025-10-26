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
require('connect.php');

$id = $_GET['id'] ;

try {
    $pdo = connect();
    $requete = "
        SELECT b.titre, b.images, a.nom as name, g.nom , g.description FROM books b join Auteur a on b.auteur_id = a.id join Genre g on b.genre_id = g.id where a.id = '$id'";
        $resultat = $pdo->query($requete);

    if ($resultat->rowCount() == 0) {
        echo "<div class='container my-4'><p class='alert alert-warning'>Aucun livre trouvé pour cet auteur.</p></div>";
    } else {
        $lignes = $resultat->fetchAll(PDO::FETCH_ASSOC);

        echo "
        <div class='container my-5'>
            <div class='card mx-auto shadow-lg' style='max-width: 800px;'>
                <div class='card-header'>
                    <h2>Livres de l'auteur : " . htmlspecialchars($lignes[0]['name']) . "</h2>
                </div>
                <div class='card-body'>
        ";
        foreach ($lignes as $ligne) {
            echo "
            <div class='mb-4 p-3 border rounded shadow-sm bg-light'>
                <div class='row'>
                    <div class='col-md-4 text-center'>
                        <img src='" . htmlspecialchars($ligne['images']) . "' alt='Image du livre' class='img-fluid' style='max-height: 200px; object-fit: contain;'>
                    </div>
                    <div class='col-md-8'>
                        <p><strong>Titre :</strong> " . htmlspecialchars($ligne['titre']) . "</p>
                        <p><strong>Genre :</strong> " . htmlspecialchars($ligne['nom']) . "</p>
                        <p><strong>Description :</strong> " . htmlspecialchars($ligne['description']) . "</p>
                    </div>
                </div>
            </div>";
        }

        echo "
                </div>
            </div>
        </div>";
    }
} catch (PDOException $e) {
    echo "<div class='container my-4'><p class='alert alert-danger'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p></div>";
}
?>

