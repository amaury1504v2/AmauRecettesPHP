<?php 
    session_start();

    include_once('../config/mysql.php');
    include_once('../config/user.php');
    include_once('../variables.php');

    $postData = $_POST;

    // vérification du formulaire
    if (
        !isset($postData['title']) // Si la variable $title n'est pas set
        || !isset($postData['recipe']) // Si la variable $recipe est pas set
        )
        {
            echo "Il faut un titre et une recette pour pouvoir soumettre le formulaire.";
            return;
        }

    $title = $postData['title']; // On importe la variable $title postée ici
    $recipe = $postData['recipe']; // On importe la variable $recipe postée ici

    // faire l'insertion en base
    $insertRecipe = $db->prepare('INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)'); // On prépare à insérer la recette dans la base de données
    $insertRecipe->execute([ // l'objet execute
        'title' => $title, // On met dans le champ title la variable $title
        'recipe' => $recipe, // On met dans le champ recipe la variable $recipe
        'author' => $loggedUser['email'], // On met dans le champ author le mail de la personne connectée
        'is_enabled' => 1 // On met is_enabled à true
    ]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>AmauRecettes</title>
</head>
<body>

    <!-- Navigation -->
    <?php include_once('../header.php'); ?>

    <br/>

    <div class="container">
        <h1>Recette ajoutée avec succès !</h1>
            
            <div class="card">
                
                <div class="card-body">
                    <h5 class="card-title"><?php echo($title); ?></h5>
                    <p class="card-text"><b>Email</b> : <?php echo($loggedUser['email']); ?></p>
                    <p class="card-text"><b>Recette</b> : <?php echo strip_tags($recipe); ?></p>
                </div>
            </div>
        </div>
    </div>

<!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>