<?php

namespace App\Auth;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

class LoginAuthenticator extends DummyAuthenticator
{
    public function login($login, $password) : bool
    {
        $allUsers = User::getAll();

        $found = FALSE;
        foreach ($allUsers as $user)
        {
            if ($user->getUsername() == $login)
            {
                $found = TRUE;
                $realPassword = User::getOne($user->getId())->getPassword();
                break;
            }
        }

        if ($found)
        {
            if (password_verify($password, $realPassword))
            {
                $_SESSION['user'] = $login;
                return true;
            }
        }

        return false;
    }

    function getLoggedUserRole() : mixed
    {
        $id = $this->getLoggedUserId();

        if ($id) {
            return User::getOne($id)->getRole();
        }

        return null;
    }

    /*
     * Navratove hodnoty:
     * 0 -> vsetky udaje su zadane korektne
     * 1 -> meno je uz pouzite
     * 2 -> e-mail je uz pouzity
     * 3 -> hesla sa nezhoduju
     * 4 -> heslo je prilis jednoduche
     */
    public function register($login, $email, $password, $passwordVerify) : int
    {
        $allUsers = User::getAll();

        foreach($allUsers as $user)
        {
            if ($user->getUsername() == $login)
            {
                return 1;
            }

            if ($user->getEmail() == $email)
            {
                return 2;
            }
        }

        if ($password != $passwordVerify)
        {
            return 3;
        }

        if (!preg_match('~[0-9]+~', $password) || strlen($password) < 6) {
            return 4;
        }

        return 0;
    }
}