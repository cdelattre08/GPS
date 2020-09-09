<?php include('database.php'); include('user.php'); ?>
<?php
$use = "edouard";
$pass = "pass";
?>
<?php

$u = new user($db);
//$valid = true;
if (isset($_POST['valid'])) {

    $u->Connexion($_POST["username"],$_POST["password"]);
    $connexion = $u->test_user($_POST["username"],$_POST["password"]);
    if($connexion){
        $_SESSION['user'] = true;
    }
    /*if ($use == $username) {
        $valid = true;
        echo "ok";
    } else {
        $valid = false;
    }
    if ($pass == $password) {
        $valid = true;
        echo "ok";
    } else {
        $valid = false;
    }
    if ($valid) {
        $_SESSION['user'] = $use;
        echo "connexion en cours ! ";
    }*/
}
if (isset($_POST['incrip'])) {

    echo"inscrip";
}    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <?php if (!isset($_SESSION['user'])) {  ?>
                <table>
                    <form action="" method="post">
                        <tr>
                            <td>
                                <input type="text" name="username" id="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" name="password" id="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="valid" value="connex">
                                <input type="submit" name="incrip" value="inscrip">
                            </td>

                        </tr>
                    </form>
                </table>
            <?php } echo "test";?>
        </div>
    </div>
</body>

</html>