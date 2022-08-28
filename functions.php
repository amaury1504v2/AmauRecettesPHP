<?php

    function display_recipe(array $recipe) : string
    {
        $recipe_content = '';

        if ($recipe['is_enabled']) {
            $recipe_content = '<article>';
            $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
            $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
            $recipe_content .= '<i>' . $recipe['author'] . '</i>';
            $recipe_content .= '</article>';
        }
        
        return $recipe_content;
    }

    function display_author($authorEmail, array $users) : string // cette fonction permet de retourner le nom complet et l'âge de l'auteur 
    {
        for ($i = 0; $i < count($users); $i++) { // avec une valeur initiale de 0, tant que i est strictement inférieur aux nombre d'utilisateurs de la base de données
            $author = $users[$i]; // on met dans $author l'utilisateur de la base de données
            if ($authorEmail === $author['email']) { // si le mail de l'auteur est du même type que le mail de l'auteur dans la base de données
                return $author['full_name'] . '(' . $author['age'] . ' ans)'; // retourner le nom complet de l'auteur et son âge entre parenthèses
            }
        }
    }

    function get_recipes(array $recipes, int $limit) : array // Cette fonction permet d'obtenir les recipes en respectant la limite donnée
    {
        $valid_recipes = []; 
        $counter = 0;

        foreach($recipes as $recipe) { // pour chaque recette dans le tableau de recettes
            if ($counter == $limit) { // si le conteur est égal à la limite donnée
                return $valid_recipes; // retourner les recettes valables
            }

            $valid_recipes[] = $recipe; // sinon mettre la recette dans le tableau des recettes valables
            $counter++; // incrémenter counter
        }

        return $valid_recipes;
    }
?>