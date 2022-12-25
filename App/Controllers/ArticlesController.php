<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Article;
use App\Models\Like;

class ArticlesController extends AControllerBase
{
    public function index() : Response
    {
        $data = Article::getAll();
        return $this->html($data);
    }

    public function like()
    {
        $articleId = $this->request()->getValue('articleId');

        if (!$this->app->getAuth()->isLogged() && !isset($articleId))
        {
            return $this->redirect("?c=home");
        }

        $newLike = new Like();
        $newLike->setArticle($articleId);
        $newLike->setUser($this->app->getAuth()->getLoggedUserId());
        $newLike->save();

        return $this->redirect("?c=articles");
    }

    public function cancelLike()
    {
        $articleId = $this->request()->getValue('articleId');

        if (!$this->app->getAuth()->isLogged() && !isset($articleId))
        {
            return $this->redirect("?c=home");
        }

        $like = Like::getAll('user = ? and article = ?', [$this->app->getAuth()->getLoggedUserId(), $articleId]);
        $like[0]->delete();

        return $this->redirect("?c=articles");
    }
}