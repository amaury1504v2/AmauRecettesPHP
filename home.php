<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <title>AmauRecettes</title>
</head>
<body>

    <!-- Navigation -->
    <?php include_once('header.php'); ?> <!-- Les variables avec les requêtes SQL, les fonctions et la config mysql sont exportées dans le header -->

    <div class="container">

        <br/>

        <!-- Formulaire de connexion -->
        <?php include_once('login.php'); ?>

        <br/>

        <h1>Recettes de cuisine :</h1>

        <br/>
        
        <?php foreach(get_recipes($recipes, $limit) as $recipe) : ?>
            <article>
            <div class="card">
                <div class="card-body">
                    <h3><a class="text-decoration-none" href="./recipes/read.php?id=<?php echo($recipe['recipe_id']); ?>"><?php echo($recipe['title']); ?></a></h3>
                    <div><?php echo($recipe['recipe']); ?></div>
                    <!-- <i><?php // echo(display_author($recipe['author'], $users)); ?></i> -->
                    <br/>
                    <?php if(isset($loggedUser) && $recipe['author'] === $loggedUser['email']): ?>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-warning ">
                            <a class="text-decoration-none" href="recipes/update.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a>
                        </label>
                        <label class="btn btn-danger">
                            <a class="text-decoration-none" href="recipes/delete.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a>
                        </label>
                    </div>
                </div>
            </div>

                <br/>

                <?php endif; ?>
            </article>

            <br/>
            
        <?php endforeach ?>
    </div>
   
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>