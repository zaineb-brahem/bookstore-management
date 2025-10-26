<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
<link rel="stylesheet" href="../css/navst.css">
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../pics/book.png" width="50" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Acceuil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../livre.php">livres</a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../auteur.php" aria-disabled="true">Auteurs</a>
        </li>
        <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Genres</a>
  <ul class="dropdown-menu">
    <li>
      <a class="dropdown-item" href="../genre.php?filter=Aventure">Aventure</a>
    </li>
    <li>
      <a class="dropdown-item" href="../genre.php?filter=Historique">Historique</a>
    </li>
    <li>
      <a class="dropdown-item" href="../genre.php?filter=Drame">Drame</a>
    </li>
    <li>
      <a class="dropdown-item" href="../genre.php?filter=policier">Policier</a>
    </li>
    <li>
      <a class="dropdown-item" href="../genre.php?filter=Fantasy">Fantasty</a>
    </li>
    <li>
      <a class="dropdown-item" href="../genre.php?filter=conte philosophique">philosophique</a>
    </li>
    <li>
      <a class="dropdown-item" href="../genre.php?filter=Horreur">Horreur</a>
    </li>
    <li>
      <a class="dropdown-item" href="../genre.php?filter=dystopie">Dystopie</a>
    </li>
  </ul>
</li>
        <?php if (!isset($_SESSION["user_id"]) && (!isset($_SESSION["admin_id"]))) : ?>
          <li class="nav-item">
            <a href="../login.php"><button class="btn" type="submit">Login</button></a>
          </li>
          <?php else: ?>
            <?php if ($_SESSION["role"] === 'admin'): ?>
              <li><a class="nav-link" href="../admin/avis.php">Dashboard</a></li>
            <?php endif; ?>
          <li class="nav-item">
          <li><a class="nav-link" href="../logout.php">Logout</a></li>
          <a href="../moncompte.php"><button class="btn" type="submit">Mon compte</button></a>
          </li>
          <?php if($_SESSION["role"] === 'user'): ?>
            <div>
              <a class="btn float-end d-flex align-items-center" href="../panier.php">
              
                <i class="las la-shopping-basket" style="font-size: 30px;"></i>
                
              </a>
            </div>
                <?php endif; ?>
        <?php endif; ?>
        
          </ul>

      <form class="d-flex" method="POST">
      <input class="px-2 search" type="search" placeholder="rechercher ton livre ici" aria-label="Search" id="search" name="name">
    <input class="btn0" type="submit" value="Search" name="search">
 
    <?php
    if (isset($_POST['search'])) {
        $_SESSION['name'] = $_POST['name']; 
        header("Location: search.php");
        exit();
    }
    ?>
      </form>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>