<?php
session_start();

require('../admin/connect.php');
$pdo = connect();
try {
    if ($pdo) {
        $req = "SELECT c.id ,b.images, b.titre, c.critique, c.nom_livre from Critiques c join books b ON c.nom_livre = b.titre";
        $resultat = $pdo->query($req);
        $lignes = $resultat->fetchAll(PDO::FETCH_ASSOC);
        if (empty($lignes)) {
            echo "<p>Aucune critique disponible.</p>";
        }
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
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/livlist.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="main">
<?php
  include('dashboard.php');
?>
<style>
    .container {
        margin-top: 5%;
        margin-left: 20%;
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
   
    h1{
        text-align: center;
        margin-top: 2%;
    }
</style>
    <div class="main">
    <h1>Les Critiques Des Utilisateurs</h1>
        <div class="container">
           
            <div class="row">
                <?php foreach ($lignes as $ligne) : ?>
                    <div class="col-lg-4 text-center mb-4">
                        <div class="card">
                            <img src="<?php echo $ligne['images']; ?>" alt="<?php echo $ligne['nom_live']; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $ligne['nom_live']; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Critique user <?php echo $ligne['id'];?> : <?php echo htmlspecialchars($ligne['critique']); ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>

