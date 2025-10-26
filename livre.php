<?php
session_start();
require('admin/connect.php');

if (!isset($_SESSION['user_id']))
{if( !($_SESSION['role'] == 'admin' )){

    header('Location:login.php');
    exit();}
}
try {
    $pdo = connect();
    if ($pdo) {
        $req = "SELECT b.images, b.titre, a.nom FROM books b join Auteur a on(b.auteur_id = a.id)";
        $resultat = $pdo->query($req);
        $lignes = $resultat->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="css/maiin.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="main">
<?php include 'includes/nav.php'; ?>
<style>
    .container{
        margin-top:5% ;
    }
    .card:hover {
        transform: scale(1.05); 
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); 
    }
    .card {
        width: 100%;
        max-width: 25rem;
        height: auto; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
</style>
    <div class="main">
        <div class="container">
            <div class="row">
            <?php foreach ($lignes as $ligne) : ?>
                <div class="col-lg-4 text-center mb-4">
                    <div class="card">
                        <img src="<?php echo $ligne['images']; ?>" alt="<?php echo $ligne['titre']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $ligne['titre']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Ecrit Par : <?php echo $ligne['nom']; ?></h6>
                            <div class="form_element my-4">
                                <a href="admin/detail.php?titre=<?php echo $ligne['titre']; ?>" class="btn btn-info">Voir plus</a>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>