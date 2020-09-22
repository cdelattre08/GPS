<?php 
    // Démarrage de la session + on inclut un fichier nécessaire.
    session_start();
    include('include/menu.php');
    if ($_SESSION['admin'] == 0) 
    {
        echo "<a href='index.php'>Vous n'etes pas administrateur</a>";
    } 
    else 
    {
        menu();  
?>
<script src="source.js"></script>

<body onload="pickLocation();"> <!-- permet de reload auto la page grace au setinterval en js-->


    <div id="div_entete" style="height:10vh;">
        <p>Coordonnées tirées (<font color=red>latitude</font>
            <font color=blue>longitude</font>
            <font color=green>heure</font>
            <font color=black>vitesse</font>
            <font color=blue>vitessemoyene</font>
            <font color=red>bateauid</font>
            <font color=green>date</font>) :
        </p>
    </div>
    <div id="div_coord" style="padding-left:2em;height:50vh;width:30em;display:block; overflow:scroll;overflow-x: hidden;">

    </div>
</body>
<?php }?>