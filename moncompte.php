<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/maiin.css">

<?php
session_start();
require('admin/connect.php');
    $id = $_SESSION['user_id'];
    $pdo = connect();
    $requete = "SELECT * FROM Utilisateur WHERE id = $id";
    $result = $pdo->query($requete);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);

    if ($ligne) {
?>
        <div class="container">
            <div class="box form-box">
                <header>Modifier Le Compte</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Nom d'Utilisateur</label>
                        <input type="text" name="username" id="username" autocomplete="off" required value="<?= $ligne['nom'] ?>">
                    </div>
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="on" required value="<?= $ligne['email']?>" >
                    </div>
                    <?php

                    ?>
                    <div class="field input">
                        <label for="tel">Telephone</label>
                        <input type="input" name="tel" id="tel" autocomplete="off" required value="<?= $ligne['telephone']?>" >
                    </div>
                    <div class="field input">
                        <label for="password">Mot De Passe</label>
                        <input type="password" name="password" id="password" autocomplete="off" required value="<?= $ligne['password']?>">
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="modifier" value="Modifier" required>
                    </div>
                </form>
            </div>
        </div>

    <?php
    } else {
        echo "utilisateur introuvable.";
    }
if (isset($_POST['modifier'])) {
    $nom = $_POST['username'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $requete = "UPDATE Utilisateur
                SET nom = '$nom', 
                    email = '$email',
                    telephone='$tel', 
                    password = '$password'
                WHERE id = $id";
    try {
        $result = $pdo->exec($requete);

        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Impossible d'éditer cet utilisateur: " . $e->getMessage();
    }
}
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <style>
    body{
        background-image: url(/pics/10.jpg);
    }
</style>
    <body>
   
    </body>
    </html>