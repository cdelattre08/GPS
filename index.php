<?php
    // On inclut des fichiers nécessaire.
    include('include/database.php');
    include('include/user.php');
    include('include/menu.php');
    global $db;
    // Démarrage de la session.
    session_start(); 
?>
<html>
<head>
    <!-- Ici on met en place le style du site et le format de la langue "utf-8" -->
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Accueil</title>
</head>
<body>
    <?php
        // Si la fonction "deco" est utilisé, la session est détruite.
        if (isset($_POST['deco'])) 
        {
            session_unset();
            session_destroy();
        }
        $user = new user($db);
        // Si la fonction "valid" est utilisé,
        if (isset($_POST['valid'])) 
        {
            $user->Connexion($_POST['user'], $_POST['pass']);
            $connexion = $user->compare($_POST['user'], $_POST['pass']);
            if ($connexion) 
            {
                $_SESSION['user'] = $user->getLogin();
                $_SESSION['nom'] = $user->getNom();
                $_SESSION['prenom'] = $user->getPrenom();
                $_SESSION['admin'] = $user->getAdmin();
            }
        }
        //  Si la fonction "inscrip" est utilisé :
        if (isset($_POST['inscrip'])) 
        {
            // On vérifie si tous les champs sont remplis, sinon on quitte le programme.
            if (empty($_POST['nom'] && $_POST['prenom'] && $_POST['user'] && $_POST['password'])) // Vérifie si l'utilisateur a bien rempli tous les champs dans le formulaire
            { 
                echo '<a href="index.php">Votre saisie est incorrecte veuillez réesayer</a>';
                exit();
            } 
            else 
            {
                // On vérifie si l'utilisateur est déja inscrit dans la base de données
                $user->Connexion($_POST['user'], $_POST['pass']);
                $comparuser = $user->compare($_POST['user'], $_POST['pass']);
                if ($comparuser) 
                {
                    echo 'utilisateur déja inscrit';
                    // Sinon si il n'est pas incrit on l'inscrit.
                } 
                else 
                {
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
        <?php 
            if (!isset($_SESSION['user'])) 
            {  
        ?>
            <div class="wrapper container">
                <div class="row justify-content-center">
                    <div class="col-auto align-self-center">
                        <div class="wrapper fadeInDown">
                            <div id="formContent">
                                <p class="card-text">
                                    <table class="table">
                                        <tr>
                                            <th scope="col" class="text-center">Inscription</th>
                                            <!--Formulaire pour inscrire un utilisateur dans la BDD -->
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
        <?php } 
            else if (isset($_SESSION['user'])) 
            {
                menu();
        ?>
            <!-- Permet à l'utilisateur de mettre fin à sa session. -->
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