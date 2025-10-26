<?php
session_start();
require('admin/connect.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'user')) {
    header('location: ../login.php');
}

try {
    $pdo = connect();
    if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        $ch = "";
        foreach ($_SESSION['panier'] as $panier) {
            $ch .= "'" . $panier . "',";   
        }
        $ch = rtrim($ch, ',');

        if ($pdo) {
            $req = "SELECT b.titre, b.images, a.nom as anom, g.nom as gnom FROM books b join Auteur a on a.id=b.auteur_id join Genre g on g.id=b.genre_id WHERE titre IN ($ch)";
            $resultat = $pdo->query($req);
            $lignes = $resultat->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $message = "Votre panier est vide.";
    }

} catch (PDOException $e) {
    echo "<p class='text-danger'>Erreur : " . $e->getMessage() . "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="main">
    <?php include 'includes/nav.php'; ?>
    <style>
        .container {
            margin-top: 5%;
        }
    </style>
    <div class="main">
        <h2 class="text-center mb-4">Liste des Livres dans Votre Panier</h2>
        <div class="container">
            <?php if (!empty($lignes)) : ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignes as $ligne) : ?>
                        <tr>
                            <td><img src="<?php echo $ligne['images']; ?>" alt="<?php echo $ligne['titre']; ?>" class="card-img-top" style="width: 100px; height: auto;"></td>
                            <td><?php echo $ligne['titre']; ?></td>
                            <td><?php echo $ligne['anom']; ?></td>
                            <td><?php echo $ligne['gnom']; ?></td>
                            <td><a href="/deleteFromPanier.php?titre=<?php echo $ligne['titre']; ?>" class="btn btn-danger">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
        <div class="alert alert-info text-center mt-4" role="alert">
            Votre panier est vide. Ajoutez des livres pour les voir ici.
        </div>
        <?php endif; ?>
    </div>

    </div>
</body>


</html>