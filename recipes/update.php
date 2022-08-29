<?php session_start();
    include_once('../config/mysql.php');
    include_once('../config/user.php');
    include_once('../variables.php');

$getData = $_GET; // on stocke la supervariable $_GET dans $getdata

if (!isset($getData['id']) && is_numeric($getData['id'])) // S'il n'y a pas d'identifiant et si c'est pas un nombre
{
	echo('Il faut un identifiant de recette pour le modifier.');
    return;
}	

$retrieveRecipeStatement = $db->prepare('SELECT * FROM recipes WHERE recipe_id = :id'); // on prépare la requête qui sélectionne l'id de la recette
$retrieveRecipeStatement->execute([ // on demande à l'objet d'executer la requête
    'id' => $getData['id'], 
]);

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC); // donne l'id de la recette
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Site de Recettes - Edition de recette</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body class="d-flex flex-column min-vh-100">

        <?php include_once('../header.php'); ?>

        <div class="container">
            <br/>
            <h2>Mettre à jour <?php echo($recipe['title']); ?></h2>
            <form action="<?php echo($rootUrl . 'recipes/post_update.php'); ?>" method="POST">
                <div class="mb-3 visually-hidden">
                    <label for="id" class="form-label">Identifiant de la recette</label>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['id']); ?>">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de la recette</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help" value="<?php echo($recipe['title']); ?>">
                    <div id="title-help" class="form-text">Choisissez un titre percutant !</div>
                </div>
                <div class="mb-3">
                    <label for="recipe" class="form-label">Description de la recette</label>
                    <textarea class="form-control" placeholder="Seulement du contenu vous appartenant ou libre de droits." id="recipe" name="recipe">
                    <?php echo strip_tags($recipe['recipe']); // permet d'éviter les injections de tags script ex : évite le alert('hello world'); du javascript ?> 
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
            <br />
        </div>
    </body>
</html>