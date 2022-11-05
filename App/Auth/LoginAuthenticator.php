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
            if ($realPassword == $password)
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
}