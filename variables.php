<?php 
    $usersStatement = $db->prepare('SELECT * FROM users'); // On choisit tous les champs de la table users
    $usersStatement->execute(); // l'objet execute la requête
    $users = $usersStatement->fetchAll(); // on récupére les données dans un format utilisable sous forme de tableau PHP
    
    $recipesStatement = $db->prepare('SELECT * FROM recipes WHERE is_enabled is TRUE'); // On choisit tous les champs de la table recipes où le champ is_enabled = TRUE
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();
    
    if(isset($_GET['limit']) && is_numeric($_GET['limit'])) { // On vérifie si des limites sont prédéfinies
        $limit = (int) $_GET['limit']; // Si oui, on active la limite
    } else {
        $limit = 100; // sinon, on la met manuellement à 100
    }

    // Si le cookie est présent
    if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])) {
        $loggedUser = [
            'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
        ];
    }

    $rootPath = $_SERVER['DOCUMENT_ROOT'];
    $rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/recettes_php/'; // affiche : http://localhost/recettes_php/
?>