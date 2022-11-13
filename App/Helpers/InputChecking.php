<?php

namespace App\Helpers;

use App\Helpers\InputErrorMessages;
use App\Models\User;

class InputChecking
{
    public static function skontrolujVstupy($allUsers, $login, $email, $password = null, $passwordVerify = null) : InputErrorMessages
    {
        foreach ($allUsers as $user)
        {
            if ($user->getUsername() == $login)
            {
                return InputErrorMessages::UsedName;
            }

            if ($user->getEmail() == $email)
            {
                return InputErrorMessages::UsedEmail;
            }
        }

        if (!(is_null($password) || is_null($passwordVerify)))
        {
            if ($password != $passwordVerify)
            {
                return InputErrorMessages::DifferentPasswords;
            }

            if (!preg_match('~[0-9]+~', $password) || strlen($password) < 6)
            {
                return InputErrorMessages::SimplePassword;
            }

            if (strlen($password) > 50)
            {
                return InputErrorMessages::LongPassword;
            }
        }

        if (strlen($login) > 30)
        {
            return InputErrorMessages::LongName;
        }

        if (strlen($email) > 75)
        {
            return InputErrorMessages::LongEmail;
        }

        return InputErrorMessages::Correct;
    }
}