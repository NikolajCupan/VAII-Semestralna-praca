<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Auth\LoginAuthenticator;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\Response
     */
    public function index() : Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    public function success() : Response
    {
        return $this->html();
    }

    /**
     * Login an user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function login() : Response
    {
        if ($this->app->getAuth()->isLogged())
        {
            return $this->redirect("?c=home");
        }

        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
                return $this->redirect('?c=user');
            }
        }

        $data = ($logged === false ? ['message' => 'Zlé prihlasovanie údaje!'] : []);
        return $this->html($data, 'login');
    }

    /**
     * Logout a user
     * @return \App\Core\Responses\ViewResponse
     */
    public function logout() : Response
    {
        $this->app->getAuth()->logout();
        return $this->redirect("?c=home");
    }

    public function register() : Response
    {
        if ($this->app->getAuth()->isLogged())
        {
            return $this->redirect("?c=home");
        }

        $formData = $this->app->getRequest()->getPost();
        $returnValue = null;
        if (isset($formData['submit'])) {
            $returnValue = $this->app->getAuth()->register($formData['login'], $formData['email'], $formData['password'], $formData['passwordVerify']);
        }

        if (isset($returnValue) && $returnValue == 0)
        {
            $newUser = new User();
            $newUser->setUsername($this->request()->getValue('login'));
            $newUser->setPassword(password_hash($this->request()->getValue('password'), PASSWORD_BCRYPT));
            $newUser->setEmail($this->request()->getValue('email'));
            $newUser->setRole('u');

            $newUser->save();
            return $this->redirect("?c=auth&a=success");
        }

        $data = [];
        switch ($returnValue)
        {
            case 1:
                $data = ['message' => 'Meno je uz pouzite!'];
                break;
            case 2:
                $data = ['message' => 'E-mail je uz pouzity!'];
                break;
            case 3:
                $data = ['message' => 'Hesla sa nezhoduju'];
                break;
            case 4:
                $data = ['message' => 'Heslo musi mat aspon 6 znakov a obsahovat cislo'];
                break;
        }

        return $this->html($data, 'register');
    }
}