
<?php
require('connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $pdo = connect();
    $requete = "SELECT * FROM Genre WHERE id = $id";
    $result=$pdo->query($requete);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);

    if ($ligne ){
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
    body{
        background-image: url(/pics/10.jpg);
    }
</style>
    <form method="POST" class="container p-4 shadow rounded bg-light">
            <div class="form_element my-4">
                <label for="nom">Nom de genre :</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom Auteur" value="<?= htmlspecialchars($ligne['nom']) ?>" required>
            </div>
            <div class="form_element my-4">
                <label for="description">description :</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="biographie" value="<?= htmlspecialchars($ligne['description'])?>" required>
            </div>
                <input type="submit" class="btn btn-warning" name="Update" value="Mettre à jour">
            </div>
        </form>
<?php
    } else {
        echo "Genre introuvable.";
    }
} else {
    echo "ID manquant.";
}

if (isset($_POST['Update'])) {
    $nom= $_POST['nom'];
    $description= $_POST['description']; 
    
    $requete = "UPDATE Genre
                SET nom = '$nom', description= '$description'
                WHERE id = $id";
    try {
        $result = $pdo->exec($requete);
        
        header("Location: gestionGenre.php");
    } catch (PDOException $e) {
        echo "Impossible d'éditer ce genre " . $e->getMessage();
    }
}
?>
