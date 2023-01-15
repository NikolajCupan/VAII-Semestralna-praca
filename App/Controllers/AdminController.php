<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Type;
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

        $userRole  = $this->app->getAuth()->getLoggedUserRole();

        if ($userRole == "a")
        {
            return true;
        }

        return false;
    }

    public function index() : Response
    {
        $data = [];
        $data['users'] = User::getAll();
        $data['types'] = Type::getAll();
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


            // komentare pouzivatela nemazem, iba nastavim autora na null
            $comments = Comment::getAll('user = ?', [$id]);

            foreach ($comments as $comment)
            {
                $comment->setUser(null);
                $comment->save();
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

    public function addType()
    {
        $nazovTyp = $this->request()->getValue('typNazov');

        if (strlen($nazovTyp) < 3 || strlen($nazovTyp) > 30)
        {
            return $this->redirect("?c=admin");
        }

        $typy = Type::getAll();

        foreach ($typy as $typ)
        {
            if ($typ->getName() == $nazovTyp)
            {
                return $this->redirect("?c=admin");
            }
        }

        $newTyp = new Type();
        $newTyp->setName($nazovTyp);
        $newTyp->save();

        return $this->redirect("?c=admin");
    }

    public function deleteTyp()
    {
        $id = $this->request()->getValue('id');
        $typToDelete = Type::getOne($id);

        if (isset($typToDelete))
        {
            if ($typToDelete->getName() == "Nezaradené")
            {
                return $this->redirect("?c=admin");
            }

            $articles = Article::getAll('type = ?', [$id]);
            $nezaradene = Type::getAll('name = ?', ['Nezaradené']);
            foreach ($articles as $article)
            {
                $article->setType($nezaradene[0]->getId());
                $article->save();
            }

            $typToDelete->delete();
        }

        return $this->redirect("?c=admin");
    }
}