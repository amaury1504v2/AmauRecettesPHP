<?php
    include_once('config/mysql.php');
    include_once('variables.php');
    include_once('functions.php');  
?>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $rootUrl . "home.php"; ?>">AmauRecettes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $rootUrl . "home.php"; ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $rootUrl . "recipes/create.php"; ?>">Ajouter une recette</a>
                </li>
            </ul>
        </div>
    </div>
</nav>