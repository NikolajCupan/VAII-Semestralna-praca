<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

class AdminController extends AControllerBase
{
    public function authorize($action)
    {
        if (!$this->app->getAuth()->isLogged())
        {
            return false;
        }

        $id = $this->app->getAuth()->getLoggedUserId();
        $userRole = User::getOne($id)->getRole();

        if ($userRole == "a")
        {
            return true;
        }

        return false;
    }

    public function index() : Response
    {
        $data = User::getAll();
        return $this->html($data);
    }
}