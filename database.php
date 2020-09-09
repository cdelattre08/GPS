<?php
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=GPS','root', 'root');
    }
    catch(exception $erreur)
    {
        echo "Erreur de connexion a la BDD";
    }
?>