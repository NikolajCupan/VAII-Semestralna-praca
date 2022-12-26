<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Article;
use App\Models\Like;
use App\Models\User;

class ArticleController extends AControllerBase
{
    public function authorize($action)
    {
        return true;
    }

    public function index() : Response
    {
        $data = Article::getAll();
        return $this->html($data);
    }

    public function specific() : Response
    {
        $articleId = $this->request()->getValue('articleId');
        $article = Article::getOne($articleId);

        if (!isset($article))
        {
            return $this->redirect("?c=home");
        }

        return $this->html($article);
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

        return $this->redirect("?c=article");
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

        return $this->redirect("?c=article");
    }

    public function delete()
    {
        $articleId = $this->request()->getValue('articleId');
        $articleToDelete = Article::getOne($articleId);

        if (!$this->app->getAuth()->isLogged() && !isset($articleId))
        {
            return $this->redirect("?c=home");
        }

        if ($this->app->getAuth()->getLoggedUserRole() != 'a' && !$this->ownsArticle($articleToDelete))
        {
            return $this->redirect("?c=home");
        }


        if (isset($articleToDelete))
        {
            $likes = Like::getAll('article = ?', [$articleId]);

            foreach ($likes as $like)
            {
                $like->delete();
            }

            $articleToDelete->delete();
        }

        return $this->redirect("?c=article");
    }

    private function ownsArticle(Article $article) : bool
    {
        if ($article->getAuthor() == $this->app->getAuth()->getLoggedUserId())
        {
            return true;
        }

        return false;
    }
}