<?php
session_start();
require("admin/connect.php");

if ($_SERVER["REQUEST_METHOD"]  === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (empty($username)) {
        header("Location: login.php?error=User Name is required");
        exit();
    } else if (empty($password)) {
        header("Location: login.php?error=Password is required");
        exit();
    }  else {
        $pdo = connect();
        $sql = "SELECT * FROM Utilisateur WHERE nom = :username  AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            header("Location: login.php?msg=2");
            exit();
        } else {
            $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($ligne['role'] == 'admin') {
                $_SESSION['admin_id'] = $ligne['id'];
                $_SESSION['role'] = 'admin';
                header('Location: index.php'); 
                exit();
            } else {
                $_SESSION['user_id'] = $ligne['id'];
                $_SESSION['role'] = 'user';
                header('Location: index.php');
                    }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/maiin.css">

    <title>Login</title>
</head>
<style>
    body{
        background-image: url(/pics/10.jpg);
    }
</style>
<body class = "main">
<?php include 'includes/nav.php'; ?> 
<div class="container">
    <div class="box form-box">
        <header>login</header>
        <form action="" method="post">
        <div class="field input">
            <label for="username">Nom d'Utilisateur</label>
            <input type="text" name="username" id="username" autocomplete="off" required>
        </div>
        <div class="field input">
            <label for="password">Mot De Passe</label>
            <input type="password" name="password" id="password" autocomplete="off" required>
        </div>
        <div class="field"> 
            <input type="submit" class="btn" name="submit" value="Se Connecter" required>
        </div>
        <div class="links">
        <a href="signup.php">Créez votre compte </a><br>
            Mot de passe oublié? <a href="recuperation.php">Récuperer votre compte</a>
           
        </div>
        </form>
    </div> 


</div>
</body>
</html> 