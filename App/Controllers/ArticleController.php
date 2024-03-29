<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Type;
use App\Models\User;
use App\Controllers\CommentController;

class ArticleController extends AControllerBase
{
    public function authorize($action)
    {
        if ($action == "create" || $action == "modify")
        {
            if ($this->app->getAuth()->getLoggedUserRole() == 'a' || $this->app->getAuth()->getLoggedUserRole() == 'b')
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return true;
    }

    public function index(): Response
    {
        $data = Article::getAll();
        return $this->html($data);
    }

    public function create(): Response
    {
        $data = Type::getAll('name != ?', ['Nezaradené']);
        return $this->html($data);
    }

    public function modify() : Response
    {
        $data = [];

        $articleId = $this->request()->getValue('articleId');
        $article = Article::getOne($articleId);

        if (!isset($article))
        {
            return $this->redirect('?c=article');
        }

        $this->hasRightToModify($article);
        $data['article'] = $article;
        $data['types'] = Type::getAll();

        return $this->html($data);
    }

    public function deletePhoto() : Response
    {
        $articleId = $this->request()->getValue('articleId');
        $article = Article::getOne($articleId);

        if (!isset($article))
        {
            return $this->redirect('?c=article');
        }

        $this->hasRightToModify($article);

        $fotka = $article->getImage();
        if (file_exists($fotka))
        {
            unlink($fotka);
        }

        $article->setImage(null);
        $article->save();

        return $this->redirect("?c=article&a=modify&articleId=" . $articleId);
    }

    public function hasRightToModify($article)
    {
        if (!$this->app->getAuth()->isLogged() || !isset($article))
        {
            return $this->redirect("?c=article");
        }

        if ($this->app->getAuth()->getLoggedUserRole() != 'a' && $this->app->getAuth()->getLoggedUserRole() != 'b')
        {
            return $this->redirect("?c=article");
        }

        if ($this->app->getAuth()->getLoggedUserRole() == 'b')
        {
            if ($article->getAuthor() != $this->app->getAuth()->getLoggedUserId())
            {
                return $this->redirect("?c=article");
            }
        }
    }

    public function specific() : Response
    {
        $articleId = $this->request()->getValue('articleId');
        $article = Article::getOne($articleId);

        if (!isset($article))
        {
            return $this->redirect("?c=article");
        }

        return $this->html($article);
    }

    public function like()
    {
        $articleId = $this->request()->getValue('articleId');
        $like = $this->getUserLikes($articleId);

        if (is_null($like) || count($like) != 0)
        {
            return $this->redirect("?c=article");
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
        $like = $this->getUserLikes($articleId);

        if (is_null($like) || count($like) == 0)
        {
            return $this->redirect("?c=article");
        }

        $like[0]->delete();

        return $this->redirect("?c=article");
    }

    public function getUserLikes($articleId)
    {
        $article = Article::getOne($articleId);

        if (!isset($article))
        {
            return null;
        }

        if (!$this->app->getAuth()->isLogged() || !isset($articleId))
        {
            return null;
        }

        return Like::getAll('user = ? and article = ?', [$this->app->getAuth()->getLoggedUserId(), $articleId]);
    }

    public function delete()
    {
        $articleId = $this->request()->getValue('articleId');
        $articleToDelete = Article::getOne($articleId);

        if (!$this->app->getAuth()->isLogged() || !isset($articleId))
        {
            return $this->redirect("?c=article");
        }

        if ($this->app->getAuth()->getLoggedUserRole() != 'a' && !$this->ownsArticle($articleToDelete))
        {
            return $this->redirect("?c=article");
        }


        if (isset($articleToDelete))
        {
            $likes = Like::getAll('article = ?', [$articleId]);
            $comments = Comment::getAll('article = ?', [$articleId]);

            foreach ($likes as $like)
            {
                $like->delete();
            }

            foreach ($comments as $comment)
            {
                $comment->delete();
            }

            $fotka = $articleToDelete->getImage();
            if (file_exists($fotka))
            {
                unlink($fotka);
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


        $data = $this->skontrolujZadane($formData);
        if (count($data) != 0)
        {
            return $this->html($data, 'create');
        }


        $unikatneMeno = $this->ulozFotku();

        $newArticle = new Article();
        $newArticle->setAuthor($id);
        $newArticle->setText($formData['clanokText']);
        $newArticle->setTitle($formData['clanokNadpis']);
        $newArticle->setImage($unikatneMeno);

        $datum = date("Y-m-d");
        $newArticle->setDate($datum);

        $kategoria = $this->request()->getValue('kategoria');
        if (isset($kategoria))
        {
            $newArticle->setType($kategoria);
        }
        else
        {
            $idNezaradene = Type::getAll('name = ?', ['Nezaradené']);
            $newArticle->setType($idNezaradene[0]->getId());
        }

        $newArticle->save();

        return $this->redirect("?c=article");
    }

    public function updateArticle() : Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (!isset($formData['submit']))
        {
            return $this->redirect("?c=article");
        }

        $articleId = $formData['articleId'];
        $article = Article::getOne($articleId);
        $userId = $formData['id'];


        $data = $this->skontrolujZadane($formData);
        if (count($data) != 0)
        {
            $data['article'] = $article;
            return $this->html($data, 'modify');
        }

        $this->hasRightToModify($article);

        if (count($_FILES) != 0)
        {
            $unikatneMeno = $this->ulozFotku();
            $article->setImage($unikatneMeno);
        }

        $article->setTitle($formData['clanokNadpis']);
        $article->setText($formData['clanokText']);

        $datum = date("Y-m-d");
        $article->setDate($datum);

        $kategoria = $this->request()->getValue('kategoria');
        if (isset($kategoria))
        {
            $article->setType($kategoria);
        }

        $article->save();

        return $this->redirect("?c=article");
    }

    public function skontrolujZadane($formData) : array
    {
        $nadpis = $formData['clanokNadpis'];
        $text = $formData['clanokText'];

        if (empty($nadpis) || strlen($nadpis) < 5 || strlen($nadpis) > 60)
        {
            return ['message' => 'Nadpis musi mat minimalne 5 a maximalne 60 znakov!'];
        }

        if (empty($text) || strlen($text) < 50 || strlen($text) > 65535)
        {
            return ['message' => 'Text clanku musi mat minimalne 50 a maximalne 65535 znakov!'];
        }


        $subor = $_FILES['clanokFotka'];

        $suborMeno = $subor['name'];
        $suborTyp = $subor['type'];
        $suborVelkost = $subor['size'];

        if ($suborMeno != "" || $suborVelkost != 0)
        {
            if ($suborTyp != 'image/jpeg')
            {
                return ['message' => 'Nespravny format fotky!'];
            }
        }

        if ($suborVelkost > 2097152)
        {
            return ['message' => 'Maximalna velkost fotky je 2MB!'];
        }

        return [];
    }

    /**
     * @return void
     */
    public function ulozFotku() : string
    {
        $subor = $_FILES['clanokFotka'];
        $suborMeno = $subor['name'];

        $cas = time();
        $nahodnyString = substr(str_shuffle(MD5(microtime())), 0, 5);
        $unikatneMeno = "public/articles/" . "{$cas}-{$nahodnyString}-{$suborMeno}";

        move_uploaded_file($subor['tmp_name'], $unikatneMeno);

        return $unikatneMeno;
    }
}