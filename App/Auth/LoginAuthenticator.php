<?php

namespace App\Auth;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;
use App\App;
use App\Helpers\RegisterErrorMessages;

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

    public function register($login, $email, $password, $passwordVerify) : RegisterErrorMessages
    {
        $allUsers = User::getAll();

        foreach ($allUsers as $user)
        {
            if ($user->getUsername() == $login)
            {
                return RegisterErrorMessages::UsedName;
            }

            if ($user->getEmail() == $email)
            {
                return RegisterErrorMessages::UsedEmail;
            }
        }

        if ($password != $passwordVerify)
        {
            return RegisterErrorMessages::DifferentPasswords;
        }

        if (!preg_match('~[0-9]+~', $password) || strlen($password) < 6)
        {
            return RegisterErrorMessages::SimplePassword;
        }

        if (strlen($login) > 30)
        {
            return RegisterErrorMessages::LongName;
        }

        if (strlen($email) > 75)
        {
            return RegisterErrorMessages::LongEmail;
        }

        if (strlen($password) > 50)
        {
            return RegisterErrorMessages::LongPassword;
        }

        return RegisterErrorMessages::Correct;
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