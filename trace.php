<link rel="stylesheet" href="css/index.css">
<?php 
    session_start(); //on start la session pour recuper les variables
    //on include les class et les fonciions
    include('include/menu.php');
    include('include/database.php');
    include('include/gestion.php');
    global $db;
    if (!isset($_SESSION['user'])) // vérifie si une session(user) existe ou pas si non un lien vers l'accueil apparé si oui le menu ainsi que d'autres informations
    { 
        echo "<a href='index.php'>Vous n'etes pas connecter</a>";
    } 
    else 
    {  
        menu(); //permet d'aficher le menu

        $selectbateau = $db->prepare("SELECT * FROM `Bateau`"); //requête qui selectionne tout les bateaux est qui va servir à faire unz liste deroulante 
        $selectbateau->execute();
        $bateauindex = 0;
        while ($selectbateaux = $selectbateau->fetch()) 
        {
            $bateau[$bateauindex++] = new gestion($selectbateaux['BateauID'], $selectbateaux['nom_bateau']);
        }
        if (isset($_GET["bateau"])) 
        {
            foreach ($bateau as $objetBeateau) 
            {
                if ($objetBeateau->getId() == $_GET["bateau"]) 
                {
                    $selectGPS = $db->prepare("SELECT GPS.GPSID, GPS.Date, GPS.Heure, GPS.Latitude, GPS.Longitude, GPS.Vitesse, GPS.Vitesse_moyenne, Bateau.nom_bateau FROM GPS, Bateau WHERE GPS.BateauID = Bateau.BateauID and Bateau.BateauID = :id");
                    $selectGPS->execute([
                    'id' => $objetBeateau->getId()
                    ]);
                    //requête en jointure qui permet de selectionner des informations grace à l'id du bateau qui est récupéré avec la liste deroulante des bateaux
                }
            }
        }
?>
    <div class="container">
        <div class="wrapper row justify-content-center">
            <form action="" methode="GET">
                <!-- Formulaire pour la liste deroulante -->
                <select name="bateau">
                    <?php
                        echo '<option value="0">Choisir un bateau</option>';
                        foreach ($bateau as $objetBeateau)
                        { //envoi les informations du tableau bateau a objetbateau là on travaille en objet
                            echo '<option value="' . $objetBeateau->getId() . '">' . $objetBeateau->getNom() . '</option>';
                        }
                    ?>
                </select>
                <input type="submit"></input>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">

            <?php 
                while ($selectGPSd = $selectGPS->fetch()) //boucle qui va servir à afficher toute les informations récupérés avec la requête de selectGPS
                { 
            ?>
                <div class="col-4 align-self-center">
                    <div class="wrapper fadeInDown">
                        <div id="formContent">
                            <p class="card-text">
                                <table class="table">
                                    <tr>
                                        <th scope="col" class="text-center">Coordonnées GPS N° <?php echo $selectGPSd['GPSID'];?></th> <!--affiche l'id du gps-->                                                       
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Date : <?php echo $selectGPSd['Date']; ?> <!--affiche la date du gps-->            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Heure : <?php echo $selectGPSd['Heure'];?> <!--affiche l'heure du gps-->        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Latitude : <?php echo $selectGPSd['Latitude']; ?> <!--affiche la latitude du gps-->               
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Longitude : <?php echo $selectGPSd['Longitude'];?> <!--affiche la longitude du gps-->              
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Vitesse : <?php echo $selectGPSd['Vitesse'];?> <!--affiche la vitesse du gps-->                     
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Vitesse_moyenne : <?php echo $selectGPSd['Vitesse_moyenne'];?> <!--affiche la vitesse moyenne du gps-->              
                                        </td>
                                    </tr>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
            <?php 
                } 
            ?>
        </div>
    </div>
<?php 
    } 
?>