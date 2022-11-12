<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class UserController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return $this->app->getAuth()->isLogged();
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index() : Response
    {
        return $this->html();
    }

    /**
     * Example of an action accessible without authorization
     * @return \App\Core\Responses\ViewResponse
     */
    public function contact() : Response
    {
        return $this->html();
    }

    public function profile() : Response
    {
        return $this->html();
    }

    public function editProfile() : Response
    {
        $data = ['message' => 'Zmena udjaov bola uspesna!'];
        $formData = $this->app->getRequest()->getPost();

        if (!$this->app->getAuth()->isLogged() && !isset($formData['submit']))
        {
            return $this->redirect("?c=home");
        }

        $id = $formData['id'];
        if (empty($id))
        {
            return $this->redirect("?c=home");
        }

        $noveMeno = $formData['poleMeno'];
        $novyEmail = $formData['poleEmail'];
        $sucasneHeslo = $formData['poleStareHeslo'];
        $noveHeslo = $formData['poleNoveHeslo'];
        $noveHesloPotvrdenie = $formData['poleNoveHesloPotvrdenie'];

        if (empty($sucasneHeslo))
        {
            $data = ['message' => 'Nezadane heslo!'];
            return $this->html($data, 'profile');
        }

        $user = User::getOne($id);
        $realPassword = User::getOne($user->getId())->getPassword();

        if (!password_verify($sucasneHeslo, $realPassword))
        {
            $data = ['message' => 'Nespravne heslo!'];
            return $this->html($data, 'profile');
        }

        // kontrola, ci sa meni heslo
        if ($noveHeslo != "" || $noveHesloPotvrdenie != "")
        {
            if ($noveHeslo != $noveHesloPotvrdenie)
            {
                $data = ['message' => 'Nove hesla sa nezhoduju!'];
                return $this->html($data, 'profile');
            }

            $user->setPassword(password_hash($noveHeslo, PASSWORD_BCRYPT));
        }


        $allUsers = User::getAll();

        // kontrola, ci meni meno
        if ($noveMeno != $user->getUsername() || $novyEmail != $user->getEmail())
        {
            foreach ($allUsers as $localUser)
            {
                if ($localUser->getId() == $id)
                {
                    continue;
                }

                if ($localUser->getUsername() == $noveMeno)
                {
                    $data = ['message' => 'Meno je uz pouzite!'];
                    return $this->html($data, 'profile');
                }
                else if ($localUser->getEmail() == $novyEmail)
                {
                    $data = ['message' => 'Email je uz pouzity!'];
                    return $this->html($data, 'profile');
                }
            }
        }

        $user->setUsername($noveMeno);
        $user->setEmail($novyEmail);
        $user->save();

        return $this->html($data, 'profile');
    }
}