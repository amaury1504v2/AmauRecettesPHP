<?php
session_start();
session_destroy();
?>
<?php if(!isset($loggedUser)): // Si l'utilisateur est pas loggé ?> 
<div class="alert alert-danger container" role="alert">
    Vous n'êtes pas connecté.
</div>
<?php endif; 

header('Location: ' . $rootUrl . 'login.php');
exit;
?>