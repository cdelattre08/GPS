<?php 
    include('../include/database.php');
    global $db;  
    //page de traitement de l'appel API depuis un code javascript
    //je vais juste retourner un chiffre aléatoire
    // mais je pourrais récupérer des données POST OU GET
    // je pourrais faire des actions metier ( exemple des calculs pour mon appli)
    //je pourrais faire des actions sur ma BDD    
    $retour = $db->query("SELECT BateauID FROM `Bateau` ORDER BY RAND()");
    $retours = $retour->fetch();
    //il est preferable de retourner un string compatible JSON qui sera encodé via la méthode json_encode.   
    echo json_encode($retours['BateauID']);
?>