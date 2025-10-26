<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require('admin/connect.php');

if (isset($_GET['titre'])) {
    var_dump($_GET['titre']);
    $titre = $_GET['titre'];
    $pdo = connect();
    $req = "SELECT disponible FROM books WHERE titre = '" . $titre . "'";
    $resultat = $pdo->query($req);
    $result = $resultat->fetchAll(PDO::FETCH_ASSOC);
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
        
    }

    if ($result && $result[0]['disponible'] == 1) {
        
        $_SESSION['panier'][] = $titre;
        $_SESSION['message']= "Book is added to your cart.";
        $updateReq = "UPDATE books SET disponible = 0 WHERE titre = :titre";
        $updateStmt = $pdo->prepare($updateReq);
        $updateStmt->execute([':titre' => $titre]);
        
    } else {
        $_SESSION['message']= "Error: Book is not available for borrowing.";
    }

} else {
    $_SESSION['message']="Error: No book title provided.";
}
header("Location: livre.php");
exit();
?>
