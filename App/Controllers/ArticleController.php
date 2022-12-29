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

    public function create() : Response
    {
        return $this->html();
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

    public function postArticle() : Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (!$this->app->getAuth()->isLogged() || !isset($formData['submit']))
        {
            return $this->redirect("?c=article");
        }

        $id = $formData['id'];
        if (empty($id))
        {
            return $this->redirect("?c=article");
        }

        $prihlasenyRola = $this->app->getAuth()->getLoggedUserRole();
        if ($prihlasenyRola != "a" && $prihlasenyRola != "b")
        {
            return $this->redirect("?c=article");
        }


        $nadpis = $formData['clanokNadpis'];
        $text = $formData['clanokText'];

        if (empty($nadpis) || strlen($nadpis) < 5 || strlen($nadpis) > 60)
        {
            $data = ['message' => 'Nadpis musi mat minimalne 5 a maximalne 60 znakov!'];
            return $this->html($data, 'create');
        }

        if (empty($text) || strlen($text) < 50 || strlen($text) > 65535 )
        {
            $data = ['message' => 'Text clanku musi mat minimalne 50 a maximalne 65535 znakov!'];
            return $this->html($data, 'create');
        }


        $subor = $_FILES['clanokFotka'];

        $suborMeno = $subor['name'];
        $suborTyp = $subor['type'];
        $suborVelkost = $subor['size'];

        if ($suborTyp != 'image/jpeg' && $suborVelkost != 0)
        {
            $data = ['message' => 'Nespravny format fotky!'];
            return $this->html($data, 'create');
        }

        if ($suborVelkost > 2097152)
        {
            $data = ['message' => 'Maximalna velkost fotky je 2MB!'];
            return $this->html($data, 'create');
        }


        $cas = time();
        $nahodnyString = substr(str_shuffle(MD5(microtime())), 0, 5);
        $unikatneMeno = "public" . DIRECTORY_SEPARATOR . "articles" . DIRECTORY_SEPARATOR . "{$cas}-{$nahodnyString}-{$suborMeno}";

        move_uploaded_file($subor['tmp_name'], $unikatneMeno);


        $newArticle = new Article();
        $newArticle->setAuthor($id);
        $newArticle->setText($text);
        $newArticle->setTitle($nadpis);
        $newArticle->setImage($unikatneMeno);

        $datum = date("Y-m-d");
        $newArticle->setDate($datum);

        $newArticle->save();

        return $this->redirect("?c=article");
    }
}