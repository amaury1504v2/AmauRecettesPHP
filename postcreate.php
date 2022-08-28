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

    session_start();

    // include_once('./../config/mysql.php');
    // include_once('./../config/user.php');
    // include_once('./../variables.php');

    // vérification du formulaire
    if (
        !isset($_POST['title'])
        || !isset($_POST['recipe'])
        )
        {
            echo "Il faut un titre et une recette pour pouvoir soumettre le formulaire.";
            return;
        }

    $title = $_POST['title'];
    $recipe = $_POST['recipe'];

    // faire l'insertion en base
    $insertRecipe = $db->prepare('INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
    $insertRecipe->execute([
        "title" => $title,
        "recipe" => $recipe,
        "author" => $loggedUser['email'],
        "is_enabled" => 1
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
    <title>Recettes de cuisine</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo "home.php"; ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo "ajouterrecette.php"; ?>">Ajouter une recette</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>