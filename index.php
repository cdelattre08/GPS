<?php include('include/database.php');
include('include/user.php');
include('include/menu.php');
global $db;
session_start(); ?>

<html>

<head>  
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Accueil</title>
</head>

<body>


    <?php
    if (isset($_POST['deco'])) {
        session_unset();
        session_destroy();
    }
    $user = new user($db);
    if (isset($_POST['valid'])) {

        $user->Connexion($_POST['user'], $_POST['pass']);
        $connexion = $user->compare($_POST['user'], $_POST['pass']);
        if ($connexion) {
            $_SESSION['user'] = $user->getLogin();
            $_SESSION['nom'] = $user->getNom();
            $_SESSION['prenom'] = $user->getPrenom();
            $_SESSION['admin'] = $user->getAdmin();
        }
    }
    if (isset($_POST['inscrip'])) {

        if (empty($_POST['nom'] || $_POST['prenom'] || $_POST['user'] || $_POST['password'])) { // Vérifie si l'utilisateur a bien rempli tous les champs dans le formulaire
            echo '<a href="index.php">Votre saisie est incorrecte veuillez réesayer</a>';
            exit();
        } else {

            $user->Connexion($_POST['user'], $_POST['pass']);               // Vérifie si l'utilisateur existe déjà et retourne un message 
            $comparuser = $user->compare($_POST['user'], $_POST['pass']);
            if ($comparuser) {
                echo 'utilisateur déja inscrit';
            } else {
                echo 'Votre inscription a bien été prise en compte. 
                      Connectez-vous !';
                $user->newUser($_POST['user'], $_POST['pass'], $_POST['nom'], $_POST['prenom']);
            }
        }
    }
    ?>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
    </head>

    <body>
        <?php if (!isset($_SESSION['user'])) {  ?>

            <div class="wrapper container">
                <div class="row justify-content-center">
                    <div class="col-auto align-self-center">
                        <div class="wrapper fadeInDown">
                            <div id="formContent">
                                <p class="card-text">
                                    <table class="table">
                                        <tr>
                                            <th scope="col" class="text-center">Inscription</th>
                                            <!--Ajoute un utilisateur dans la BDD -->
                                        </tr>
                                        <form action="" method="post">
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" class="fadeIn second" name="nom" placeholder="Nom">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" class="fadeIn second" name="prenom" placeholder="Prenom">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" class="fadeIn second" name="user" placeholder="login">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">

                                                    <input type="password" class="fadeIn third" name="pass" placeholder="password">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="submit" class="fadeIn fourth" name="inscrip" value="Inscription">
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
                            <div id="formContent">
                                <p class="card-text">
                                    <table class="table">
                                        <tr>
                                            <th scope="col" class="text-center">Connexion</th>
                                            <!--Permet à l'utilisateur ou à l'administrateur de se connecter au site-->
                                        </tr>
                                        <form action="" method="post">
                                            
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" class="fadeIn second" name="user" placeholder="login">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="password" class="fadeIn third" name="pass" placeholder="password">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="submit" class="fadeIn fourth" name="valid" value="Connexion">
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




        <?php } else if (isset($_SESSION['user'])) {

            menu();
        ?>


            <div class="wrapper container">
                <div class="row justify-content-center">
                    <form action="" method="post"><input type="submit" name="deco" value="Déconnexion"></form>
                </div>
            </div>
        <?php


        }
        ?>

    </body>

    </html>
</body>

</html>