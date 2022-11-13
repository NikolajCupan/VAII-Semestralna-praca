<?php

namespace App\Auth;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;
use App\App;
use App\Helpers\InputErrorMessages;
use App\Helpers\InputChecking;

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

    public function register($login, $email, $password, $passwordVerify) : InputErrorMessages
    {
        $allUsers = User::getAll();

        return InputChecking::skontrolujVstupy($allUsers, $login, $email, $password, $passwordVerify);
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

    public function getLoggedUserEmail() : mixed
    {
        if (!$this->isLogged())
        {
            return null;
        }

        $id = $this->getLoggedUserId();

        if ($id)
        {
            return User::getOne($id)->getEmail();
        }

        return null;
    }
}