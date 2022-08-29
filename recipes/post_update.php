<?php
session_start();

include_once('../config/mysql.php');
include_once('../config/user.php');
include_once('../variables.php');

$postData = $_POST;

if (
    !isset($postData['id']) // Si l'identifiant n'est pas trouvé
    || !isset($postData['title']) // Ou si le titre n'est pas trouvé
    || !isset($postData['recipe']) // Ou si la recette n'est pas trouvée
    )
{
	echo('Il manque des informations pour permettre l\'édition du formulaire.');
    return;
}	

$id = $postData['id'];
$title = $postData['title'];
$recipe = $postData['recipe'];

$insertRecipeStatement = $db->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id'); // On prépare la requête pour mettre à jour les champs titre et recette
$insertRecipeStatement->execute([
    'title' => $title,
    'recipe' => $recipe,
    'id' => $id,
]);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Site de Recettes - Création de recette</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body class="d-flex flex-column min-vh-100">

        <?php include_once('../header.php'); ?>

        <div class="container">

            <br/>

            <h1>Recette modifiée avec succès !</h1>
            
            <div class="card">
                
                <div class="card-body">
                    <h5 class="card-title"><?php echo($title); ?></h5>
                    <p class="card-text"><b>Email</b> : <?php echo($loggedUser['email']); ?></p>
                    <p class="card-text"><b>Recette</b> : <?php echo strip_tags($recipe); ?></p>
                </div>
            </div>
        </div>
    </body>
</html>
