<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;

class CommentController extends AControllerBase
{
    public function authorize($action)
    {
        if (!$this->app->getAuth()->isLogged())
        {
            return false;
        }

        return true;
    }

    public function index(): Response
    {
        return $this->redirect('?c=article');
    }

    public static function getArticleComments($articleId): array
    {
        return Comment::getAll('article = ?', [$articleId]);
    }

    public function postComment()
    {
        $text = $this->request()->getValue('komentarText');
        $articleId = $this->request()->getValue('articleId');

        if (!$this->app->getAuth()->isLogged())
        {
            return $this->redirect('?c=article&a=specific&articleId=' . $articleId);
        }

        if (strlen($text) < 5 || strlen($text) > 500)
        {
            return $this->redirect('?c=article&a=specific&articleId=' . $articleId);
        }

        $newComment = new Comment();
        $newComment->setText($text);
        $newComment->setUser($this->app->getAuth()->getLoggedUserId());
        $newComment->setArticle($articleId);
        $datum = date("Y-m-d");
        $newComment->setDate($datum);
        $newComment->save();

        return $this->redirect('?c=article&a=specific&articleId=' . $articleId);
    }
}