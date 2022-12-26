<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Article;
use App\Models\Like;
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

    public function delete()
    {
        $id = $this->request()->getValue('id');
        $loggedUserId = $this->app->getAuth()->getLoggedUserId();

        $userToDelete = User::getOne($id);

        if ($userToDelete && ($id != $loggedUserId))
        {
            // zmazem vsetky likes daneho pouzivatela
            $likes = Like::getAll('user = ?', [$id]);

            foreach ($likes as $like)
            {
                $like->delete();
            }


            // clanky pouzivatela nemazem, iba nastavim autora na null
            $articles = Article::getAll('author = ?', [$id]);

            foreach ($articles as $article)
            {
                $article->setAuthor(null);
                $article->save();
            }


            $userToDelete->delete();
        }

        return $this->redirect("?c=admin");
    }

    public function modify()
    {
        $rola = $this->request()->getValue('rola');
        $id = $this->request()->getValue('id');
        $loggedUserId = $this->app->getAuth()->getLoggedUserId();

        if (isset($id) && isset($loggedUserId) && ($id != $loggedUserId))
        {
            $user = User::getOne($id);

            if (isset($user))
            {
                $user->setRole($rola);
                $user->save();
            }
        }

        return $this->redirect("?c=admin");
    }
}