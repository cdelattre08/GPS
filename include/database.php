<?php
    try
    {   // Connexion à la Base de données 
        $db = new PDO('mysql:host=localhost;dbname=GPS','GPS', 'GPS');
    }
    catch(exception $erreur)
    {   // Retourne ce message s'il y a une erreur lors de la connexion à la BDD
        echo "Erreur de connexion a la BDD";
    }  
?>