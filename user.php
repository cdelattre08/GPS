<?php

class User
{   //
    private $_bdd;
    private $_login;
    private $_password;

    function __construct($bdd)
    {
        $this->_bdd = $bdd;
    }

    public function newUser($login, $password)
    { // fonction qui créé un utilisateur dans la base de données



        $newuser = $this->_bdd->prepare('INSERT INTO `user`(`login`, `password`) VALUES (:login, :password)');
        $newuser->execute([
            'login' => $login,
            'password' => $password,
        ]);
    }

    public function Connexion($login, $password)
    {   // fonction qui permet à l'utilisateur de se connecter


        $connex = $this->_bdd->query('SELECT * FROM user WHERE user = ' . $login . ' password = ' . $password . '');
        $connex = $connex->fetch();

        $this->_login = $connex['user'];
        $this->_password = $connex['password'];
    }

    public function Suppression_user($login, $password)
    {   // Cette fonction permet à l'administrateur de supprimer les utilisateurs inscrits en base

        $delete = $this->_bdd->prepare("DELETE FROM user WHERE login = '$login' AND password = '$password'");
        $delete->execute(array($this->login));
    }


    public function modif_user($login, $password)
    {   // Cette fonction permet à l'administrateur de modifier ls utilisateurs inscrits en base

        $modif = $this->_bdd->prepare("UPDATE FROM `user`");
        $modif->execute();
    }


    public function test_user($login, $password)
    {
        if ($login == $this->_login) {
            if ($password == $this->_password) {
                return true;
            }
        }
        return false;
    }
}
