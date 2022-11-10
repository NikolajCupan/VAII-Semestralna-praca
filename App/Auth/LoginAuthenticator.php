<?php

namespace App\Auth;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;
use App\App;

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
        if (!$this->isLogged())
        {
            return null;
        }

        $id = $this->getLoggedUserId();

        if ($id)
        {
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
     * 5 -> meno je prilis dlhe
     * 6 -> email je prilis dlhy
     * 7 -> heslo je prilis dlhe
     */
    public function register($login, $email, $password, $passwordVerify) : int
    {
        $allUsers = User::getAll();

        foreach ($allUsers as $user)
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

        if (!preg_match('~[0-9]+~', $password) || strlen($password) < 6)
        {
            return 4;
        }

        if (strlen($login) > 30)
        {
            return 5;
        }

        if (strlen($email) > 75)
        {
            return 6;
        }

        if (strlen($password) > 50)
        {
            return 7;
        }

        return 0;
    }

    public function getAbbreviatedLoggedUserName() : mixed
    {
        if (!$this->isLogged())
        {
            return null;
        }

        $name = $this->getLoggedUserName();

        if (strlen($name) <= 5)
        {
            return $name;
        }
        else
        {
            return substr($name, 0, 5) . "...";
        }
    }
}