<?php
    try
    {
        $db = new PDO(
            'mysql:host=localhost;
            dbname=my_recipes;
            charset=utf8',
            'root', 
            'root',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

    // // Ecriture de la requête
    // $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';

    // // Préparation
    // $insertRecipe = $db->prepare($sqlQuery);

    // // Exécution ! La recette est maintenant en base de données
    // $insertRecipe->execute([
    //     'title' => 'Cassoulet',
    //     'recipe' => 'Etape 1 : Des flageolets ! Etape 2 : Euh ...',
    //     'author' => 'contributeur@exemple.com',
    //     'is_enabled' => 1, // 1 = true, 0 = false
    // ]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Recettes de cuisine</title>
</head>
<body>
    <!-- Navigation -->
    <?php include_once('header.php'); ?>

    <br/>

    <div class="container">
        <h2>Ajouter une recette</h2>
        <br>
        <form action="<?php echo "postcreate.php"; ?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la recette</label>
                <textarea placeholder="le contenu de la recette" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
   
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>