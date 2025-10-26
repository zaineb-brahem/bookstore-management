<?php
session_start(); 

require('admin/connect.php');

if (isset($_GET['titre'])) {
    $titre = $_GET['titre'];

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }


        if (isset($_SESSION['panier']) && in_array($titre, $_SESSION['panier'])) {
            $_SESSION['panier'] = array_diff($_SESSION['panier'], [$titre]);
            echo "Book '$titre' removed from your cart.<br>";

            $pdo = connect();
            $updateReq = "UPDATE books SET disponible = 1 WHERE titre = :titre";
            $updateStmt = $pdo->prepare($updateReq);
            $updateStmt->execute([':titre' => $titre]);

            header("Location: panier.php");
        } else {
            echo "Book '$titre' not found in your cart.";
        }


} else {
    echo "Invalid or missing book title.";
}
?>