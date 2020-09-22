<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="css/index.css">
<?php 
    // Démarrage de la session + on inclut des fichiers nécessaire.
    session_start();
    include('include/user.php');
    include('include/database.php');
    include('include/menu.php');
    include('include/gestion.php');



if ($_SESSION['admin'] == 0) 
{
    echo "<a href='index.php'>Vous n'etes pas administrateur</a>";
} 
else 
{
    menu();
    global $db;
    $user = new user($db); // Récupère les informations de la class user

    if (isset($_POST['modifcompte'])) 
    {
        $user->Modif_user($_SESSION['modif'], $_POST['user'], $_POST['pass']);
        unset($_SESSION['modif']);
    }

    $selectuser = $db->prepare("SELECT * FROM `user`"); // Requête qui sélectionne tous le utilisateurs présents dans la BDD
    $selectuser->execute();
    $userindex = 0;
    while ($tabus = $selectuser->fetch()) 
    {
        $tabuser[$userindex++] = new gestion($tabus['id_user'], $tabus['user']);
    }
        if (isset($_POST["users"])) 
        {
            foreach ($tabuser as $objetuser) 
            {
                if ($objetuser->getId() == $_POST["users"]) 
                {
                    $user->Suppression_user($objetuser->getId());
                }
            }
        }
    if (isset($_POST["modifusers"])) 
    {
        foreach ($tabuser as $objetmodif) 
        {
            if ($objetmodif->getId() == $_POST["modifusers"]) 
            {

                $_SESSION['modif'] = $objetmodif->getId();
            }
        }
    }

?>

    <span onload="location.reload()" on></span>
<?php
    if (!isset($_SESSION['modif'])) 
    { 
?>
    <div class="wrapper container">
        <div class="row justify-content-center">
            <div class="col-auto align-self-center">
                <div class="wrapper fadeInDown">
                    <div id="formContente">
                        <p class="card-text">
                            <table class="table">
                                <tr>
                                    <th class="text-center">Supprimer un compte</th>
                                </tr>
                                <form action="" method="POST">
                                    <tr>
                                        <td class="text-center">
                                            <select name="users">
                                                <?php
                                                    echo '<option value="0">Chooisir un user</option>';
                                                    foreach ($tabuser as $objetuser) 
                                                    {
                                                        echo '<option value="' . $objetuser->getId() . '">' . $objetuser->getNom() . '</option>'; // On récupère le nom et l'id présents dans gestion pour la suppression
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input type="submit"  value="Suppression"></input>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-auto align-self-center">
                <div class="wrapper fadeInDown">
                    <div id="formContente">
                        <p class="card-text">
                            <table class="table">
                                <tr>
                                    <th scope="col" class="text-center">Modifier un compte</th>
                                </tr>
                                <form action="" method="POST">
                                    <!--Fomulaire qui modifie un compte -->
                                    <tr>
                                        <td class="text-center">
                                            <select name="modifusers">

                                                <?php
                                                    echo '<option value="0">Chooisir un user</option>';
                                                    foreach ($tabuser as $objetmodif) 
                                                    {
                                                        echo '<option value="' . $objetmodif->getId() . '">' . $objetmodif->getNom() . '</option>'; // On récupère le nom et l'id présents dans gestion pour la modification
                                                    }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input type="submit" value="Modifier"></input>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } 
    else if (isset($_SESSION['modif'])) 
    { 
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="wrapper fadeInDown">
                        <div id="formContent">
                            <p class="card-text">
                                <table class="table">
                                    <tr>
                                        <th scope="col" class="text-center">Modifier un compte</th>
                                    </tr>
                                    <form action="" method="post">
                                        <tr>
                                            <td class="text-center">
                                                <input type="text" name="user" placeholder="login">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <input type="password" name="pass" placeholder="password">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <input type="submit" name="modifcompte" value="modifier le compte">
                                            </td>
                                        </tr>
                                    </form>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>