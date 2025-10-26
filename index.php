<?php session_start(); ?>
<link rel="stylesheet" href="css/maiin.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
<title>Document</title>

<body class="main">   
    <?php include 'includes/nav.php'; ?> 
<section>
<div class="banner">
    <div class="banner-content">
        <h1>Bienvenue Dans Notre Bibliothèque</h1>
    </div>
</div>
<div class="a">
<p>Explorez Nos livres Les Plus Populaires</p>
</div>
<div class="main">
<div class="container">
    <style>
        .container{
            margin-top: 5%;
        }
        .display-2{
            font-family:'Poppins',sans-serif;
            font-weight: 400;
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
    </style>
    <div class="row">
    <?php
    require('admin/connect.php'); 
    try {
        $pdo = connect();
        if ($pdo) {
            $req = "SELECT b.images, titre ,nom FROM books b join Auteur a on(b.auteur_id=a.id) where titre in('Les Misérables','Le Comte de Monte-Cristo','Le Petit Prince','Notre-Dame de Paris','Étranger','Une étude en rouge')"; 
            $resultat = $pdo->query($req);
            if ($resultat->rowCount() == 0) {
                echo "<p class='text-center'>Aucun livre trouvé...</p>";
            } else {
                while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <div class="col-lg-4 text-center mb-4">
                        <div class="card">
                            <img src="' . htmlspecialchars($ligne["images"]) . '" alt="' . htmlspecialchars($ligne["titre"]) . '" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($ligne["titre"]) . '</h5>
                                <h6 class="card-title">' . htmlspecialchars($ligne["nom"]) . '</h6>
                                <div class="form_element my-4">
                                <a href="admin/detail.php?titre=' . htmlspecialchars($ligne["titre"]) . '" class="btn btn-primary">Voir plus</a>
                                
                            </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
        } catch (PDOException $e) {
                    echo "<p class='text-danger'>Erreur : " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </div>
    </div>
</section>
</body>

</html>
