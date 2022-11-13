<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Helpers\InputErrorMessages;
use App\Models\User;
use App\Helpers\InputChecking;

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


        $user = User::getOne($id);
        $realPassword = User::getOne($user->getId())->getPassword();

        $allUsers = User::getAll('ID != ' . $id);

        $data = [];
        if (empty($sucasneHeslo))
        {
            $data = ['message' => 'Nezadane heslo!'];
            return $this->html($data, 'profile');
        }

        if (!password_verify($sucasneHeslo, $realPassword))
        {
            $data = ['message' => 'Nespravne heslo!'];
            return $this->html($data, 'profile');
        }

        $meniSaHeslo = false;
        if ($noveHeslo != "" || $noveHesloPotvrdenie != "")
        {
            $meniSaHeslo = true;
            $returnValue = InputChecking::skontrolujVstupy($allUsers, $noveMeno, $novyEmail, $noveHeslo, $noveHesloPotvrdenie);
        }
        else
        {
            $returnValue = InputChecking::skontrolujVstupy($allUsers, $noveMeno, $novyEmail, null, null);
        }

        if ($returnValue == InputErrorMessages::Correct)
        {
            $user->setUsername($noveMeno);
            $user->setEmail($novyEmail);

            if ($meniSaHeslo)
            {
                $user->setPassword(password_hash($noveHeslo, PASSWORD_BCRYPT));
            }

            $user->save();
            $_SESSION['user'] = $noveMeno;
            return $this->redirect("?c=user&a=success");
        }
        else
        {
            $data = ['message' => $returnValue->value];
            return $this->html($data, 'profile');
        }
    }

    public function success() : Response
    {
        return $this->html();
    }
}