<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign up</title>
</head>
<style>
    body{
        background-image: url(/pics/10.jpg);
    }
</style>
<body>
<?php include 'includes/nav.php'; ?> 
<div class="container">
    <div class="box form-box">
        <header>Sign up</header>
        <form action="" method="post">
        <div class="field input">
            <label for="nom">Nom d'Utilisateur</label>
            <input type="text" name="nom" id="nom" autocomplete="off" required>
        </div>

        <div class="field input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" autocomplete="on" required>
        </div>
        <?php

            ?>
        <div class="field input">
            <label for="tel">Telephone</label>
            <input type="input" name="tel" id="tel" autocomplete="off" required>
        </div>
        <div class="field input">
            <label for="password">Mot De Passe</label>
            <input type="password" name="password" id="password" autocomplete="off" required>
        </div>
        <div class="field">       
            <input type="submit" class="btn" name="submit" value="s'inscrire" required>
        </div>
        <div class="links">
            déja un membre? <a href="/login.php">login</a>
        </div>
        </form>
    </div> 
    <?php
    require 'admin/connect.php';
    $pdo = connect();
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $password = $_POST['password'];
        $query = "SELECT email FROM Utilisateur WHERE email='$email'";
        $resultat = $pdo->query($query);
    if ($resultat->rowCount() != 0){
        echo "<div class='message'><p>ce email est utilisé!</p></div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Retourner</button>";
    }
    else{
        $query="INSERT INTO Utilisateur(nom,email,telephone,Password,role) VALUES('$nom','$email','$tel','$password','user')"or die();
        $stmt = $pdo->exec($query);
       
        
    }
    header("Location: index.php");
    exit();
}
?>

</div>
</body>
</html>