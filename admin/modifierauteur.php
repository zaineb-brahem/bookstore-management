
<?php
require('connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $pdo = connect();
    $requete = "SELECT * FROM Auteur WHERE id = $id";
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
                <label for="nom">Nom d'auteur :</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom Auteur" value="<?= htmlspecialchars($ligne['nom']) ?>" required>
            </div>
            <div class="form_element my-4">
                <label for="biographie">biographie :</label>
                <input type="text" class="form-control" name="biographie" id="biographie" placeholder="biographie" value="<?= $ligne['biographie']?>" required>
            </div>
            <div class="form_element my-4">
                <label for="date">date de naissance :</label>
                <input type="date" class="form-control" name="date" id="date"  value="<?= $ligne['date_de_naissance'] ?>" required>
            </div>
            <div>
            <label for="images">Image:</label>
            <input type="text" class="form-control" name="images" id="images"  value="<?= $ligne['images'] ?>" required>
            </div>
            <div class="form_element my-4">
                <input type="submit" class="btn btn-warning" name="Update" value="Mettre à jour">
            </div>
        </form>
<?php
    } else {
        echo "auteur introuvable.";
    }
} else {
    echo "ID manquant.";
}

if (isset($_POST['Update'])) {
    $nom = $_POST['nom'];
    $biographie = $_POST['biographie']; 
    $date = $_POST['date']; 
    
    $requete = "UPDATE Auteur
                SET nom = '$nom', 
                    biographie = '$biographie', 
                    date_de_naissance = '$date'
                WHERE id = $id";
    try {
        $result = $pdo->exec($requete);
        
        header("Location: liste.php");
    } catch (PDOException $e) {
        echo "Impossible d'éditer cet auteur: " . $e->getMessage();
    }
}
?>