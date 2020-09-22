<link rel="stylesheet" href="css/index.css">
<?php session_start();
include('include/menu.php');
// Début de la session

if (!isset($_SESSION['user'])) { // verifie si une session(user) exsite ou pas si non un lien vers l'accueil apparer si oui le menu insi que d'autre nformation
    echo "<a href='index.php'>Vous n'etes pas connecter</a>";
} else {
    menu(); 
?>
    

    <div class="container">
        <div class="wrapper row justify-content-center">
            <div class="col-12 align-self-center">
                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <p class="card-text">
                            <table class="table">

                                <tr>
                                    <th scope="col" class="text-center">Informations Personelle</th>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Nom : <?php echo $_SESSION['nom']; ?>
                                        <!--Affiche le nom de la personne connecté.-->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Prenom : <?php echo $_SESSION['prenom']; ?>
                                        <!--Affiche le prénom de la personne connecté.-->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Login : <?php echo $_SESSION['user']; ?>
                                        <!--Affiche le login de la personne connecté.-->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Grade : <?php if ($_SESSION['admin'] == 1) { // Affiche le grade de la personne connecté, soit administrateur, soit utilisateur.
                                                    echo 'Administrateur';
                                                } else {
                                                    echo 'Utilisateur';
                                                } ?>
                                    </td>
                                </tr>
                            </table>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>