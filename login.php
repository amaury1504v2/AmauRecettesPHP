<?php 
    $postData = $_POST;


    if (isset($postData['email']) &&  isset($postData['password'])) { // Si on a bien entré le mail et le password
        foreach ($users as $user) { // Pour chaque utilisateur de la table users
            if (
                $user['email'] === $postData['email'] && // Si le mail correspond bien au type du champ défini et
                $user['password'] === $postData['password'] // Si le mot de passe correspond bien au type du champ défini
            ) {
                $loggedUser = [ // logged user est un tableau avec 
                    'email' => $user['email'], // 'email' contient la valeur du champ email de l'utilisateur dans la base de données
                ];
    
                /**
                 * Cookie qui expire dans un an
                 */

                $cookie_name = 'LOGGED_USER';
                $cookie_value = $loggedUser['email'];

                setcookie( 
                    $cookie_name,
                    $cookie_value,
                    [ // temps d'expiration
                        'expires' => time() + 365*24*3600, // expire à l'heure qui est un an (31 536 000 secondes) après l'heure de la création du cookie
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
                // $_SESSION : se ferme lorsque l'utilisateur sort du site
                $_SESSION['LOGGED_USER'] = $loggedUser['email']; // La session nommée LOGGED_USER du cookie est égale au mail de l'utilisateur loggé
            } else {
                $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                    $postData['email'],
                    $postData['password']
                );
            }
        }
    }

    if (isset($_COOKIE['LOGGED_USER'])) { // Si le cookie nommé LOGGED_USER est présent
        $loggedUser = [
            'email' => $_COOKIE['LOGGED_USER'], // On met le cookie dans le champ 'email'
        ];
    }

    if (isset($_SESSION['LOGGED_USER'])) { // Si la session nommée LOGGED_USER est présente
        $loggedUser = [
            'email' => $_SESSION['LOGGED_USER'], // On met le session dans le champ 'email'
        ];
    }
?>

<?php if(!isset($loggedUser)): // Si l'utilisateur est loggé ?> 
    <form action="home.php" method="post">
        <?php if(isset($errorMessage)) : // S'il y a une erreur ?>
            <div class="alert alert-danger" role="alert">
                <?php echo($errorMessage); ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
            <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
<?php else: ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo($loggedUser['email']); // Sinon, afficher bonjour et le mail de l'utilisateur loggé ?> !
    </div>
<?php endif; ?>