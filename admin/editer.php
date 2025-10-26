<?php
require('connect.php');


if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $pdo = connect();
    $requete = "SELECT * FROM books WHERE id = $id";
    $result=$pdo->query($requete);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);

    if ($ligne ){
       
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="stylee.css">
    <form method="POST" class="container p-4 shadow rounded bg-light">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre du livre :</label>
        <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre du livre" value="<?= htmlspecialchars($ligne['titre']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="auteur_id" class="form-label">Auteur-id :</label>
        <input type="text" class="form-control" name="auteur_id" id="auteur_id" placeholder="Auteur du livre" value="<?=$ligne['auteur_id'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="genre_id" class="form-label">Genre-id :</label>
        <input type="text" class="form-control" name="genre_id" id="genre_id" placeholder="Genre du livre" value="<?= $ligne['genre_id'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="ISBN" class="form-label">ISBN :</label>
        <input type="text" class="form-control" name="ISBN" id="ISBN" placeholder="ISBN du livre" value="<?= $ligne['ISBN'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="disponible" class="form-label">Disponible :</label>
        <select class="form-select" name="disponible" id="disponible" required>
            <option value="1" <?= $livre['disponible'] == 1 ? 'selected' : '' ?>>Oui</option>
            <option value="0" <?= $livre['disponible'] == 0 ? 'selected' : '' ?>>Non</option>
        </select>
    </div>
    <div class="mb-3">
    <label for="images" class="form-label">image :</label>
        <input type="text" class="form-control" name="images" id="images" placeholder="saisir le lien de photo de livre" value="<?= htmlspecialchars($ligne['images']) ?>" required>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-success" name="Update">Modifier</button>
    </div>
</form>
<?php
    } else {
        echo "Livre introuvable.";
    }
} else {
    echo "l'id de livre manquant.";
}

if (isset($_POST['Update'])) {
    $titre = $_POST['titre'];
    $auteur_id = $_POST['auteur_id']; 
    $genre_id = $_POST['genre_id']; 
    $ISBN = $_POST['ISBN']; 
    $disponible = $_POST['disponible'];  
    $images = $_POST['images'];  
    $requete = "UPDATE books
                SET titre = '$titre', 
                    auteur_id = $auteur_id, 
                    genre_id = $genre_id, 
                    ISBN = $ISBN, 
                    disponible = $disponible,
                    images='$images'
                WHERE id = $id";
    
    try {
        $result = $pdo->exec($requete);
        header("Location: liste.php");
    } catch (PDOException $e) {
        echo "Impossible d'éditer ce livre: " . $e->getMessage();
    }
}
?>