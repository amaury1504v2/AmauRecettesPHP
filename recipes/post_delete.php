<?php
    session_start();

    include_once('../config/mysql.php');
    include_once('../config/user.php');
    include_once('../variables.php');

    $postData = $_POST;

    if (!isset($postData['id'])) // Si on n'a pas d'identifiant
    {
        echo('Il faut un identifiant valide pour supprimer une recette.');
        return;
    }	

    $id = $postData['id']; // On importe l'identifiant

    $deleteRecipeStatement = $db->prepare('DELETE FROM recipes WHERE recipe_id = :id'); // On prépare la requête pour supprimer la recette dans l'objet
    $deleteRecipeStatement->execute([ // On demande à l'objet d'executer 
        'id' => $id, 
    ]);

    header('Location: ' . $rootUrl . 'home.php'); // On redirige vers la page home.php
?>